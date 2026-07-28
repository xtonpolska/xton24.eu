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

---

## Decyzje otwarte / do podjęcia

- **O-001 — Typ motywu `xton-shop`:** klasyczny (PHP: `functions.php`, `header.php`, …) czy blokowy (`theme.json`, `templates/`, `patterns/`)? *Wybór ukształtuje całą strukturę motywu.* — **oczekuje na decyzję**
- **O-002 — WooCommerce w repo:** obecnie ignorowany (D-003). Do rozważenia zamrożenie konkretnej wersji w repo, jeśli zajdzie potrzeba. — **oczekuje na decyzję**

---

*Aktualizowane automatycznie. Ostatnia aktualizacja: 2026-07-28 13:02.*
