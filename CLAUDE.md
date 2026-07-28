# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Dokumentacja projektu — prowadź ją automatycznie (WAŻNE)

Projekt utrzymuje trzy pliki dokumentacji w web roocie. **Aktualizuj je automatycznie, bez proszenia**, w ramach wykonywanej pracy — to stała zasada tego projektu (decyzja D-004):

- **`ARCHITECTURE.md`** — cała wiedza techniczna i architektoniczna (stack, struktura, integracje, konwencje). Aktualizuj przy **każdej zmianie technicznej** wpływającej na architekturę.
- **`DECISIONS.md`** — dziennik decyzji **biznesowych i projektowych** właściciela. Gdy użytkownik podejmie decyzję (np. wybór technologii, funkcji, kierunku), **dopisz nowy wpis `D-NNN`** z datą, treścią i uzasadnieniem. Zanim zaproponujesz rozwiązanie, sprawdź ten plik, by działać zgodnie z wcześniejszymi ustaleniami.
- **`CHANGELOG.md`** — dziennik zmian technicznych. Po **każdej** modyfikacji kodu/plików dopisz na górze wpis z **datą, godziną i listą ruszanych plików**.

Zasady prowadzenia:
- Pobieraj realną datę/godzinę komendą (`date "+%Y-%m-%d %H:%M"`) — nie zgaduj czasu.
- Najnowsze wpisy w CHANGELOG na górze. Aktualizuj stopkę „Ostatnia aktualizacja" w ARCHITECTURE/DECISIONS.
- Dołączaj te pliki do commitów razem ze zmianami, których dotyczą.
- Język dokumentacji: polski (zgodnie z komunikacją z właścicielem).

## What this is

A **WordPress 7.0.2** site served from a **Local (by Flywheel)** development environment. The working directory (`app/public`) is the WordPress web root. The site's only custom development target is the theme **`wp-content/themes/xton-shop`**, which is currently **empty** — it is intended to be built out from scratch. Everything else in this directory is WordPress core (`wp-admin/`, `wp-includes/`, root `wp-*.php`) or bundled default themes (`twentytwentytwo`…`twentytwentyfive`).

There is no build tooling, package manager, test suite, or plugin code present yet. Do not invent commands for tools that aren't here.

## Environment

- Managed by the **Local** desktop app. The MySQL, nginx/Apache, and PHP configs live one level up in `../../conf/` (`mysql/`, `nginx/`, `php/`) and are generated from `.hbs` templates by Local — edit site config through the Local app, not these files.
- Database (`wp-config.php`): `DB_NAME=local`, `DB_USER=root`, `DB_PASSWORD=root`, `DB_HOST=localhost`. `WP_ENVIRONMENT_TYPE` is `local`; `WP_DEBUG` is off by default.
- Local domain follows the site slug — typically `http://xton24eu.local`. Start/stop the server from the Local app.
- Platform is Windows; the shell is PowerShell. A Bash tool is available for POSIX scripts.

## Common commands

Prefer WP-CLI for anything that touches the database or WordPress state. Local ships WP-CLI — open a shell for this site via **Local → right-click the site → Open site shell**, then run from `app/public`:

```bash
wp theme list                 # see installed themes and which is active
wp theme activate xton-shop   # switch the active theme
wp plugin list
wp option get siteurl         # confirm the site URL / home
wp db export backup.sql       # dump the database
wp search-replace OLD NEW     # e.g. migrating domains
```

To enable debugging while developing, set `WP_DEBUG` (and `WP_DEBUG_LOG`) to `true` in `wp-config.php` — debug output then lands in `wp-content/debug.log`.

### Motyw `xton-shop` — build (OOP + Vite + Tailwind v4 + TypeScript)

Katalog: `wp-content/themes/xton-shop/`. Uwaga: w tym środowisku `NODE_ENV=production` powoduje pominięcie devDependencies — przy instalacji użyj `NODE_ENV=development`.

```bash
composer install                                  # zależności PHP + autoload PSR-4 (XtonShop\ -> app/)
NODE_ENV=development npm install --include=dev     # zależności JS (vite, tailwind, daisyui, typescript)
NODE_ENV=development npm run build                 # produkcyjny build -> dist/ (HASHOWANE + manifest)
npm run dev                                        # serwer Vite + HMR (tworzy dist/hot; port 5173)
npm run typecheck                                  # kontrola typów TS (tsc --noEmit)
composer lint                                      # PHPCS (WPCS)
```

- **Hashowane buildy:** `dist/` jest w `.gitignore` — buduje się `npm run build`. `app/Assets/ViteAssets.php` czyta `dist/.vite/manifest.json` i kolejkuje pliki po hashu; w trybie dev (istnieje `dist/hot`) ładuje z serwera Vite.
- **Wersjonowanie motywu (SemVer):** źródło prawdy to `Version:` w `style.css`; przy wydaniu zaktualizuj też `package.json`, `XTON_SHOP_VERSION` w `functions.php`, changelog motywu i utwórz tag `theme-vX.Y.Z`.

## Working conventions

- **Never modify WordPress core** — `wp-admin/`, `wp-includes/`, and the root `wp-*.php` files are overwritten on every WordPress update. All custom work belongs in `wp-content/` (the `xton-shop` theme, and any future `plugins/` or `mu-plugins/`).
- New theme code goes in `wp-content/themes/xton-shop/` — a **classic, OOP theme** (decyzja D-006). Logika w klasach PSR-4 pod `app/` (namespace `XtonShop\`), rejestrowanych jako moduły `Bootable` w `app/Theme.php`; szablony klasyczne w korzeniu i `templates/`. Nowy moduł: utwórz klasę implementującą `Support\Contracts\Bootable` i dodaj ją do `Theme::MODULES`. Klasy Tailwind używane w PHP muszą być objęte `@source` w `resources/css/app.css`.
- Nadpisywanie szablonów WooCommerce: kopiuj do `wp-content/themes/xton-shop/woocommerce/`, nigdy nie edytuj w katalogu wtyczki.
- Don't edit files under `../../conf/` directly; change server/PHP settings through the Local app so they survive regeneration.
- The root `wp-config.php` is environment-specific (local DB creds, salts) — keep it out of anything that would be shared or committed.
