# Changelog — motyw Xton Shop

Wszystkie wydania motywu `xton-shop`. Wersjonowanie wg [SemVer](https://semver.org/lang/pl/): `MAJOR.MINOR.PATCH`.

Źródło prawdy dla numeru wersji: pole `Version:` w `style.css`. Każde wydanie oznaczane tagiem git `theme-vX.Y.Z`.

Zasady bumpowania:
- **MAJOR** — zmiany łamiące (przebudowa struktury motywu, niekompatybilne zmiany szablonów).
- **MINOR** — nowa funkcjonalność wstecznie zgodna (nowe szablony, sekcje, wsparcie funkcji WooCommerce).
- **PATCH** — poprawki błędów, drobne korekty stylów/tekstów.
- `0.x.y` = faza rozwoju przed pierwszym stabilnym wydaniem `1.0.0`.

---

## [Unreleased]
### Added
- **Strona główna** (`front-page.php`) z trzema sekcjami (design-first, dane placeholder):
  - **Hero carousel** na Swiper 11 (moduł TS `hero-carousel.ts`): autoplay z pauzą, klawiatura, A11y, wyłączenie przy `prefers-reduced-motion`, progresywne wzbogacanie (1 slajd bez JS).
  - **Kategorie** — responsywna siatka kafli (2/3/6 kolumn).
  - **Oferty specjalne** — karty produktów z badge przeceny, oceną, ceną promocyjną, CTA.
- Zależności front-end: `swiper`, `@types/node`.
- **Integracja ACF Pro w kodzie** (deklaratywnie, D-012): moduł `Acf\Acf`, kontrakt `Acf\FieldGroup`, grupa `Groups\HeroSlides` (repeater slajdów hero) przypięta do szablonu `front-page.php` — gotowe do podpięcia carousela.
- `front-page.php` otrzymał nagłówek `Template Name: Strona główna sklepu` (dostępny jako Page Template).
- Sekcje iterują po tablicach PHP (`$slides`/`$categories`/`$offers`) — gotowe do podpięcia pod WooCommerce bez zmian markупu.
- Migracja klas do kanonicznego Tailwind v4 (`bg-linear-*`, skala odstępów, sufiks `!`).
- Kolejne szablony (single, page, archive, search) i bloki e-commerce z HyperUI. *(planowane)*

## [0.2.0] — 2026-07-28
### Added
- **Architektura OOP + PSR-4** (Composer, namespace `XtonShop\` → `app/`): `Theme` (bootstrap), interfejs `Bootable`, moduły `ThemeSupport`, `Menus`, `Cleanup`, `WooCommerce`, `ViteAssets`.
- **Build Vite 6 + Tailwind v4 + TypeScript** z **hashowanymi** artefaktami i mapowaniem przez `dist/.vite/manifest.json`; tryb dev z HMR (plik `dist/hot`).
- **DaisyUI** jako baza komponentów (plugin TW4, CSS-only); HyperUI jako źródło bloków e-commerce.
- Klasyczne szablony: `functions.php`, `index.php`, `header.php`, `footer.php`, `templates/parts/content*.php`.
- Integracja WooCommerce (wsparcie galerii, własne wrappery treści).
- Optymalizacje: czyszczenie `<head>`, wyłączenie emoji; a11y: skip-link, `aria-label`, `sr-only`.
- Konfiguracja: `composer.json`, `package.json`, `vite.config.ts`, `tsconfig.json`, `.gitignore`.
### Changed
- `Requires PHP` podniesione do **8.1** (nowoczesny kod, bez długu technologicznego).

## [0.1.0] — 2026-07-28
### Added
- Inicjalny szkielet motywu: `style.css` z nagłówkiem WordPress i wersją startową.
- Wprowadzenie wersjonowania SemVer + tagi git `theme-vX.Y.Z`.
