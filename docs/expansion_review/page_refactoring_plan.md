# Deep MMO Expansion Page Refactoring Plan

## Objective

Port the 12 expansion index pages into the existing registry-driven page architecture without replacing the canonical wrappers. Each page must remain compatible with the six-layer contract, authenticated commander context, three-theme system, delegated AJAX intents, standardized feedback states, and 1,528 route-layer audit.

## Page mapping

| Expansion page | Canonical route/group | Primary module | Read data | Mutating intents |
|---|---|---|---|---|
| `alliance/index.php` | `alliance/alliance` | `AllianceOverviewModule` | `alliances`, `alliance_members`, `alliance_projects` | `alliance_create`, `alliance_join` |
| `economy/index.php` | `economy/marketplace` or `command-center/income` | `EconomyOverviewModule` | `player_resources`, `player_colonies`, `game_events` | Existing economy intents only |
| `empire/index.php` | `empire/planets` | `EmpireOverviewModule` | `player_colonies`, `colonies`, `planet_bonuses`, `production_queues` | `colonize_planet`, `planet_defense`, queue intents |
| `fleet/index.php` | `fleet/fleet-manager` | `FleetOverviewModule` | `fleets`, `fleet_missions`, `motherships` | `fleet_dispatch`, `fleet_recall`, `fleet_form` |
| `galaxy/index.php` | `galaxy/galaxy-view` | `GalaxyOverviewModule` | `universe_galaxies`, `universe_sectors`, `universe_solar_systems` | Read-only coordinate and scan intents |
| `intelligence/index.php` | `intelligence/intelligence-espionage` | `IntelligenceOverviewModule` | `intelligence_reports`, `covert_missions`, `game_events` | `reconnaissance`, `spy_mission`, `sabotage` |
| `market/index.php` | `economy/marketplace` | `MarketOverviewModule` | `market_orders`, `market_transactions`, `player_resources` | `market_list`, `market_buy`, `market_cancel` |
| `military/index.php` | `attack/targets` or `command-center/military-stats` | `MilitaryOverviewModule` | `battles`, `battle_reports`, `player_unit_stats`, `player_weapons` | `combat`, `weapon_equip`, `unit_deploy` |
| `planets/index.php` | `empire/planets` | `PlanetOverviewModule` | `player_colonies`, `universe_planets`, `planet_bonuses` | `explore`, `colonize_planet`, `planet_defense` |
| `rankings/index.php` | `rankings/leaderboard` | `RankingsOverviewModule` | `rankings`, `rank_snapshots`, `glory_reputation` | `refresh_rankings` |
| `research/index.php` | `research/research-lab` | `ResearchOverviewModule` | `technologies`, `technology_prerequisites`, `player_technologies`, `research_queues` | `technology`, `upgrade_up` |
| `resources/index.php` | `command-center/resources` | `ResourceOverviewModule` | `player_resources`, `player_colonies`, `game_settings` | `deposit`, `withdraw`, resource queue intents |

When a canonical route has a more specific existing page, the expansion index should become a presentation variant of that canonical page rather than a new route. This avoids duplicate navigation nodes and preserves the 191-route master hierarchy.

## Required module contract

Each module should expose a read-only `viewModel(array $context): array` method and should render through the existing page-definition renderer. Mutations must be represented as action metadata, not direct SQL in the page file. The module must receive the authenticated player ID, route, CSRF token, theme, and permission scope from the canonical context.

Every view model must provide `status`, `metrics`, `sections`, `controls`, `actions`, `dependencies`, `feedback_states`, and `related_routes`. Empty and protected results must return explanatory states rather than fabricated values. Database access must use prepared statements and ownership filters.

## Porting sequence

### Phase A: Presentation extraction

Extract the expansion page headings, metric labels, activity panels, progress bars, and copy into page-definition data. Replace hard-coded turn values, countdowns, player names, resources, and URLs with canonical context helpers. Replace direct `/pages/...` links with registry route identifiers.

### Phase B: Module implementation

Create one module per page family under `includes/page_modules/expansion/`. Read-only queries must be scoped to the authenticated commander. The modules should reuse existing formatter, theme, resource, and feedback helpers. The expansion CSS should be reduced to component rules compatible with the existing theme variables instead of loading a second global layout.

### Phase C: Action wiring

Map every expansion control to an existing action contract where possible. New actions must be registered in the central dispatcher and must enforce authentication, CSRF, RBAC, ownership, cooldown, resource validation, and transaction boundaries. The compatibility adapter must be used for expansion writes to overlapping tables until the canonical services fully absorb the expansion fields.

### Phase D: Registry integration

Update only the relevant page-definition files and module references. Do not add duplicate top-level menu items. Add expansion-specific metadata such as `source: expansion`, `layout_variant: dashboard`, and `feature_flag: deep_mmo_expansion` so the feature can be enabled or disabled without changing route identifiers.

### Phase E: Test and rollout

For each page, add view-model tests for ready, empty, protected, and error states. Add action tests for invalid ownership, CSRF failure, insufficient resources, cooldown, rollback, and successful commit. Run the route audit, AJAX contract audit, PHP lint, migration simulation, and browser smoke tests before enabling any new mutation.

## Security and data rules

The expansion pages must never load the expansion standalone layout. They must use the canonical authenticated shell. Direct client-supplied player IDs, ownership identifiers, resource balances, completion timestamps, or battle outcomes must be ignored in favor of server-derived values. The client may submit only an allowed intent and validated target identifier.

All expansion schema aliases are nullable compatibility fields. The canonical columns remain the source of truth until a later migration proves that data can be backfilled and all consumers have been migrated. The staged migration must be applied through the normal migration runner and backed up before production use.

## Definition of done

A page is considered ported only when its canonical registry entry loads the module, its view model has all required feedback states, its controls map to registered intents, its database tables are listed in the page definition, its links resolve through the registry, its PHP passes lint, and the full 191-route and AJAX audits remain green.
