# CHANGELOG.md

Dziennik zmian technicznych projektu xton24.eu. Prowadzony automatycznie przez Claude'a: każda zmiana zapisywana jest z **datą, godziną (CEST)** i **listą ruszanych plików**. Najnowsze wpisy na górze.

Format: `## YYYY-MM-DD HH:MM` → opis + lista plików.

---

## 2026-07-28 16:49
Sekcja „Kategorie" na stronie głównej — masonry/kolaż wg Figma (node 2210-3444), light mode.
- `wp-content/themes/xton-shop/templates/parts/home/categories.php` — nowy: nagłówek sekcji + siatka masonry (kafel szeroki + wysoki + zwykłe), kafle = ciemne zdjęcia z gradientem, tytuł Russo One, opis, CTA; hover (scale obrazu, przesunięcie strzałki)
- `wp-content/themes/xton-shop/front-page.php` — dołączona sekcja kategorii (po hero)
- `wp-content/themes/xton-shop/resources/css/app.css` — reużywalny `.section-head` + `.cat-collage` (1/2/3 kolumny, spany na ≥1024px) + kafle
- dane: kategorie pobrane z **xton24.pl** (Piaskarki, Systemy DPF, Myjki, Master Box, Chemia XPOWER, Materiały eksploatacyjne); grafiki placehold.co, linki `#` (do podmiany na taksonomie WooCommerce)
- weryfikacja: `php -l` OK, build OK, zrzuty desktop + mobile (izolowany podgląd)
- korekta wysokości kafli (`grid-auto-rows`): finalnie 22.5rem mobile / 26.25rem desktop

## 2026-07-28 16:41
Hero carousel na stronie głównej — ciemny panel w kontenerze, dissolve grafiki gradientem (frontend-design).
- `wp-content/themes/xton-shop/templates/parts/home/hero-carousel.php` — nowy: panel ciemny (radius 5px) w `.container`, treść+CTA po lewej, grafika (placehold.co) po prawej z gradientowym „dissolve"; kontrolki (kropki+strzałki) POZA panelem; dane placeholder
- `wp-content/themes/xton-shop/front-page.php` — dołączony hero carousel
- `wp-content/themes/xton-shop/resources/js/modules/hero-carousel.ts` — nowy: scroll-snap + strzałki/kropki, autoplay ~6 s z pauzą, własne wolne przejście (easing ~700 ms), `prefers-reduced-motion`, degradacja bez JS (swipe); `resources/js/app.ts` — import + init
- `wp-content/themes/xton-shop/resources/css/app.css` — style hero (dissolve, kontrolki, kropki gradientowe)
- fix: zmiana klasy wrappera `.hero` → `.hero-wrap` (kolizja z komponentem DaisyUI `.hero` łamała layout kontrolek — wykryte na podglądzie)
- weryfikacja wizualna: izolowany podgląd + zrzuty (desktop + mobile), `npm run typecheck` OK, `php -l` OK

## 2026-07-28 16:21
Stopka sklepu wg referencji Figma (node 2218-4147) w wariancie JASNYM (D-016).
- `wp-content/themes/xton-shop/footer.php` — przepisana: logo + 4 kolumny (informacje firmowe, kontakt z flagami, na skróty, o nas) + social + certyfikaty/partnerzy + pasek dolny (polityka prywatności / copyright); dane placeholder
- `wp-content/themes/xton-shop/assets/flags/{pl,eu,uk}.png` — flagi (PNG, kolorowe)
- `wp-content/themes/xton-shop/assets/certs/{ce,gs1,upr}.svg` — znaki certyfikacyjne, przekolorowane na `currentColor`
- `wp-content/themes/xton-shop/assets/logos/{rzetelna-firma.png,malopolska.png,nowy-sacz.svg}` — logotypy partnerów (kolorowe, as-is)
- logo i ikony social zreużyte z headera (`assets/img/xton-logo.svg`, `assets/icons/*.svg`)
- `wp-content/themes/xton-shop/resources/css/app.css` — style stopki (rozmiary logo/social/badge, `.footer-link`, `.footer-nav`)
- weryfikacja: `php -l` OK, klasy Tailwind + reguły CSS skompilowane (curl serwera dev), brak kolizji `id` clipPath; wizualnie do potwierdzenia (tryb „coming soon")

## 2026-07-28 16:09
Header sklepu wg referencji Figma (node 2401-10874) w wariancie JASNYM (D-016) + globalny `.container`.
- `wp-content/themes/xton-shop/header.php` — przepisany: górny pasek (kontakt + język) + główny (logo → nawigacja → social); responsywny (hamburger); ikony/logo inline SVG (currentColor)
- `wp-content/themes/xton-shop/assets/img/xton-logo.svg`, `assets/icons/{mail,phone,clock,globe,fb,ig,yt,tiktok,linkedin}.svg` — pobrane z Figmy, przekolorowane na `currentColor` (light mode)
- `wp-content/themes/xton-shop/functions.php` — helpery `xton_asset()`, `xton_inline_svg()`, fallback `xton_primary_menu_fallback()`
- `wp-content/themes/xton-shop/resources/css/app.css` — globalny `.container` (wycentrowany, max-width 1440px, px 24/32) + style nawigacji (carety, flyout, panel mobilny, toggle)
- `wp-content/themes/xton-shop/resources/js/modules/header-nav.ts` — toggle menu mobilnego (a11y); import w `resources/js/app.ts`
- `wp-content/themes/xton-shop/footer.php` — `.container` bez `mx-auto px-4` (obsługiwane globalnie)
- weryfikacja: `php -l` OK, `npm run typecheck` OK, klasy Tailwind + reguły CSS skompilowane (curl serwera dev); wizualnie do potwierdzenia (tryb „coming soon")

## 2026-07-28 15:48
Fix light mode: strona nadal renderowała się ciemna mimo usunięcia `xton-dark`.
- przyczyna: `@plugin "daisyui";` bez konfiguracji dołącza wbudowane motywy `light`+`dark`; wbudowany `dark` (`prefersdark`) nadpisywał `xton` przy systemowym `prefers-color-scheme: dark`
- `wp-content/themes/xton-shop/resources/css/app.css` — dodane `@plugin "daisyui" { themes: false; }` (tylko `xton`)
- weryfikacja (curl skompilowanego CSS z serwera dev): brak bloku `@media (prefers-color-scheme: dark)`, `:root` → `color-scheme: light; --color-base-100: #ffffff`
- `wp-content/themes/xton-shop/CHANGELOG.md` — zaktualizowany wpis D-014

## 2026-07-28 15:42
Light-only + czysty slate strony głównej: usunięty dark mode i wszystkie sekcje design-first (nie-„xtonowe").
- `wp-content/themes/xton-shop/resources/css/app.css` — usunięty motyw DaisyUI `xton-dark` (D-014) oraz CSS Swipera
- `wp-content/themes/xton-shop/front-page.php` — zredukowany do czystego szkieletu (bez `Template Name`, bez sekcji)
- `wp-content/themes/xton-shop/templates/parts/home/{carousel,categories,offers}.php` — usunięte (D-015)
- `wp-content/themes/xton-shop/resources/js/modules/hero-carousel.ts` — usunięty; `resources/js/app.ts` — usunięty import i `initHeroCarousel()`
- `wp-content/themes/xton-shop/app/Acf/Groups/HeroSlides.php` — usunięta; `app/Acf/Acf.php` — pusta lista `GROUPS`
- `wp-content/themes/xton-shop/package.json` — usunięta zależność `swiper` (npm install zsynchronizowany)
- weryfikacja: `npm run typecheck` zielony, brak osieroconych referencji (grep), `node_modules/swiper` usunięty
- `wp-content/themes/xton-shop/CHANGELOG.md`, `DECISIONS.md` — zaktualizowane (D-014, D-015)

## 2026-07-28 15:33
Fix: brak stylów w trybie dev (`npm run dev`) — URL-e Vite nie uwzględniały ścieżki `base`.
- `wp-content/themes/xton-shop/app/Assets/ViteAssets.php` — `enqueueDev()` dokleja prefiks `base` (z `distUri`) do `@vite/client` i modułu wejściowego; wcześniej 404 → CSS nie był wstrzykiwany
- diagnoza: curl `http://localhost:5173/@vite/client` = 404, z prefiksem base = 200
- `wp-content/themes/xton-shop/CHANGELOG.md` — wpis w [Unreleased] › Fixed

## 2026-07-28 15:14
Korekta fontów: Kanit 400 jako podstawowy + Russo One wyłącznie w 400 (bez faux-bold).
- `resources/fonts/kanit-400-*.woff2` — dodane (latin + latin-ext)
- `resources/css/fonts.css` — zregenerowany (10 faców: Kanit 300/400/500/600 + Russo One 400)
- `resources/css/app.css` — na foncie display wymuszone `font-weight: 400` + `font-synthesis: none`
- `DECISIONS.md` D-013 — uaktualniony opis fontów
- weryfikacja: build OK (kanit-400 zhashowany)

## 2026-07-28 15:02
Design tokens XTON z Figmy (Figma MCP) → motyw sklepu (jasny) + self-host fontów. Build zielony.
- `resources/fonts/*.woff2` — nowe: Russo One + Kanit (300/500/600), subsety latin+latin-ext
- `resources/css/fonts.css` — nowy: lokalne `@font-face` (font-display: swap, unicode-range)
- `resources/css/app.css` — motywy DaisyUI `xton` (jasny, domyślny) + `xton-dark`; tokeny `@theme` (fonty, kolory marki #FFD600/#FFA600/#171717/#FAFAFA, skala, radiusy 5px); `.btn-xton` (gradient CTA); fix: `*/` w komentarzu łamał build
- `resources/js/app.ts` — import `fonts.css` (Vite hashuje woff2)
- Efekt: komponenty DaisyUI przejmują branding (primary żółty, Russo One/Kanit, radius 5px)
- `DECISIONS.md` D-013, `ARCHITECTURE.md` (sekcja 5.3 design tokens)
- Źródło: Figma SeyTSejhtBQWSPRSGIZHR0, node 2232-3880
- Decyzja właściciela: sklep jasny (UX/konwersja/zaufanie)

## 2026-07-28 14:17
Usunięcie strony opcji ACF (na razie) — carousel jeszcze niepodpięty (etap testów właściciela).
- `app/Acf/Acf.php` — usunięto `registerOptionsPages()`, hook i stałą `OPTIONS_SLUG`; zostaje rejestracja grup pól
- `ARCHITECTURE.md` — zaktualizowany opis (brak strony opcji)
- weryfikacja: brak wiszących odwołań, `php -l` OK

## 2026-07-28 14:13
Zmiana lokalizacji pól hero: z globalnej strony opcji na szablon strony.
- `front-page.php` — dodano nagłówek `Template Name: Strona główna sklepu` (staje się Page Template)
- `app/Acf/Groups/HeroSlides.php` — lokalizacja `options_page` → `page_template == front-page.php`; usunięto nieużywany import `Acf`
- `ARCHITECTURE.md` / `DECISIONS.md` (D-012) — zaktualizowany opis lokalizacji
- Uwaga: strona opcji „Ustawienia motywu" jest teraz bez grup (kontener na przyszłe ustawienia globalne)
- weryfikacja: `php -l` OK, IDE diagnostics czyste

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
