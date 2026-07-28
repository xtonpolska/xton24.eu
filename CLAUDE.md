# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

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

## Working conventions

- **Never modify WordPress core** — `wp-admin/`, `wp-includes/`, and the root `wp-*.php` files are overwritten on every WordPress update. All custom work belongs in `wp-content/` (the `xton-shop` theme, and any future `plugins/` or `mu-plugins/`).
- New theme code goes in `wp-content/themes/xton-shop/`. A WordPress theme minimally needs `style.css` (with the theme header comment) and either classic templates (`index.php`, `functions.php`, `header.php`, …) or, for a block theme, `theme.json` plus `templates/` and `patterns/`. Decide classic vs. block theme up front — it shapes the whole file layout.
- Don't edit files under `../../conf/` directly; change server/PHP settings through the Local app so they survive regeneration.
- The root `wp-config.php` is environment-specific (local DB creds, salts) — keep it out of anything that would be shared or committed.
