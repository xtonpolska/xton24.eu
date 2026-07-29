# DECISIONS.md

Dziennik **decyzji biznesowych i projektowych** podjętych przez właściciela projektu (Marcin, md@idstar.pl). Claude zapisuje tu każdą decyzję, aby móc do niej wracać i się nią kierować. Kwestie czysto techniczne → [ARCHITECTURE.md](ARCHITECTURE.md).

Format wpisu: data, decyzja, kontekst/uzasadnienie, status.

---

## Rejestr decyzji

### D-001 — Platforma sklepu: WordPress + WooCommerce
- **Data:** 2026-07-28
- **Decyzja:** Sklep xton24.eu budowany na WordPress + WooCommerce, z własnym motywem `xton-shop`.
- **Status:** ✅ Przyjęta

### D-002 — Repozytorium kodu na GitHub
- **Data:** 2026-07-28
- **Decyzja:** Kod projektu wersjonowany w git i hostowany na GitHub: `xtonpolska/xton24.eu`, gałąź główna `main`.
- **Status:** ✅ Przyjęta

### D-003 — Zakres wersjonowania: tylko kod własny
- **Data:** 2026-07-28
- **Decyzja:** W repo trzymamy wyłącznie kod własny (motyw, przyszłe wtyczki). Rdzeń WordPressa, wtyczka WooCommerce (z wp.org), uploady, cache i logi są ignorowane.
- **Uzasadnienie:** Lekkie repo; rdzeń i WooCommerce aktualizowane niezależnie przez Word. Standard branżowy.
- **Status:** ✅ Przyjęta

### D-004 — Dokumentacja projektu: ARCHITECTURE / DECISIONS / CHANGELOG
- **Data:** 2026-07-28
- **Decyzja:** Projekt prowadzi trzy pliki dokumentacji, uzupełniane automatycznie przez Claude'a: `ARCHITECTURE.md` (technika), `DECISIONS.md` (decyzje biznesowe/projektowe), `CHANGELOG.md` (dziennik zmian z datą, godziną i listą plików).
- **Status:** ✅ Przyjęta

### D-005 — Wersjonowanie motywu `xton-shop` (SemVer + tagi git)
- **Data:** 2026-07-28
- **Decyzja:** Motyw wersjonowany wg SemVer (`MAJOR.MINOR.PATCH`), start od `0.1.0`. Źródło prawdy: pole `Version:` w `style.css`. Każde wydanie oznaczane tagiem git `theme-vX.Y.Z`. Ciąg wydań prowadzony w `wp-content/themes/xton-shop/CHANGELOG.md`.
- **Uzasadnienie:** Możliwość śledzenia i aktualizowania motywu wg jasnego ciągu wersji; `0.x` = faza przed stabilnym `1.0.0`.
- **Status:** ✅ Przyjęta

### D-006 — Typ motywu: klasyczny, custom (rozstrzyga O-001)
- **Data:** 2026-07-28
- **Decyzja:** Motyw **klasyczny** (PHP: `functions.php`, `header.php`, `index.php`, szablony w `templates/`), w pełni customowy — bez motywu blokowego i bez frameworka typu Sage/Timber.
- **Status:** ✅ Przyjęta

### D-007 — Architektura PHP: OOP + PSR-4 (Composer)
- **Data:** 2026-07-28
- **Decyzja:** Logika motywu w OOP. Autoloading PSR-4 przez Composer, namespace `XtonShop\` → katalog `app/`. Moduły implementują interfejs `Bootable` i są bootowane przez `XtonShop\Theme::boot()` z `functions.php`.
- **Uzasadnienie:** Testowalność, czysty podział odpowiedzialności, brak długu technologicznego.
- **Status:** ✅ Przyjęta

### D-008 — Build front-end: Vite + Tailwind v4 + TypeScript, hashowane buildy
- **Data:** 2026-07-28
- **Decyzja:** Bundler **Vite 6**, **Tailwind CSS v4** (`@tailwindcss/vite`), **TypeScript** od startu. Buildy **hashowane**, mapowane w PHP przez `dist/.vite/manifest.json` (klasa `Assets\ViteAssets`). Tryb dev z HMR via plik `dist/hot`. Menedżery: **Composer** (PHP) + **npm** (JS).
- **Uzasadnienie:** Nowoczesny, wydajny build; cache-busting przez hash; TS eliminuje dług technologiczny „na dzień dobry".
- **Status:** ✅ Przyjęta

### D-009 — Biblioteka komponentów: DaisyUI + HyperUI
- **Data:** 2026-07-28
- **Decyzja:** **DaisyUI** (plugin Tailwind, CSS-only, semantyczne klasy, motywowanie pod markę) jako baza komponentów + **HyperUI** (MIT, copy-paste) jako źródło darmowych bloków e-commerce (karty produktu, siatki, koszyk, checkout). Bez cudzego JS runtime — pełna kontrola nad a11y i wydajnością.
- **Uzasadnienie:** Środek między lekkością Daisy a bogactwem gotowych bloków; dużo darmowych komponentów e-commerce bez narzutu JS.
- **Status:** ✅ Przyjęta

### D-010 — Operacje git tylko na decyzję właściciela
- **Data:** 2026-07-28
- **Decyzja:** Claude **nie** commituje ani **nie** pushuje automatycznie. Może przygotowywać zmiany w plikach i **sugerować** komendy git, ale wykonanie `commit`/`push`/`tag` należy do właściciela. Komendy tylko do odczytu (`status`, `diff`, `log`) są dozwolone.
- **Uzasadnienie:** Pełna kontrola właściciela nad historią repo.
- **Status:** ✅ Przyjęta

### D-011 — ACF Pro przez Composer (wtyczki site-level)
- **Data:** 2026-07-28
- **Decyzja:** Zaawansowane pola tworzymy w **ACF Pro**. Wtyczki premium zarządzamy przez **root `composer.json`** (web root) z `composer/installers` — ACF Pro instalowane z repozytorium WP Engine `https://connect.advancedcustomfields.com` do `wp-content/plugins/advanced-custom-fields-pro/`.
- **Wersjonowanie:** commitujemy `composer.json` + `composer.lock` (reprodukowalność). **Nie** commitujemy samej wtyczki (płatna, licencja) ani `auth.json` (sekret) — są w `.gitignore`. Odtworzenie: `composer install` z kluczem w `auth.json`.
- **Uzasadnienie:** Powtarzalne, wersjonowane zarządzanie wtyczkami; brak binariów w repo; klucz licencyjny poza repo.
- **Status:** ✅ Przyjęta

### D-012 — Pola ACF deklaratywnie w kodzie (nie w panelu)
- **Data:** 2026-07-28
- **Decyzja:** Wszystkie grupy pól i strony opcji ACF definiujemy **w kodzie** (`acf_add_local_field_group()` / `acf_add_options_page()` na hooku `acf/init`), wersjonowane w repo. **Nie** tworzymy ich w panelu. Panel służy wyłącznie do wypełniania treści.
- **Realizacja:** moduł `app/Acf/Acf.php` (Bootable), kontrakt `app/Acf/FieldGroup.php`, definicje w `app/Acf/Groups/`. Pierwsza grupa: `HeroSlides` (repeater), przypięta do szablonu strony `front-page.php` (Template Name „Strona główna sklepu") — zasili carousel.
- **Uzasadnienie:** Powtarzalność, przenośność między środowiskami, kod-review, brak rozjazdu DB↔kod, brak „klikologii".
- **Status:** ✅ Przyjęta

### D-013 — Design tokens XTON + sklep jasny
- **Data:** 2026-07-28
- **Decyzja:** Identyfikacja wizualna wg referencji Figma (XTON homepage marketing). Sklep **jasny** (lepszy UX/konwersja/zaufanie), z brandingiem XTON jako akcenty. Tokeny:
  - **Fonty:** **Kanit** (font podstawowy, waga **400**; dostępne 300/400/500/600) + **Russo One** (font display, **wyłącznie waga 400** — brak pogrubienia, bez faux-bold). **Self-hosted** (woff2, latin+latin-ext).
  - **Kolory:** primary żółć **#FFD600**, pomarańcz **#FFA600** (gradient CTA), ink **#171717**, light **#FAFAFA**.
  - **Radiusy:** 5px (pola/przyciski), bordery cienkie (1px).
- **Realizacja:** motyw DaisyUI `xton` (jasny), tokeny `@theme` w `resources/css/app.css`. *(Pierwotnie z opcjonalnym `xton-dark` — usunięty w D-014.)*
- **Źródło:** Figma `SeyTSejhtBQWSPRSGIZHR0`, node `2232-3880` (Figma MCP).
- **Status:** ✅ Przyjęta

---

### D-014 — Sklep wyłącznie w trybie jasnym (light mode)
- **Data:** 2026-07-28
- **Decyzja:** Sklep prowadzimy **wyłącznie w light mode**. Usunięty motyw DaisyUI `xton-dark` oraz wyłączone wbudowane motywy DaisyUI (`@plugin "daisyui" { themes: false; }`) — inaczej wbudowany `dark` (z `prefersdark`) nadpisywał `xton` przy systemowym `prefers-color-scheme: dark`. `xton` (jasny) jest jedynym motywem i aplikuje się na `:root` zawsze.
- **Uzasadnienie:** spójność wizualna z brandingiem XTON, prostsze utrzymanie (jeden zestaw tokenów), lepsza kontrola konwersji. Doprecyzowuje D-013.
- **Status:** ✅ Przyjęta

---

### D-015 — Skasowanie sekcji strony głównej (design-first) i odbudowa wg XTON
- **Data:** 2026-07-28
- **Decyzja:** Usunięte wszystkie sekcje strony głównej zbudowane na etapie design-first (hero carousel, kategorie, oferty specjalne) — nie oddawały brandu XTON. Wraz z nimi skasowany kod pomocniczy: moduł `hero-carousel.ts`, zależność **Swiper**, grupa ACF `HeroSlides`, CSS Swipera. `front-page.php` = czysty szkielet.
- **Uzasadnienie:** placeholderowy layout był niezgodny z identyfikacją XTON; zamiast poprawiać, budujemy stronę główną od nowa wg referencji Figma. Infrastruktura (Vite, DaisyUI, moduł ACF, tokeny) pozostaje.
- **Status:** ✅ Przyjęta

---

### D-016 — Figma jako referencja (nie 1:1); header w light mode
- **Data:** 2026-07-28
- **Decyzja:** Plik Figma (XTON homepage — marketing) traktujemy jako **referencję wizualną, nie makietę 1:1**. Kopiujemy wybrane elementy i dostosowujemy je do potrzeb **sklepu** (nie strony firmowej). Header zaimplementowany wg sekcji Figma (node `2401-10874`), ale w wariancie **jasnym** (spójnie z D-014) — ikony/logo z Figmy przekolorowane na `currentColor`.
- **Uzasadnienie:** Figma to projekt strony marketingowej; sklep ma inne priorytety (konwersja, listingi, koszyk). Bierzemy branding i wybrane sekcje, resztę projektujemy pod e-commerce.
- **Konwencja `.container`:** globalnie wycentrowany, `max-width 1440px`, padding `24px` (mobile) / `32px` (desktop ≥1024px).
- **Źródło:** Figma `SeyTSejhtBQWSPRSGIZHR0`, node `2401-10874` (Figma MCP).
- **Status:** ✅ Przyjęta

---

### D-017 — Karuzele/slidery na Swiper (standard motywu)
- **Data:** 2026-07-29
- **Decyzja:** Wszystkie karuzele w motywie obsługuje **Swiper 11**, przez **reużywalny inicjalizator** `[data-swiper]` (`resources/js/modules/swiper.ts`). Hero na stronie głównej przeniesiony z własnego scroll-snap na Swiper. Kolejne slidery dodaje się samym markupem (`.swiper`/`.swiper-wrapper`/`.swiper-slide` + opcje w `data-swiper`).
- **Uzasadnienie:** dojrzała biblioteka (touch, a11y, autoplay, pętla, efekty) i jeden standard zamiast pisania własnej mechaniki za każdym razem. **Odwraca** usunięcie Swipera z D-015 (usunięty wtedy razem z porzuconymi sekcjami design-first, nie z powodu wady biblioteki).
- **Realizacja:** `swiper` w `dependencies` (package.json); strzałki/paginacja mogą leżeć POZA `.swiper` (klasy `.swiper-prev`/`.swiper-next`/`.swiper-pagination`, wiązane w obrębie wrappera); `prefers-reduced-motion` wyłącza autoplay i animację przejścia.
- **Status:** ✅ Przyjęta

---

## Decyzje otwarte / do podjęcia

- **O-002 — WooCommerce w repo:** obecnie ignorowany (D-003). Do rozważenia zamrożenie konkretnej wersji w repo, jeśli zajdzie potrzeba. — **oczekuje na decyzję**
- **O-003 — Pipeline deployu/buildu:** `dist/` jest ignorowany w git (buildowany przez `npm run build`). Do ustalenia sposób deployu na produkcję (build na serwerze / w CI / commit artefaktów). — **oczekuje na decyzję**
- **O-004 — SEO:** wtyczka (Yoast / RankMath) czy własna warstwa meta/schema w motywie? Motyw dba o semantykę i `title-tag`, ale schema/OG do ustalenia. — **oczekuje na decyzję**

---

*Aktualizowane automatycznie. Ostatnia aktualizacja: 2026-07-29 14:42.*
