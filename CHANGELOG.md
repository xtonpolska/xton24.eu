# CHANGELOG.md

Dziennik zmian technicznych projektu xton24.eu. Prowadzony automatycznie przez Claude'a: każda zmiana zapisywana jest z **datą, godziną (CEST)** i **listą ruszanych plików**. Najnowsze wpisy na górze.

Format: `## YYYY-MM-DD HH:MM` → opis + lista plików.

---

## 2026-07-28 13:23
Zbudowanie fundamentu motywu `xton-shop` v0.2.0: OOP (PSR-4), Vite + Tailwind v4 + TS, DaisyUI, integracja WooCommerce. Zależności zainstalowane, build zweryfikowany.
- `composer.json`, `package.json`, `vite.config.ts`, `tsconfig.json`, `.gitignore` (motyw) — nowe: konfiguracja narzędzi
- `functions.php` — nowy: bootstrap (autoload + `Theme::boot()`)
- `app/Theme.php`, `app/Support/Contracts/Bootable.php` — nowe: rdzeń OOP
- `app/Setup/{ThemeSupport,Menus,Cleanup,WooCommerce}.php` — nowe: moduły
- `app/Assets/ViteAssets.php` — nowy: ładowanie hashowanych assetów (manifest + HMR)
- `index.php`, `header.php`, `footer.php`, `templates/parts/content.php`, `templates/parts/content-none.php` — nowe: szablony
- `resources/css/app.css`, `resources/js/app.ts` — nowe: źródła front-endu (Tailwind v4 + DaisyUI, TS)
- `style.css` — Version 0.1.0 → 0.2.0, Requires PHP 7.4 → 8.1
- `wp-content/themes/xton-shop/CHANGELOG.md` — wydanie [0.2.0]
- `DECISIONS.md` — D-006..D-009 (klasyczny motyw, OOP/PSR-4, Vite/TW4/TS, DaisyUI+HyperUI); O-001 rozstrzygnięte; dodano O-003, O-004
- `ARCHITECTURE.md` — pełna architektura motywu (OOP, build, komponenty, WooCommerce, perf/SEO/a11y)
- `CLAUDE.md` — komendy build/dev motywu
- build: `dist/` (hashowane) wygenerowany lokalnie, ignorowany w git
- tag git: `theme-v0.2.0`

## 2026-07-28 13:06
Wprowadzenie wersjonowania motywu `xton-shop` (SemVer + tagi git), start v0.1.0.
- `wp-content/themes/xton-shop/style.css` — nowy: nagłówek motywu WordPress, `Version: 0.1.0`
- `wp-content/themes/xton-shop/CHANGELOG.md` — nowy: dziennik wydań motywu (SemVer)
- `wp-content/themes/xton-shop/.gitkeep` — usunięty (motyw ma już realne pliki)
- `DECISIONS.md` — dodano D-005 (schemat wersjonowania motywu)
- `ARCHITECTURE.md` — dodano sekcję „Wersjonowanie motywu"
- tag git: `theme-v0.1.0`

## 2026-07-28 13:02
Utworzenie systemu dokumentacji projektu (ARCHITECTURE / DECISIONS / CHANGELOG) i zapis zasady ich automatycznego prowadzenia w CLAUDE.md.
- `ARCHITECTURE.md` — nowy: dokumentacja techniczna i architektoniczna (stack, struktura repo, środowisko Local, motyw)
- `DECISIONS.md` — nowy: dziennik decyzji biznesowych/projektowych (D-001…D-004 + decyzje otwarte)
- `CHANGELOG.md` — nowy: ten plik
- `CLAUDE.md` — dodano sekcję o obowiązku automatycznego prowadzenia trzech plików dokumentacji

## 2026-07-28 ~13:00
Dodanie zdalnego repozytorium GitHub i wypchnięcie gałęzi `main`.
- (git) `git remote add origin https://github.com/xtonpolska/xton24.eu.git`
- (git) `git branch -M main`, `git push -u origin main`
- Uwaga: WooCommerce (`wp-content/plugins/woocommerce/`, v10.9.4) obecny lokalnie, ale ignorowany zgodnie z D-003

## 2026-07-28 ~12:50
Inicjalizacja repozytorium git i pierwszy commit.
- `.gitignore` — nowy: reguły dla WordPress/WooCommerce (pomija rdzeń, `wp-config.php`, uploady, cache, logi, motywy `twenty*`, `woocommerce/`)
- `wp-content/themes/xton-shop/.gitkeep` — nowy: szkielet motywu własnego
- pierwszy commit `Initial commit: struktura projektu WooCommerce`

## 2026-07-28 ~12:40
Analiza kodu i utworzenie dokumentacji dla Claude Code.
- `CLAUDE.md` — nowy: opis środowiska (WordPress 7.0.2 + Local), komendy WP-CLI, konwencje pracy

---

*Aktualizowane automatycznie.*
