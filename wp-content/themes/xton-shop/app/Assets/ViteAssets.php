<?php

declare(strict_types=1);

namespace XtonShop\Assets;

use XtonShop\Support\Contracts\Bootable;

/**
 * Ładuje zasoby front-endu zbudowane przez Vite.
 *
 * - Produkcja: czyta dist/.vite/manifest.json i kolejkuje HASHOWANE pliki
 *   (cache-busting przez hash w nazwie — brak parametru ?ver).
 * - Dev: gdy istnieje dist/hot, ładuje moduły z serwera Vite (HMR).
 */
final class ViteAssets implements Bootable
{
    private const HANDLE = 'xton-shop';
    private const ENTRY = 'resources/js/app.ts';

    private string $distUri;
    private string $distPath;

    public function __construct()
    {
        $this->distUri  = get_template_directory_uri() . '/dist';
        $this->distPath = get_template_directory() . '/dist';
    }

    public function boot(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
        add_filter('script_loader_tag', [$this, 'asModule'], 10, 2);
    }

    public function enqueue(): void
    {
        if ($this->isDev()) {
            $this->enqueueDev();

            return;
        }

        $this->enqueueProduction();
    }

    /**
     * Tryb dev aktywny, gdy serwer Vite zapisał plik dist/hot.
     */
    private function isDev(): bool
    {
        return is_readable($this->distPath . '/hot');
    }

    private function enqueueDev(): void
    {
        $server = $this->devServerUrl();

        // Klient HMR + wejściowy moduł TS (Vite serwuje CSS przez import w app.ts).
        wp_enqueue_script(self::HANDLE . '-client', $server . '/@vite/client', [], null, true);
        wp_enqueue_script(self::HANDLE, $server . '/' . self::ENTRY, [], null, true);
    }

    private function enqueueProduction(): void
    {
        $manifest = $this->manifest();

        if (! isset($manifest[self::ENTRY]) || ! is_array($manifest[self::ENTRY])) {
            return;
        }

        $entry = $manifest[self::ENTRY];

        // Style (hashowane) importowane przez wejście JS.
        foreach ((array) ($entry['css'] ?? []) as $index => $css) {
            wp_enqueue_style(self::HANDLE . '-' . $index, $this->distUri . '/' . $css, [], null);
        }

        // Skrypt (hashowany).
        if (! empty($entry['file'])) {
            wp_enqueue_script(self::HANDLE, $this->distUri . '/' . $entry['file'], [], null, true);
        }
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function manifest(): array
    {
        $path = $this->distPath . '/.vite/manifest.json';

        if (! is_readable($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);

        return is_array($decoded) ? $decoded : [];
    }

    private function devServerUrl(): string
    {
        $hot = (string) file_get_contents($this->distPath . '/hot');

        return $hot !== '' ? rtrim(trim($hot), '/') : 'http://localhost:5173';
    }

    /**
     * Dodaje type="module" do naszych skryptów (wymagane przez Vite/ESM).
     */
    public function asModule(string $tag, string $handle): string
    {
        if (! str_starts_with($handle, self::HANDLE)) {
            return $tag;
        }

        if (str_contains($tag, 'type=')) {
            return $tag;
        }

        return str_replace('<script ', '<script type="module" ', $tag);
    }
}
