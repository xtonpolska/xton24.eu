# ARCHITECTURE.md

Dokumentacja techniczna i architektoniczna projektu **xton24.eu** — sklepu opartego na WordPress + WooCommerce. Plik prowadzony automatycznie przez Claude'a przy każdej zmianie technicznej (zob. [CLAUDE.md](CLAUDE.md)).

> Zakres: „jak to jest zbudowane". Decyzje biznesowe/projektowe → [DECISIONS.md](DECISIONS.md). Historia zmian → [CHANGELOG.md](CHANGELOG.md).

---

## 1. Przegląd

Sklep e-commerce **xton24.eu** na stacku WordPress + WooCommerce, rozwijany lokalnie w środowisku **Local (by Flywheel)**. Cały kod własny zamknięty jest w motywie `wp-content/themes/xton-shop` (obecnie szkielet do zbudowania) oraz — w przyszłości — we własnych wtyczkach.

## 2. Stack technologiczny

| Warstwa            | Technologia                                   |
|--------------------|-----------------------------------------------|
| CMS / rdzeń        | WordPress **7.0.2**                            |
| E-commerce         | WooCommerce **10.9.4**                         |
| Język              | PHP (wymagane **7.4+** przez WooCommerce)     |
| Baza danych        | MySQL (via Local), baza `local`, prefix `wp_` |
| Serwer WWW         | nginx / Apache (zarządzane przez Local)       |
| Środowisko dev     | Local by Flywheel (Windows)                   |
| Motyw własny       | `xton-shop` (klasyczny, OOP)                  |
| Build front-end    | Vite 6, Tailwind CSS v4, TypeScript, DaisyUI  |
| Fonty (self-host)  | Russo One (nagłówki), Kanit (treść)           |
| Design tokens      | wg Figmy XTON (D-013) — sklep jasny + akcenty |
| Menedżery pakietów | Composer (PHP, PSR-4), npm (JS)               |

## 3. Struktura repozytorium

Repo git zainicjowane w web roocie WordPressa (`app/public`). **Wersjonujemy tylko kod własny**, nie rdzeń WordPressa ani wtyczki z wp.org.

```
app/public/               ← web root = katalog repozytorium git
├── CLAUDE.md             ← instrukcje dla Claude Code
├── ARCHITECTURE.md       ← ten plik
├── DECISIONS.md          ← dziennik decyzji biznesowych/projektowych
├── CHANGELOG.md          ← dziennik zmian technicznych
├── .gitignore            ← pomija rdzeń, sekrety, uploady, cache, logi, woocommerce
├── wp-config.php         ← IGNOROWANY (sekrety, dane bazy)
├── wp-admin/ wp-includes/← rdzeń WordPressa (ignorowany, aktualizowany osobno)
└── wp-content/
    ├── plugins/
    │   └── woocommerce/  ← ignorowany (wtyczka z wp.org)
    ├── themes/
    │   ├── twenty*/      ← domyślne motywy (ignorowane)
    │   └── xton-shop/    ← MOTYW WŁASNY (wersjonowany)
    └── uploads/          ← ignorowany (media użytkownika)
```

Zdalne repozytorium: **https://github.com/xtonpolska/xton24.eu** (gałąź `main`).

## 4. Środowisko lokalne (Local by Flywheel)

- Konfiguracja serwera generowana przez Local w `../../conf/` (`mysql/`, `nginx/`, `php/`) z szablonów `.hbs` — **nie edytować ręcznie**, zmieniać przez aplikację Local.
- `wp-config.php`: `DB_NAME=local`, `DB_USER=root`, `DB_PASSWORD=root`, `DB_HOST=localhost`, `WP_ENVIRONMENT_TYPE=local`.
- Domena lokalna: wg slugu witryny — zwykle `http://xton24eu.local`.
- WP-CLI dostępne przez **Local → prawy klik na witrynie → Open site shell**.

## 5. Motyw `xton-shop`

Stan: **v0.2.0** — klasyczny motyw OOP z buildem Vite. Typ: **klasyczny, custom** (D-006).

### 5.1 Architektura PHP (OOP + PSR-4)

- Autoloading PSR-4 (Composer): namespace `XtonShop\` → katalog `app/`.
- `functions.php` ładuje `vendor/autoload.php` i woła `XtonShop\Theme::boot()`.
- `Theme` (singleton) rejestruje moduły z listy `MODULES`; każdy moduł implementuje interfejs `Support\Contracts\Bootable` i podpina swoje hooki w `boot()`.

```
app/
├── Theme.php                      // bootstrap, rejestr modułów
├── Support/Contracts/Bootable.php // interfejs modułu
├── Assets/ViteAssets.php          // ładowanie hashowanych assetów (manifest + HMR)
├── Setup/
│   ├── ThemeSupport.php           // add_theme_support (WP + WooCommerce)
│   ├── Menus.php                  // register_nav_menus (primary, footer)
│   ├── Cleanup.php                // czyszczenie <head>, wyłączenie emoji (perf)
│   └── WooCommerce.php            // własne wrappery treści sklepu
└── Acf/
    ├── Acf.php                    // Bootable: rejestr grup (acf/init)
    └── FieldGroup.php             // kontrakt: definition(): array
```

**ACF Pro — pola deklaratywnie w kodzie (D-011, D-012).** ACF Pro instalowany przez root `composer.json`. Grupy pól rejestrujemy w kodzie (`acf_add_local_field_group()` na `acf/init`) — nigdy w panelu. Nowa grupa = klasa w `app/Acf/Groups/` implementująca `FieldGroup`, dodana do `Acf::GROUPS`. Moduł jest no-op, gdy ACF nieaktywny.

Obecnie brak zdefiniowanych grup pól (`Acf::GROUPS` jest pusta) — grupa `HeroSlides` została usunięta wraz z sekcjami strony głównej (D-015). Nową grupę dodaje się jako klasę w `app/Acf/Groups/`. (Strona opcji „Ustawienia motywu" również usunięta — dodamy, gdy pojawią się ustawienia globalne.)

Szablony klasyczne: `index.php`, `front-page.php`, `header.php`, `footer.php`, części w `templates/parts/`.

Strona główna (`front-page.php`) to obecnie **czysty szkielet** (`<main>` bez treści) — pierwotne sekcje design-first (hero carousel, kategorie, oferty) usunięto jako nie-„xtonowe" (D-015). Do odbudowy od nowa wg referencji Figma XTON.

**Helpery szablonów (`functions.php`):** `xton_asset($rel)` — URL statycznego assetu z `assets/` + cache-busting po `XTON_SHOP_VERSION`; `xton_inline_svg($rel)` — inline'uje SVG z `assets/` (zaufane pliki motywu) tak, że ikony używają `currentColor`; `xton_primary_menu_fallback()` — fallback menu `primary`, gdy nie przypisano menu w panelu.

**Assety statyczne** (`assets/`, poza pipeline'em Vite): `img/` (logo) i `icons/` (SVG). Pobrane z Figmy i przekolorowane na `currentColor`, żeby kolorem sterował CSS (light mode, D-014/D-016).

### 5.1.1 Header (D-016, light mode)

`header.php` odwzorowuje sekcję nagłówka z Figmy (node `2401-10874`) w wariancie jasnym:
- **Górny pasek** (`.site-header__topbar`): e-mail, telefon, godziny + placeholder zmiany języka (TODO: i18n, np. Polylang).
- **Główny pasek**: logo (`xton_inline_svg`) → nawigacja `primary` (`wp_nav_menu` + fallback) → ikony social.
- **Responsywność:** `<1024px` nawigacja chowa się pod hamburgerem (`.site-nav-toggle`) i rozwija jako panel (`.primary-navigation.is-open`); sterowanie: `resources/js/modules/header-nav.ts` (a11y: `aria-expanded`, Escape, klik poza, reset przy powrocie na desktop). Podmenu: flyout na desktopie (`:hover`/`:focus-within`), inline na mobile.
- Style nawigacji i **globalny `.container`** (wycentrowany, `max-width 1440px`, padding `24px`/`32px`) w `resources/css/app.css` (reguły poza `@layer`, by wygrywały z utilities).

### 5.2 Build front-end (Vite + Tailwind v4 + TypeScript)

- Źródła w `resources/` (`css/app.css`, `js/app.ts`). Wyjście: `dist/` (hashowane, **gitignore**).
- **Tailwind v4** przez `@tailwindcss/vite`; **DaisyUI** jako plugin (`@plugin "daisyui"` w `app.css`); skanowanie klas w PHP przez `@source`.
- **Hashowane buildy:** `ViteAssets` czyta `dist/.vite/manifest.json` i kolejkuje pliki po hashu (bez `?ver`). Klucz wejścia: `resources/js/app.ts` → `file` + `css[]`.
- **Tryb dev (HMR):** `npm run dev` uruchamia serwer Vite (port 5173) i zapisuje `dist/hot`; `ViteAssets` wykrywa ten plik i ładuje moduły z serwera dev zamiast z manifestu. Inline plugin w `vite.config.ts` tworzy/usuwa `dist/hot`.
- Skrypty ładowane jako `type="module"` (filtr `script_loader_tag`).

### 5.3 Design tokens / branding (D-013)

Identyfikacja wizualna XTON (z Figmy) jako tokeny w `resources/css/app.css`:
- **Fonty (self-hosted, `resources/fonts/*.woff2`, latin+latin-ext):** `Russo One` (nagłówki, token `--font-display`) + `Kanit` 300/500/600 (treść, `--font-sans`). Ładowane przez `resources/css/fonts.css` (import w `app.ts` → Vite hashuje woff2).
- **Motyw DaisyUI:** `xton` (jasny) — **jedyny** motyw; sklep prowadzony wyłącznie w light mode (D-014), systemowy dark mode nie przełącza wyglądu.
- **Kolory marki:** primary `#FFD600` (żółć), secondary/accent `#FFA600` (pomarańcz), base dark `#171717`, tekst `#FAFAFA`. CTA gradient przez `.btn-xton`. Dodatkowo utilities `bg-xton-*`/`text-xton-*` (`@theme`).
- **Kształt:** radiusy 5px (`--radius-field/-selector`), box 8px, bordery 1px.
- **Skala:** `--text-display` (61px, Russo One), `--text-lead` (20px).

### 5.4 Komponenty UI (D-009)

- **DaisyUI** (CSS-only, bez JS) — baza komponentów i motywowanie (`data-theme`).
- **HyperUI** (MIT, copy-paste) — źródło darmowych bloków e-commerce; markup wklejany do `templates/` i stylowany klasami Tailwind/DaisyUI, z dbałością o a11y.

### 5.5 Integracja WooCommerce

- `add_theme_support('woocommerce')` + galeria (zoom/lightbox/slider) w `ThemeSupport`.
- `Setup\WooCommerce` podmienia domyślne wrappery (`woocommerce_before/after_main_content`) na markup layoutu motywu; aktywne tylko gdy WooCommerce działa.
- Nadpisywanie szablonów WooCommerce: kopie do `xton-shop/woocommerce/` (nigdy edycja w katalogu wtyczki).

### 5.6 Wydajność / SEO / dostępność

- Perf: `Cleanup` usuwa zbędne meta i emoji; moduły JS są deferowane; assety hashowane (długi cache).
- SEO: `title-tag`, semantyczny HTML, poprawna hierarchia nagłówków. Warstwa schema/OG → O-004.
- A11y: skip-link, `aria-label` nawigacji, `sr-only`/`not-sr-only`, `lazy` na miniaturach.

### Wersjonowanie motywu (D-005)

- Schemat: **SemVer** `MAJOR.MINOR.PATCH`, start `0.1.0` (`0.x` = przed stabilnym `1.0.0`).
- **Źródło prawdy:** pole `Version:` w `wp-content/themes/xton-shop/style.css`.
- Każde wydanie = **tag git** `theme-vX.Y.Z` (np. `theme-v0.1.0`).
- Ciąg wydań opisany w `wp-content/themes/xton-shop/CHANGELOG.md` (sekcja `[Unreleased]` → wydanie).
- Bump: MAJOR = zmiany łamiące, MINOR = nowa funkcja wstecznie zgodna, PATCH = poprawki.
- Przy każdym wydaniu: zaktualizuj `Version:` w `style.css`, przenieś wpisy z `[Unreleased]` do nowej sekcji w changelogu motywu, utwórz tag git.

## 6. Konwencje techniczne

- Nigdy nie modyfikować rdzenia WordPressa ani wtyczek z wp.org — nadpisywane przy aktualizacji. Cały kod własny w `wp-content/themes/xton-shop` (lub własnych wtyczkach).
- Nadpisywanie szablonów WooCommerce wyłącznie przez kopię do `xton-shop/woocommerce/` (nigdy edycja w katalogu wtyczki).
- Zmiany serwera/PHP przez aplikację Local, nie przez pliki w `conf/`.

---

*Aktualizowane automatycznie. Ostatnia aktualizacja: 2026-07-28 16:09.*
