# Deep MMO Expansion Active Merge

All non-placeholder files from the attached ZIP are now present in the active repository in two forms: the original archive-preserving source at `expansion_import/` and conflict-safe active namespaces for runtime integration.

## Active locations

| Archive content | Active location |
|---|---|
| Core, gameplay, player, social, intelligence, API, cron, storage, docs | `active_expansion/` |
| Expansion page controllers | `pages/expansion_pack/` |
| Expansion shared layout | `includes/expansion_pack/` |
| Expansion CSS | `assets/expansion_pack/` |
| Expansion JavaScript | `js/expansion_pack/` |
| Expansion SQL | `07_Database/Migrations/staged/100_mmo_expansion.sql` |
| README and manifest | `10_Docs/expansion_pack/` |

Canonical same-name files were preserved. No archive file was discarded. Placeholder `.gitkeep` files remain in `expansion_import/` and `active_expansion/` where supplied by the archive.
