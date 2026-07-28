# CHANGELOG.md

Dziennik zmian technicznych projektu xton24.eu. Prowadzony automatycznie przez Claude'a: każda zmiana zapisywana jest z **datą, godziną (CEST)** i **listą ruszanych plików**. Najnowsze wpisy na górze.

Format: `## YYYY-MM-DD HH:MM` → opis + lista plików.

---

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
