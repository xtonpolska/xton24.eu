import { defineConfig, type Plugin, type ViteDevServer } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'node:path';
import { writeFileSync, unlinkSync } from 'node:fs';

const THEME_PUBLIC_PATH = '/wp-content/themes/xton-shop/dist/';
const HOT_FILE = resolve(__dirname, 'dist/hot');

/**
 * Zapisuje plik `dist/hot` z adresem serwera dev, aby PHP (ViteAssets)
 * wiedział, że ma ładować assety z serwera Vite (HMR) zamiast z manifestu.
 * Plik jest usuwany po zatrzymaniu serwera.
 */
function wordpressHotFile(): Plugin {
    const clean = (): void => {
        try {
            unlinkSync(HOT_FILE);
        } catch {
            /* plik już nie istnieje */
        }
    };

    return {
        name: 'xton-wordpress-hot-file',
        apply: 'serve',
        configureServer(server: ViteDevServer) {
            server.httpServer?.once('listening', () => {
                const address = server.httpServer?.address();
                const port = typeof address === 'object' && address ? address.port : 5173;
                writeFileSync(HOT_FILE, `http://localhost:${port}`);
            });
            process.once('exit', clean);
            process.once('SIGINT', () => process.exit());
            process.once('SIGTERM', () => process.exit());
        },
    };
}

export default defineConfig({
    // Bazowa ścieżka publiczna assetów w produkcji (WordPress web root).
    base: THEME_PUBLIC_PATH,
    plugins: [tailwindcss(), wordpressHotFile()],
    build: {
        // Hashowane nazwy plików + manifest do mapowania w PHP.
        manifest: true,
        outDir: 'dist',
        emptyOutDir: true,
        rollupOptions: {
            input: resolve(__dirname, 'resources/js/app.ts'),
        },
    },
    server: {
        host: 'localhost',
        port: 5173,
        strictPort: true,
        // CORS: strona WordPress (inny origin) musi móc pobrać moduły z serwera Vite.
        cors: true,
        origin: 'http://localhost:5173',
    },
});
