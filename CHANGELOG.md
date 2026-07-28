# CHANGELOG.md

Dziennik zmian technicznych projektu xton24.eu. Prowadzony automatycznie przez Claude'a: każda zmiana zapisywana jest z **datą, godziną (CEST)** i **listą ruszanych plików**. Najnowsze wpisy na górze.

Format: `## YYYY-MM-DD HH:MM` → opis + lista plików.

---

## 2026-07-28 14:07
Infrastruktura ACF w kodzie (deklaratywnie, D-012) + pierwsza grupa pól (slajdy hero).
- `app/Acf/FieldGroup.php` — nowy: kontrakt grupy pól
- `app/Acf/Acf.php` — nowy: moduł Bootable (strona opcji „Ustawienia motywu" + rejestr grup na `acf/init`, no-op bez ACF)
- `app/Acf/Groups/HeroSlides.php` — nowy: repeater slajdów hero (eyebrow/title/text/image/cta/link)
- `app/Theme.php` — dodano moduł `Acf` do `MODULES`
- autoloader motywu przebudowany (`composer dump-autoload -o`)
- `DECISIONS.md` — D-012; `CLAUDE.md` — reguła „ACF tylko w kodzie"; `ARCHITECTURE.md` — moduł Acf
- weryfikacja: `php -l` OK; wymaga aktywnego ACF Pro, by pola pojawiły się w panelu

## 2026-07-28 14:02
ACF Pro 6.8.6 zainstalowany przez Composer do `wp-content/plugins/advanced-custom-fields-pro/`. Pozostaje aktywacja w WP.
- `composer.lock` (web root) — nowy: zablokowane wersje (`composer/installers` 2.3.0, `wpengine/advanced-custom-fields-pro` 6.8.6) — do repo
- `wp-content/plugins/advanced-custom-fields-pro/` — zainstalowane (ignorowane w git, D-011)
- `auth.json` — uzupełniony kluczem (ignorowany, poza repo)
- Do zrobienia: aktywacja wtyczki (WP admin lub `wp plugin activate advanced-custom-fields-pro`)

## 2026-07-28 13:55
Przygotowanie instalacji ACF Pro przez Composer (site-level). Instalacja czeka na klucz licencyjny.
- `composer.json` (web root) — nowy: repozytorium connect ACF + `composer/installers` + `wpengine/advanced-custom-fields-pro`; installer-paths do `wp-content/plugins/`
- `.gitignore` — dodano `auth.json`, `/vendor/`, `wp-content/plugins/advanced-custom-fields-pro/`
- `DECISIONS.md` — dodano D-011
- Pozostało (po podaniu klucza): `composer update` → wtyczka w `wp-content/plugins/`, aktywacja, ew. `composer.lock` do repo

## 2026-07-28 13:51
Front sklepu (design-first): strona główna z carouselem, kategoriami i ofertami specjalnymi. Build + typecheck zielone.
- `front-page.php` — nowy: kompozycja strony głównej (3 sekcje)
- `templates/parts/home/carousel.php` — nowy: hero carousel (Swiper), dane placeholder
- `templates/parts/home/categories.php` — nowy: siatka kategorii
- `templates/parts/home/offers.php` — nowy: karty ofert specjalnych (przeceny)
- `resources/js/modules/hero-carousel.ts` — nowy: inicjalizacja Swipera (A11y, reduced-motion)
- `resources/js/app.ts` — import i wywołanie `initHeroCarousel()`
- `resources/css/app.css` — style paginacji Swipera + fallback bez JS
- `package.json` — dodano `swiper`, `@types/node`
- migracja klas do kanonicznego Tailwind v4 (carousel/categories/offers)
- weryfikacja: `npm run typecheck` (EXIT 0), `npm run build` OK, `php -l` OK, IDE diagnostics czyste
- Uwaga: przy wydaniu tej funkcji → bump motywu do 0.3.0 + tag `theme-v0.3.0` (decyzja właściciela, D-010)

## 2026-07-28 13:27
Zasada: brak automatycznych operacji git (commit/push/tag należą do właściciela).
- `CLAUDE.md` — dodano sekcję „Git — NIE commituj ani nie pushuj automatycznie"
- `DECISIONS.md` — dodano D-010

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
