# Deep MMO Expansion Import

The uploaded `mmotest_deep_mmo_expansion` archive was imported under `expansion_import/` as an isolated, reviewable source package.

## Integration policy

The canonical application remains authoritative for `game.php`, the registry, database connection, authentication, CSRF, RBAC, page routing, and existing overlapping page files. Archive files with matching canonical paths were retained under `expansion_import/` rather than blindly overwriting the active implementation.

Unique expansion services, pages, cron code, assets, documentation, and SQL are available for staged reconciliation. The expansion SQL is not automatically applied because it overlaps existing canonical tables and requires reviewed migrations and foreign-key reconciliation.

## Archive contents

- 70 PHP source files.
- 1 SQL expansion schema.
- 1 JavaScript asset.
- 1 CSS asset.
- 1 README.
- 1 JSON manifest.
- 12 placeholder directory markers.

## Review status

- [x] Archive integrity verified.
- [x] No path traversal entries found.
- [x] No executable binary artifacts found.
- [x] Existing canonical files preserved.
- [x] Expansion source added to the repository for controlled integration.
- [ ] Reconcile overlapping services with canonical namespaces and dependency injection.
- [ ] Convert expansion SQL into reviewed numbered migrations.
- [ ] Wire selected page controllers through the authenticated route registry.
- [ ] Add expansion-specific integration tests before enabling mutating behavior.

## imported expansion tree

expansion_import/01_Core/Database.php
expansion_import/01_Core/GameEngine/EventBus.php
expansion_import/01_Core/GameEngine/TurnProcessor.php
expansion_import/01_Core/bootstrap.php
expansion_import/02_Gameplay/Economy/EconomyService.php
expansion_import/02_Gameplay/Galaxy/GalaxyGenerator.php
expansion_import/02_Gameplay/Intelligence/IntelligenceService.php
expansion_import/02_Gameplay/Market/MarketService.php
expansion_import/02_Gameplay/Military/CombatService.php
expansion_import/02_Gameplay/Military/FleetService.php
expansion_import/02_Gameplay/Planets/BuildingService.php
expansion_import/02_Gameplay/Research/ResearchService.php
expansion_import/02_Gameplay/Stargate/StargateService.php
expansion_import/03_Player/Account/.gitkeep
expansion_import/03_Player/Profile/.gitkeep
expansion_import/03_Player/Race/.gitkeep
expansion_import/04_Social/Alliances/.gitkeep
expansion_import/04_Social/Diplomacy/.gitkeep
expansion_import/05_Intelligence/Agents/.gitkeep
expansion_import/06_API/Controllers/.gitkeep
expansion_import/06_API/Middleware/.gitkeep
expansion_import/08_Cron/turn_processor.php
expansion_import/09_Storage/Cache/.gitkeep
expansion_import/09_Storage/Logs/.gitkeep
expansion_import/10_Docs/.gitkeep
expansion_import/EXPANSION_MANIFEST.json
expansion_import/README_MMO_EXPANSION.md
expansion_import/assets/css/mmo.css
expansion_import/assets/js/mmo.js
expansion_import/includes/layout.php
expansion_import/pages/alliance/index.php
expansion_import/pages/alliance/members.php
expansion_import/pages/alliance/projects.php
expansion_import/pages/buildings/index.php
expansion_import/pages/buildings/queue.php
expansion_import/pages/combat/index.php
expansion_import/pages/combat/reports.php
expansion_import/pages/commanders/equipment.php
expansion_import/pages/commanders/index.php
expansion_import/pages/commanders/skills.php
expansion_import/pages/dashboard/index.php
expansion_import/pages/diplomacy/index.php
expansion_import/pages/diplomacy/treaties.php
expansion_import/pages/diplomacy/wars.php
expansion_import/pages/economy/income.php
expansion_import/pages/economy/index.php
expansion_import/pages/economy/treasury.php
expansion_import/pages/empire/index.php
expansion_import/pages/events/index.php
expansion_import/pages/fleet/designs.php
expansion_import/pages/fleet/index.php
expansion_import/pages/fleet/missions.php
expansion_import/pages/fleet/shipyard.php
expansion_import/pages/galaxy/anomalies.php
expansion_import/pages/galaxy/exploration.php
expansion_import/pages/galaxy/index.php
expansion_import/pages/galaxy/systems.php
expansion_import/pages/intelligence/index.php
expansion_import/pages/intelligence/operations.php
expansion_import/pages/intelligence/reports.php
expansion_import/pages/market/index.php
expansion_import/pages/market/orders.php
expansion_import/pages/messages/index.php
expansion_import/pages/military/index.php
expansion_import/pages/missions/daily.php
expansion_import/pages/missions/index.php
expansion_import/pages/missions/story.php
expansion_import/pages/planets/construction.php
expansion_import/pages/planets/index.php
expansion_import/pages/planets/population.php
expansion_import/pages/planets/terraforming.php
expansion_import/pages/player/account.php
expansion_import/pages/player/profile.php
expansion_import/pages/progression/achievements.php
expansion_import/pages/progression/ascension.php
expansion_import/pages/rankings/index.php
expansion_import/pages/research/index.php
expansion_import/pages/research/queue.php
expansion_import/pages/research/tree.php
expansion_import/pages/resources/index.php
expansion_import/pages/resources/production.php
expansion_import/pages/resources/storage.php
expansion_import/pages/stargate/dial.php
expansion_import/pages/stargate/index.php
expansion_import/pages/stargate/routes.php
expansion_import/sql/100_mmo_expansion.sql
