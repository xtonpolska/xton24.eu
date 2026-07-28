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
- Kolejne szablony (single, page, archive, search) i bloki e-commerce z HyperUI.

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
