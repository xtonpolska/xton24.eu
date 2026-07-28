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
| Motyw własny       | `xton-shop` (do zbudowania)                   |

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

Stan: **szkielet** (`.gitkeep`), do zbudowania. Decyzja *klasyczny vs blokowy* → zob. [DECISIONS.md](DECISIONS.md).

Wymagania integracji z WooCommerce zostaną tu opisane w miarę rozwoju (m.in. `add_theme_support('woocommerce')`, szablony `woocommerce/` w motywie, hooki WooCommerce).

## 6. Konwencje techniczne

- Nigdy nie modyfikować rdzenia WordPressa ani wtyczek z wp.org — nadpisywane przy aktualizacji. Cały kod własny w `wp-content/themes/xton-shop` (lub własnych wtyczkach).
- Nadpisywanie szablonów WooCommerce wyłącznie przez kopię do `xton-shop/woocommerce/` (nigdy edycja w katalogu wtyczki).
- Zmiany serwera/PHP przez aplikację Local, nie przez pliki w `conf/`.

---

*Aktualizowane automatycznie. Ostatnia aktualizacja: 2026-07-28 13:02.*
