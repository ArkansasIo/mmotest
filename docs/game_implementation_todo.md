# Universe Civilization: Empire at Wars — Game Implementation TODO

**Generated:** 2026-08-22  
**Repository:** `stargatewars`  
**Branch:** `game-folder`  
**Scope:** Full PHP/MariaDB MMORPG navigation, gameplay, services, pages, UI, testing, deployment, and documentation.

## 1. Current baseline

The repository currently contains a registry-driven PHP game shell with **28 menu groups and 191 registered routes**. The generated page architecture has **1,528 route layers** across definitions, logic, features, design, systems, and modules. Route integrity, detailed specifications, AJAX contracts, navigation checks, PHP syntax, JavaScript syntax, and route stress tests are currently green.

| Area | Current state | Evidence |
|---|---|---|
| Main game shell | Complete | `game.php` |
| Route registry | Complete | `config/page_registry.php`, 191 routes |
| Named menu/submenu tree | Complete | `menus/`, `config/menu_page_paths.php` |
| Legacy page compatibility tree | Complete | `pages/` |
| Page contract layers | Complete structurally | 1,528 layers audited |
| Detailed page specifications | Complete | 191 / 191 |
| AJAX route contracts | Complete | 191 / 191 |
| Navigation redesign | Complete | 33 / 33 checks |
| Route stress behavior | Complete | 1,910 / 1,910 successful requests |
| Service inventory | Broadly complete | 47 service classes |
| Action dispatcher | Centralized | `actions/game.php` |
| Premium subsystem | Implemented | wallet, catalogue, claims, effects, audit |
| Alliance subsystem | Contracted and service-backed | memberships, projects, diplomacy scope |
| Intelligence/Espionage | Enriched and service-backed | covert operations, reports, detection |
| Dedicated layout registry | Partial | several route families use generic/specification layouts |
| Page-specific interactive controls | Partial | 59 interaction buttons are currently wired |
| Legacy fixture compatibility | Needs verification | some tests use environment-dependent seed assumptions |

## 2. Priority legend

- **P0 — Release blocker:** authentication, authorization, data integrity, transaction safety, routing failure, or security defect.
- **P1 — Core gameplay:** required for a reliable playable MMORPG loop.
- **P2 — Feature completion:** expands depth, progression, content, and usability.
- **P3 — Polish and operations:** performance, accessibility, administration, analytics, and documentation.

## 3. P0 release and security TODOs

### Authentication and account safety

- [ ] Verify registration, login, logout, session renewal, session invalidation, and password failure behavior against a clean database.
- [ ] Remove or permanently disable any development authentication bypass configuration in production deployments.
- [ ] Confirm password hashing uses a current password API and that no plaintext credentials are stored in fixtures or logs.
- [ ] Add rate limiting and lockout telemetry for login, registration, password reset, and administrative override endpoints.
- [ ] Test CSRF validation on every state-changing action, including actions submitted from generated pages.
- [ ] Test RBAC and ownership checks with a second commander account for every mutation family.
- [ ] Confirm sensitive administrative actions require explicit administrator policy and an auditable override token.

### Database and transaction safety

- [ ] Run every migration from an empty MariaDB database and from the current production-like database.
- [ ] Add a migration ledger check that fails deployment when a migration is partially applied.
- [ ] Review all foreign keys, unique keys, check constraints, and indexes for high-traffic queue and event tables.
- [ ] Verify idempotency of all `apply_*_migration.php` scripts.
- [ ] Add deadlock retry policy and deadlock metrics around resource, queue, battle, market, Premium, and Alliance transactions.
- [ ] Confirm all resource deductions and grants have a matching immutable audit event.
- [ ] Add a database backup and restore rehearsal using a sanitized staging dump.

## 4. P1 core gameplay TODOs

### Turn and economy loop

- [ ] Define one authoritative turn interval and document whether the live rule is 30-minute settlement or six ticks per minute.
- [ ] Reconcile all turn processors so `GameService`, `TurnProcessorService`, and scheduled jobs cannot calculate different income.
- [ ] Complete the economy formula for Metal, Crystal, Deuterium, Naquadah, Energy, Food, and Water.
- [ ] Test positive production, zero production, storage caps, upkeep, deficits, starvation, water shortages, and energy brownouts.
- [ ] Add turn-level idempotency keys so a retried cron request cannot grant resources twice.
- [ ] Add deterministic fixtures for one turn, one hour, 24 hours, and a high-concurrency settlement batch.
- [ ] Add resource ledger reconciliation comparing balance deltas with production, consumption, queue costs, loot, and market settlements.

### Construction and settlement

- [ ] Replace generic construction controls with route-specific building and facility catalogues.
- [ ] Complete prerequisite graphs, level caps, construction duration, queue priority, cancellation, refund, and interruption rules.
- [ ] Complete settlement field allocation and power-grid node distribution for districts, factories, shipyards, and city modules.
- [ ] Implement brownout penalties and recovery behavior under insufficient power.
- [ ] Add construction completion processing to the turn processor and cron worker.
- [ ] Add planet and moon construction variants with different field, gravity, and life-support rules.

### Research and technology

- [ ] Complete all technology branch catalogues, levels 1–99, costs, prerequisites, effects, and queue durations.
- [ ] Remove remaining `NaN`, `undefined`, or missing prerequisite display paths from technology renderers.
- [ ] Validate research queue locking, cancellation, completion, duplicate queue prevention, and resource refunds.
- [ ] Connect research effects to combat, propulsion, scanning, shipyard repair, production, defense, and Premium modifiers.
- [ ] Add technology snapshot records so historical battle reports remain reproducible after research changes.

### Fleet, starships, motherships, and movement

- [ ] Complete the starship catalogue, including all planned classes, types, hull mass, shields, armor, propulsion, slots, and roles.
- [ ] Implement fleet composition validation, loadout capacity, weapon assignment, module power draw, and cargo capacity.
- [ ] Complete fleet movement speed and fuel consumption using hull mass and propulsion technology.
- [ ] Add travel route validation for galaxy, sector, system, orbit, stargate, jumpgate, wormhole, and exploration destinations.
- [ ] Implement arrival, recall, interception, travel failure, and mission completion events.
- [ ] Complete mothership exploration yield, travel time, risk, cooldown, and module capacity behavior.
- [ ] Complete shipyard repair with shield regeneration, armor patching, resource cost, and queue completion.

### Combat and military

- [ ] Finalize the deterministic battle resolver with shield, armor, penetration, weapon condition, formations, officers, and technology modifiers.
- [ ] Add automated defense turrets, planetary defenses, orbital bombardment, garrisons, and missile warfare calculations.
- [ ] Complete ground combat unit roles, officer effects, training, morale, casualties, and recovery.
- [ ] Implement alliance coordinated attacks, shared defense turrets, ACS timing, and participation rewards.
- [ ] Add debris fields, salvage rules, loot caps, and anti-duplication checks after combat.
- [ ] Store complete attacker and defender snapshots in battle reports for replayability.

### Intelligence and espionage

- [ ] Complete the Intelligence page-specific renderer for Spy Log, Enemy Intelligence, Spy Missions, Reconnaissance, Sabotage, Counter-Espionage, Sensor Phalanx, Fleet Activity, and Intelligence Reports.
- [ ] Wire the enriched Espionage page controls to `EspionageScanningService` for reconnaissance, spy, and sabotage mutations.
- [ ] Complete target board filtering, protection checks, agent availability, detection probability, and cooldown display.
- [ ] Verify classified report ownership, redaction, read state, retention, and report expiry.
- [ ] Add anti-abuse limits for repeated scanning and covert mission submissions.

## 5. P1 social, alliance, economy, and Premium TODOs

### Alliance

- [ ] Complete Alliance Hub, Members, Commanders, Officers, Diplomacy, War, ACS, Logistics, Stargates, and Intelligence page-specific renderers.
- [ ] Implement alliance creation cost, name uniqueness, creator role, invitation, join approval, leave, kick, and disband rules.
- [ ] Implement role permissions and immutable membership audit history.
- [ ] Complete diplomacy proposals, acceptance, expiration, relation state transitions, and war declarations.
- [ ] Complete shared projects, alliance technology contributions, logistics transfers, and alliance stargate permissions.
- [ ] Add alliance-scoped rate limits and cross-commander ownership tests.

### Economy and markets

- [ ] Complete Resource Exchange, Marketplace, Trade Routes, Merchant, Auction House, Black Market, and Insurance pages.
- [ ] Add market order matching, escrow, expiry, partial fills, cancellation, settlement fees, and transaction history.
- [ ] Implement trade-route capacity, travel duration, piracy risk, insurance claims, and failed delivery handling.
- [ ] Add anti-fraud checks for self-trading, duplicate settlement, negative balances, and price manipulation.

### Premium

- [ ] Complete Premium Store, Officers, Commander, and Premium Services page-specific renderers.
- [ ] Define the Dark Matter grant and purchase policy for development, staging, and production environments.
- [ ] Add receipt or entitlement-provider integration before accepting real-money payments.
- [ ] Complete officer stacking rules, expiry handling, replacement rules, and offline settlement behavior.
- [ ] Add Premium entitlement revocation, refund, chargeback, and audit workflows.
- [ ] Ensure Premium effects are bounded and cannot bypass ownership, protection, queue, or resource validation.

## 6. P2 page and navigation TODOs

- [ ] Add dedicated layout contracts for the static audit’s currently generic families: `combat`, `settlement`, `facilities`, `fleet`, `crafting`, `generic`, `activities`, and `premium`.
- [ ] Increase route-specific interactive controls beyond the current 59 wired controls where the page contract defines a real mutation.
- [ ] Add route-specific renderers for pages that currently rely on the generic specification dashboard.
- [ ] Remove duplicate or legacy page labels where two routes expose the same visible title without explanatory context.
- [ ] Add breadcrumbs showing menu, submenu, and page names on every route.
- [ ] Add route-level page titles and accessible landmarks for screen readers.
- [ ] Add consistent empty, loading, protected, cooldown, insufficient-resource, success, and error views to every mutation-capable page.
- [ ] Add visible server-action audit status after every mutation.
- [ ] Add mobile navigation tests for every group and submenu expansion state.
- [ ] Add a navigation sitemap generated from `config/page_registry.php` and `config/menu_page_paths.php`.

## 7. P2 UI, theme, and design TODOs

- [ ] Verify Default White, Window Blue Sci-Fi, and Deep Space Blue themes against every page family.
- [ ] Add contrast testing for text, badges, warnings, errors, buttons, tables, and disabled controls.
- [ ] Remove any remaining raw source, debug arrays, development-only status text, and placeholder copy from rendered pages.
- [ ] Add responsive tests at mobile, tablet, desktop, and wide-monitor breakpoints.
- [ ] Add reduced-motion behavior to all dynamic feedback and queue progress indicators.
- [ ] Add keyboard navigation and focus-state tests for sidebar menus, submenu trees, forms, modals, and tables.
- [ ] Add visual regression screenshots for Command Center, Intelligence, Fleet, Construction, Research, Alliance, Premium, Galaxy, and Economy pages.
- [ ] Add a user-facing theme selector persistence test.

## 8. P2 testing TODOs

- [ ] Create a single `tests/run_all.php` runner with machine-readable JSON output and nonzero failure status.
- [ ] Split tests into unit, contract, integration, browser, load, and migration suites.
- [ ] Add clean-database fixtures and isolated transactions for every mutation test.
- [ ] Add two-account ownership tests for every action family.
- [ ] Add property-based tests for resource conservation, queue capacity, bounded damage, and deterministic combat.
- [ ] Add replay tests ensuring the same battle seed produces the same result.
- [ ] Add cron tests for duplicate execution, delayed execution, server lag, and partial worker failure.
- [ ] Add AJAX tests for malformed JSON, missing CSRF, expired session, invalid route, invalid intent, and stale request cancellation.
- [ ] Add browser tests for all major navigation groups, not only representative routes.
- [ ] Convert environment-dependent skips into explicit fixture profiles: `seeded`, `clean`, `production-like`, and `load`.
- [ ] Track test coverage by route, action, service, table, and feedback state.

## 9. P3 operations and deployment TODOs

- [ ] Add a production web server configuration instead of relying on the PHP development server.
- [ ] Configure HTTPS, secure cookies, trusted proxy handling, and security headers.
- [ ] Add a process supervisor for PHP workers and scheduled turn processing.
- [ ] Add structured logs for request ID, commander ID, route, action, duration, result state, and transaction outcome.
- [ ] Add health, readiness, database, cron, and queue monitoring endpoints.
- [ ] Add deployment smoke tests that open the public landing page, login page, game shell, Premium page, Alliance page, and Coordinate Search page.
- [ ] Add rollback instructions for code, migrations, and assets.
- [ ] Add CI checks for PHP lint, route audit, AJAX audit, migrations, tests, and forbidden debug output.
- [ ] Publish a deployable archive only from a clean tagged commit.

## 10. P3 documentation TODOs

- [ ] Update the Game Design Document with the authoritative turn, economy, combat, research, alliance, Premium, and exploration rules.
- [ ] Generate a complete route catalogue with menu, submenu, page filename, layout, actions, tables, permissions, and feedback states.
- [ ] Generate an ERD for players, resources, colonies, queues, fleets, combat, intelligence, alliances, markets, Premium, and events.
- [ ] Document every server action with request fields, validation, transaction scope, response states, and audit events.
- [ ] Document the cron schedule and turn processor lifecycle.
- [ ] Document local development, database setup, test execution, staging deployment, rollback, and backup restoration.
- [ ] Add contribution and coding standards for new route layers.
- [ ] Archive test logs and release manifests for every deployment.

## 11. Suggested execution order

| Sprint | Scope | Exit criteria |
|---|---|---|
| Sprint 0 | Security, migrations, clean fixtures, unified test runner | P0 checks green on clean and seeded databases |
| Sprint 1 | Turn processor and economy reconciliation | 24-hour economy simulation reconciles exactly |
| Sprint 2 | Construction, settlement, power grid, research queues | Queue completion and resource conservation tests pass |
| Sprint 3 | Fleet movement, shipyard, weapons, combat, salvage | Deterministic battle and movement replay tests pass |
| Sprint 4 | Intelligence, Alliance, and Social mutation flows | Two-account ownership and permission tests pass |
| Sprint 5 | Premium entitlements and bounded effects | No entitlement bypasses core validation; audit complete |
| Sprint 6 | Dedicated page renderers and responsive UI | All priority page families have no generic fallback |
| Sprint 7 | Deployment, monitoring, documentation, and release archive | Staging smoke test and rollback rehearsal pass |

## 12. Immediate next actions

1. Run the clean-database migration and fixture suite.
2. Reconcile the active turn processor with the economy specification.
3. Add dedicated layout contracts for the eight generic audit families.
4. Finish page-specific Intelligence and Alliance renderers.
5. Build the unified test runner and machine-readable release gate.
6. Remove all debug output and verify the live staging build.

## 13. Scan artifacts

- `docs/repository_scan_raw.log`
- `docs/repository_scan_classification.log`
- `docs/named_route_e2e_final.log`
- `docs/all_191_ajax_integration.json`
- `docs/all_191_routes_integration.json`
- `config/page_registry.php`
- `config/menu_page_paths.php`

