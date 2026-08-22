# Active Deep MMO Expansion Source

This directory contains the complete Deep MMO Expansion source imported from the uploaded archive. It is intentionally namespaced so the canonical 191-route game shell, security pipeline, and schema remain authoritative.

The page controllers are mirrored under `pages/expansion_pack/`, shared layout under `includes/expansion_pack/`, browser assets under `assets/expansion_pack/` and `js/expansion_pack/`, and SQL under `07_Database/Migrations/staged/`. The staged SQL must be reconciled into numbered production migrations before execution.
