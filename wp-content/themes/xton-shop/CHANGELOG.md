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
- **Sekcja „Kategorie" na stronie głównej** — masonry/kolaż wg referencji Figma (node 2210-3444), light mode: kafle to ciemne zdjęcia z gradientem (samo-kontrastujące) z tytułem Russo One, opisem i CTA; układ 1/2/3 kolumny (spany szeroki/wysoki na ≥1024px), hover (scale + strzałka). Reużywalny nagłówek `.section-head`. Kategorie pobrane z xton24.pl; grafiki/linki placeholder.
- **Hero carousel na stronie głównej** (frontend-design): ciemny panel zamknięty w `.container` (radius 5px), treść + CTA po lewej, grafika (placehold.co) po prawej z gradientowym „dissolve" (obraz rozpływa się w tle). Nagłówki w Russo One. Kontrolki (kropki + strzałki) poza panelem. Napędzany **Swiperem** (D-017) przez reużywalny init `swiper.ts` — autoplay ~6 s (pauza na hover), przejście 700 ms, pętla, `prefers-reduced-motion`. Dane placeholder.
- **Stopka sklepu wg referencji Figma (D-016), light mode:** logo + 4 kolumny (informacje firmowe, kontakt z flagami języka, na skróty, o nas), sekcja „Zaobserwuj nas" (social), blok certyfikatów (CE/GS1/UPR + flagi) i logotypów partnerów (Rzetelna Firma, Małopolska, Nowy Sącz), pasek dolny (polityka prywatności + copyright). Dane placeholder. Assety: `flags/`, `certs/` (przekolorowane na `currentColor`), `logos/`; logo i social zreużyte z headera.
- **Header sklepu wg referencji Figma (D-016), light mode:** górny pasek (e-mail/telefon/godziny + placeholder zmiany języka) i główny (logo → nawigacja → akcje e-commerce: lista życzeń / konto / koszyk z licznikiem, adresy z WooCommerce gdy aktywne). Responsywny — na mobile nawigacja pod przyciskiem (hamburger, moduł `header-nav.ts`, a11y: `aria-expanded`, Escape, klik poza, powrót na desktop). Nawigacja: `wp_nav_menu` (`primary`) z fallbackiem, carety przy pozycjach z podmenu, flyout na desktopie / panel na mobile.
- **Globalny `.container`:** wycentrowany, `max-width: 1440px` (≈1376px treści jak w Figmie), padding `24px` (mobile) / `32px` (≥1024px).
- **Assety statyczne** w `assets/` (`img/xton-logo.svg`, `icons/*.svg`) — pobrane z Figmy i przekolorowane na `currentColor` (sterowanie kolorem z CSS). Helpery `xton_asset()` (URL + cache-busting) i `xton_inline_svg()` (inline SVG z `assets/`).

### Fixed
- **Brak stylów w trybie dev (`npm run dev`):** `ViteAssets::enqueueDev()` kolejkował `@vite/client` i wejściowy moduł bez prefiksu ścieżki `base` (Vite serwuje moduły pod `base` z `vite.config.ts` = `/wp-content/themes/xton-shop/dist/`), przez co przeglądarka dostawała 404 i CSS nie był wstrzykiwany. URL-e dev doklejają teraz ścieżkę `base` wyliczaną z `distUri`.

### Added
- **Design tokens XTON (D-013):** motyw DaisyUI `xton` (jasny, **jedyny** — sklep wyłącznie w light mode, D-014); self-host fontów — Kanit (podstawowy, 400; 300/400/500/600) + Russo One (display, wyłącznie 400, bez faux-bold); kolory marki (#FFD600/#FFA600/#171717/#FAFAFA), skala tekstu, radiusy 5px; `.btn-xton` (gradient CTA).
- **Integracja ACF Pro w kodzie** (deklaratywnie, D-012): moduł `Acf\Acf`, kontrakt `Acf\FieldGroup` — szkielet bez zdefiniowanych grup (gotowy do dodania grup wg potrzeb).
- Zależność dev `@types/node` (na potrzeby `vite.config.ts`).
- Migracja klas do kanonicznego Tailwind v4 (`bg-linear-*`, skala odstępów, sufiks `!`).
- Kolejne szablony (single, page, archive, search) i bloki e-commerce z HyperUI. *(planowane)*

### Changed
- **Karuzele na Swiper 11 (D-017):** Swiper ponownie w `dependencies`; reużywalny init `[data-swiper]` (`resources/js/modules/swiper.ts`) — hero przeniesiony z własnego scroll-snap na Swiper. Odwraca usunięcie Swipera z D-015. Kolejne slidery = sam markup `.swiper` + opcje w `data-swiper`.
- **Sklep wyłącznie w light mode (D-014):** usunięty motyw DaisyUI `xton-dark` **oraz wyłączone wbudowane motywy DaisyUI** przez `@plugin "daisyui" { themes: false; }`. Bez tego wbudowany `dark` (z `prefersdark`) nadpisywał `xton` przy systemowym `prefers-color-scheme: dark`. Teraz `xton` (jasny) aplikuje się na `:root` zawsze.

### Removed
- **Sekcje strony głównej (design-first) — skasowane jako nie-„xtonowe" (D-015):** hero carousel + kategorie + oferty specjalne (`templates/parts/home/*`), moduł TS `hero-carousel.ts`, zależność **Swiper**, grupa ACF `HeroSlides`, CSS Swipera oraz `Template Name` z `front-page.php`. `front-page.php` = czysty szkielet do odbudowy wg referencji Figma XTON.

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
