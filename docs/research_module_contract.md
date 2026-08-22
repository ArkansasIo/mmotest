# Research Module Category: Page Logic and Server Contracts

## Category objective

Research pages expose server-authoritative technology state, prerequisites, queue capacity, resource costs, research completion, and applied modifiers. The client submits only an allowed technology intent and target identifier; all levels, costs, prerequisites, queue slots, and completion timestamps are resolved server-side.

## Canonical routes

| Route | Responsibility | Primary actions |
|---|---|---|
| `research-technology` | Core technology catalogue and current levels | `technology`, `refresh_page` |
| `advanced-research` | Advanced branches and gated technologies | `technology`, `refresh_page` |
| `combat` | Offensive and defensive research modifiers | `technology`, `refresh_page` |
| `propulsion` | Fleet speed and fuel technology | `technology`, `refresh_page` |
| `espionage` | Covert and anti-covert research | `technology`, `refresh_page` |
| `lifeform-research` | Race/lifeform research branches | `technology`, `refresh_page` |
| `mothership-technology` | Mothership module research | `technology`, `refresh_page` |
| `ascension-research` | Endgame research and prestige gates | `technology`, `refresh_page` |

## Shared page logic

The read workflow loads the authenticated commander, visible technology catalogue, completed levels, prerequisites, active research queue, resource balances, applied branch modifiers, and related routes. A research mutation locks the player technology row, prerequisite rows, resource row, and research queue slot; validates ownership, RBAC, CSRF, cooldown, prerequisite level, resource balance, and queue capacity; deducts resources; creates the queue entry and audit event in one transaction; and returns `queued`, `locked`, `insufficient-resource`, or `error` feedback.

The core formulas are `next cost = base cost × level coefficient × branch modifier`, `research time = base time × level coefficient ÷ laboratory modifier`, and `applied effect = level × tier coefficient × race/government modifier`. Completion is processed by the server turn worker and must not be accepted from a client-supplied timestamp.

## Shared server contract

| Contract area | Required behavior |
|---|---|
| Authentication | Require the current commander session. |
| CSRF | Require the canonical CSRF token on `technology` mutations. |
| RBAC | Check research permission and branch access. |
| Ownership | Scope technologies, queues, and resources to the authenticated player. |
| Prerequisites | Resolve technology and building prerequisites from canonical records. |
| Queue | Lock and validate research queue capacity before deduction. |
| Resources | Lock `player_resources` and reject insufficient balances without partial writes. |
| Transaction | Commit technology queue, resource deduction, and event atomically; roll back on any exception. |
| Feedback | Support `loading`, `ready`, `empty`, `locked`, `queued`, `insufficient-resource`, `success`, and `error`. |
| Audit | Record the requested technology, old level, new level, cost, completion time, and actor. |

## Database scope

`technologies`, `technology_prerequisites`, `player_technologies`, `research_queues`, `player_resources`, `game_events`, and relevant laboratory/building tables are read or written only through authenticated services.

## Implementation sequence

First normalize each existing Research page definition to this shared contract. Next, add a category-level module helper for the read model and intent validation. Then route the existing `technology` action through the canonical research service, add focused prerequisite/resource/queue tests, and finally expose applied branch modifiers in the existing dashboard renderer. No new top-level routes are required.
