# Server-Authoritative API Contract Reference

This document describes the runtime contract metadata for every registered route in the canonical game registry. Each route is read and mutated through authenticated, server-authoritative handlers; mutation-specific checks include CSRF, RBAC, ownership, resource, cooldown, and transaction validation where declared by the route contract.

**Coverage:** 191 routes across the canonical registry.

## Common contract rules

| Area | Contract |
|---|---|
| Authentication | Authenticated commander context is required for protected state. |
| Authorization | RBAC and ownership scope are evaluated server-side. |
| Mutation safety | CSRF, validation, cooldown, resource checks, and transactions apply to writes. |
| Response model | `loading`, `ready`, `empty`, `protected`, `cooldown`, `insufficient-resource`, `success`, and `error` are standardized feedback states. |
| Data exposure | Public and scoped fields are returned; private account data is excluded. |

## Route contracts

| Group | Route | Title | Controls | Actions | Database scope |
|---|---|---|---|---|---|
| `command-center` | `dashboard` | Command Center | Process turns<br>Choose target<br>Review reports | process_turns | players<br>player_resources<br>rankings<br>game_events |
| `command-center` | `account-info` | Account Information | View profile<br>View rank<br>View protection | read-only | players<br>races<br>rankings<br>glory_reputation |
| `command-center` | `resources` | Resources & Vault | Deposit<br>Withdraw | deposit<br>withdraw | player_resources<br>game_settings |
| `command-center` | `income` | Income Breakdown | View income formula | read-only | player_resources<br>races<br>player_planets<br>game_settings |
| `command-center` | `military-stats` | Military Statistics | View attack<br>View defense<br>View covert | read-only | player_resources<br>player_unit_stats<br>rankings |
| `attack` | `targets` | Target Selection | Attack<br>Raid<br>Spy<br>Sabotage<br>Conquer Planet<br>Message | combat<br>covert<br>explore<br>message | target_realms<br>players<br>battles |
| `attack` | `spy` | Spy Operations | Run reconnaissance<br>Run spy mission | covert | covert_missions<br>spy_missions<br>intelligence_reports |
| `attack` | `sabotage` | Sabotage Operations | Choose system<br>Run sabotage | covert | covert_missions<br>sabotage_missions |
| `attack` | `attack-log` | Attack Log & Reports | Open report<br>Mark read | message_read | battles<br>battle_reports<br>attack_logs |
| `armory` | `weapons` | Weapon Inventory | Buy weapon<br>Inspect durability | weapon_buy | weapon_types<br>player_weapons |
| `armory` | `weapon-market` | Weapon Market | List order<br>Buy order | market_list<br>market_buy | market_orders<br>weapon_types |
| `armory` | `repair` | Weapon Repair | Repair weapon | weapon_repair | player_weapons<br>player_resources |
| `training` | `units` | Unit Training | Train units | train<br>upgrade_up | unit_types<br>player_unit_stats<br>training_queues<br>player_resources<br>game_events |
| `training` | `miners` | Miners & Lifers | Train miners | train | player_resources |
| `training` | `super-units` | Super Units | Train elite units | train | player_resources<br>technologies |
| `training` | `unit-production` | Unit Production | Upgrade UP | upgrade_up | unit_types<br>player_unit_stats<br>training_queues<br>player_resources<br>game_events |
| `technology` | `technology` | Technology Tree | Upgrade offense<br>Upgrade defense<br>Upgrade covert<br>Upgrade anti-covert | technology | technologies<br>player_technologies |
| `technology` | `tech-offense` | Offense Technology | Upgrade | technology | technologies<br>player_technologies |
| `technology` | `tech-defense` | Defense Technology | Upgrade | technology | technologies<br>player_technologies |
| `technology` | `tech-covert` | Covert Technology | Upgrade | technology | technologies<br>player_technologies |
| `technology` | `tech-anti-covert` | Anti-Covert Technology | Upgrade | technology | technologies<br>player_technologies |
| `intelligence` | `spy-log` | Spy Log | Open report<br>Mark read | message_read | covert_missions<br>intelligence_reports |
| `intelligence` | `enemy-intelligence` | Enemy Intelligence | Open intelligence report | read-only | intelligence_reports |
| `intelligence` | `intelligence-espionage` | Espionage | Open overview<br>Review status | read-only | game_events |
| `intelligence` | `spy-missions` | Spy Missions | Open overview<br>Review status | read-only | game_events |
| `intelligence` | `counter-espionage` | Counter-Espionage | Open overview<br>Review status | read-only | game_events |
| `intelligence` | `intelligence-sabotage` | Sabotage | Open overview<br>Review status | read-only | game_events |
| `intelligence` | `reconnaissance` | Reconnaissance | Open overview<br>Review status | read-only | game_events |
| `intelligence` | `sensor-phalanx` | Sensor Phalanx | Open overview<br>Review status | read-only | game_events |
| `intelligence` | `fleet-activity` | Fleet Activity | Open overview<br>Review status | read-only | game_events |
| `intelligence` | `intelligence-reports` | Intelligence Reports | Open overview<br>Review status | read-only | game_events |
| `market` | `resource-exchange` | Resource Exchange | List order<br>Buy order | market_list<br>market_buy | market_orders<br>player_resources |
| `market` | `mercenary-market` | Mercenary Market | Recruit<br>Sell | mercenary_buy | mercenary_types<br>player_mercenaries |
| `social` | `rankings` | Rankings | Refresh rankings<br>Open player | refresh_rankings | rankings<br>rank_snapshots |
| `social` | `alliances` | Alliances | Create alliance<br>Join alliance<br>Leave alliance | alliance_create<br>alliance_join | alliances<br>alliance_members |
| `social` | `messages` | Messages | Send<br>Mark read<br>Blacklist | message<br>message_read | messages<br>blacklists |
| `social` | `social-messages` | Messages | Open overview<br>Review status | read-only | game_events |
| `social` | `notifications` | Notifications | Open overview<br>Review status | read-only | game_events |
| `social` | `global-chat` | Global Chat | Open overview<br>Review status | read-only | game_events |
| `social` | `buddy-list` | Buddy List | Open overview<br>Review status | read-only | game_events |
| `social` | `recruitment` | Recruitment | Open overview<br>Review status | read-only | game_events |
| `social` | `empires-at-war` | Empires at War | Open overview<br>Review status | read-only | game_events |
| `planets` | `planet-list` | Planet List | Explore<br>Colonize<br>Upgrade defense | explore<br>combat<br>colonize_planet<br>planet_defense | player_colonies<br>planet_bonuses<br>planet_explorations<br>player_resources<br>universe_planets<br>planet_defenses<br>motherships<br>player_cooldowns<br>game_events |
| `planets` | `settlement` | Settlement & Power Grid | Queue build<br>Demolish<br>Process construction | settlement_state<br>settlement_build<br>settlement_demolish<br>settlement_process | settlement_fields<br>settlement_buildings<br>settlement_construction_queues<br>building_types<br>player_resources<br>game_events |
| `planets` | `planet-bonuses` | Planet Bonuses | View bonuses | read-only | planet_bonuses |
| `planets` | `planet-defenses` | Planet Defenses | Upgrade defense | planet_defense | planet_defenses |
| `mothership` | `ship` | Mothership | Upgrade hull<br>Upgrade hangars<br>Upgrade shields | mothership_upgrade | motherships |
| `mothership` | `modules` | Mothership Modules | Upgrade module | mothership_upgrade | mothership_modules |
| `mothership` | `exploration` | Exploration | Explore planet | explore | motherships<br>planet_explorations |
| `account` | `race` | Race Selection | Select race | change_race | races<br>players |
| `account` | `vacation` | Vacation Mode | Enable vacation | vacation | vacation_states<br>protection_states |
| `account` | `ascension` | Ascension | Check eligibility<br>Ascend | ascend | ascension_states<br>ascensions<br>glory_reputation |
| `universe` | `galaxies` | Galaxy Map | Select galaxy<br>Open sector | universe_galaxies | universe_galaxies<br>universe_sectors<br>universe_solar_systems<br>universe_planets<br>universe_discoveries<br>target_realms<br>game_events |
| `universe` | `sectors` | Sector Map | Select sector<br>Open system | universe_sectors | universe_sectors<br>universe_solar_systems<br>universe_planets<br>motherships<br>mothership_modules<br>player_technologies<br>player_cooldowns<br>game_events |
| `universe` | `solar-systems` | Solar Systems | Open system<br>Scan system | system_map<br>explore | universe_solar_systems<br>universe_planets |
| `universe` | `universe-planets` | Universe Planets | Inspect planet<br>Colonize planet | planet_details<br>colonize_planet | universe_planets<br>player_colonies |
| `universe` | `moons` | Moon Registry | Inspect moon<br>Build jump gate | moon_details<br>mothership_upgrade | universe_moons<br>universe_planets |
| `universe` | `coordinates` | Coordinate Search | Search coordinates<br>Open system | coordinate_lookup | universe_galaxies<br>universe_sectors<br>universe_solar_systems<br>universe_planets<br>universe_discoveries<br>player_colonies |
| `overview` | `overview-dashboard` | Dashboard | Open overview<br>Review status | read-only | game_events |
| `overview` | `empire-overview` | Empire Overview | Open overview<br>Review status | read-only | game_events |
| `overview` | `active-operations` | Active Operations | Open overview<br>Review status | read-only | game_events |
| `overview` | `alerts` | Alerts | Open overview<br>Review status | read-only | game_events |
| `overview` | `tutorial-objectives` | Tutorial / Objectives | Open overview<br>Review status | read-only | game_events |
| `empire` | `planets` | Planets | Open overview<br>Review status | read-only | game_events |
| `empire` | `colonies` | Colonies | Open overview<br>Review status | read-only | game_events |
| `empire` | `empire-moons` | Moons | Open overview<br>Review status | read-only | game_events |
| `empire` | `buildings` | Buildings | Open overview<br>Review status | read-only | game_events |
| `empire` | `facilities` | Facilities | Open overview<br>Review status | read-only | game_events |
| `empire` | `storage` | Storage | Open overview<br>Review status | read-only | game_events |
| `empire` | `population` | Population | Open overview<br>Review status | read-only | game_events |
| `empire` | `planet-specialization` | Planet Specialization | Open overview<br>Review status | read-only | game_events |
| `resources` | `resource-overview` | Resource Overview | Open overview<br>Review status | read-only | game_events |
| `resources` | `metal` | Metal | Open overview<br>Review status | read-only | game_events |
| `resources` | `crystal` | Crystal | Open overview<br>Review status | read-only | game_events |
| `resources` | `deuterium` | Deuterium | Open overview<br>Review status | read-only | game_events |
| `resources` | `naquadah` | Naquadah | Open overview<br>Review status | read-only | game_events |
| `resources` | `energy` | Energy | Open overview<br>Review status | read-only | game_events |
| `resources` | `dark-matter` | Dark Matter | Open overview<br>Review status | read-only | game_events |
| `resources` | `production` | Production | Open overview<br>Review status | read-only | game_events |
| `resources` | `energy-grid` | Energy Grid | Open overview<br>Review status | read-only | game_events |
| `construction` | `construction-buildings` | Buildings | Open overview<br>Review status | read-only | game_events |
| `construction` | `construction-facilities` | Facilities | Open overview<br>Review status | read-only | game_events |
| `construction` | `construction-queue` | Construction Queue | Open overview<br>Review status | read-only | game_events |
| `construction` | `shipyard` | Shipyard | Open overview<br>Review status | read-only | game_events |
| `construction` | `defense` | Defense | Open overview<br>Review status | read-only | game_events |
| `construction` | `robotics` | Robotics | Open overview<br>Review status | read-only | game_events |
| `construction` | `nanite-factory` | Nanite Factory | Open overview<br>Review status | read-only | game_events |
| `construction` | `terraformer` | Terraformer | Open overview<br>Review status | read-only | game_events |
| `construction` | `space-dock` | Space Dock | Open overview<br>Review status | read-only | game_events |
| `research` | `research-technology` | Technology | Open overview<br>Review status | read-only | game_events |
| `research` | `advanced-research` | Advanced Research | Open overview<br>Review status | read-only | game_events |
| `research` | `combat` | Combat | Open overview<br>Review status | read-only | game_events |
| `research` | `propulsion` | Propulsion | Open overview<br>Review status | read-only | game_events |
| `research` | `espionage` | Espionage | Open overview<br>Review status | read-only | game_events |
| `research` | `astrophysics` | Astrophysics | Open overview<br>Review status | read-only | game_events |
| `research` | `stargate-technology` | Stargate Technology | Open overview<br>Review status | read-only | game_events |
| `research` | `mothership-technology` | Mothership Technology | Open overview<br>Review status | read-only | game_events |
| `research` | `lifeform-research` | Lifeform Research | Open overview<br>Review status | read-only | game_events |
| `research` | `ascension-research` | Ascension Research | Open overview<br>Review status | read-only | game_events |
| `fleet` | `fleet-manager` | Fleet Manager | Open overview<br>Review status | read-only | game_events |
| `fleet` | `starships` | Starships | Open overview<br>Review status | read-only | game_events |
| `fleet` | `motherships` | Motherships | Open overview<br>Review status | read-only | game_events |
| `fleet` | `ship-upgrades` | Ship Upgrades | Open overview<br>Review status | read-only | game_events |
| `fleet` | `formations` | Formations | Open overview<br>Review status | read-only | game_events |
| `fleet` | `fleet-missions` | Fleet Missions | Open overview<br>Review status | read-only | game_events |
| `fleet` | `expeditions` | Expeditions | Open overview<br>Review status | read-only | game_events |
| `fleet` | `fleet-save` | Fleet Save | Open overview<br>Review status | read-only | game_events |
| `fleet` | `acs` | ACS | Open overview<br>Review status | read-only | game_events |
| `military` | `ground-forces` | Ground Forces | Open overview<br>Review status | read-only | game_events |
| `military` | `military-units` | Units | Open overview<br>Review status | read-only | game_events |
| `military` | `officers` | Officers | Open overview<br>Review status | read-only | game_events |
| `military` | `training-center` | Training Center | Open overview<br>Review status | read-only | game_events |
| `military` | `planetary-defense` | Planetary Defense | Open overview<br>Review status | read-only | game_events |
| `military` | `missile-warfare` | Missile Warfare | Open overview<br>Review status | read-only | game_events |
| `military` | `combat-simulator` | Combat Simulator | Open overview<br>Review status | read-only | game_events |
| `military` | `war-room` | War Room | Open overview<br>Review status | read-only | game_events |
| `military` | `campaigns` | Campaigns | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `galaxy-view` | Galaxy View | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `galaxy-map` | Galaxy Map | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `galaxy-solar-systems` | Solar Systems | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `3d-universe` | 3D Universe | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `galaxy-sectors` | Sectors | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `realm-systems` | Realm Systems | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `stargate-network` | Stargate Network | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `wormholes` | Wormholes | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `anomalies` | Anomalies | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `npc-factions` | NPC Factions | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `seed-discovery` | Seed Discovery | Open overview<br>Review status | read-only | game_events |
| `galaxy` | `galactic-calendar` | Galactic Calendar | Open overview<br>Review status | read-only | game_events |
| `economy` | `marketplace` | Marketplace | Open overview<br>Review status | read-only | game_events |
| `economy` | `resource-trading` | Resource Trading | Open overview<br>Review status | read-only | game_events |
| `economy` | `trade-routes` | Trade Routes | Open overview<br>Review status | read-only | game_events |
| `economy` | `merchant` | Merchant | Open overview<br>Review status | read-only | game_events |
| `economy` | `auction-house` | Auction House | Open overview<br>Review status | read-only | game_events |
| `economy` | `black-market` | Black Market | Open overview<br>Review status | read-only | game_events |
| `economy` | `insurance` | Insurance | Open overview<br>Review status | read-only | game_events |
| `crafting` | `workshop` | Workshop | Open overview<br>Review status | read-only | game_events |
| `crafting` | `master-crafting` | Master Crafting | Open overview<br>Review status | read-only | game_events |
| `crafting` | `crafting-rank` | Crafting Rank | Open overview<br>Review status | read-only | game_events |
| `crafting` | `materials` | Materials | Open overview<br>Review status | read-only | game_events |
| `crafting` | `materials-lab` | Materials Lab | Open overview<br>Review status | read-only | game_events |
| `crafting` | `dismantling` | Dismantling | Open overview<br>Review status | read-only | game_events |
| `crafting` | `augmentations` | Augmentations | Open overview<br>Review status | read-only | game_events |
| `crafting` | `artifacts` | Artifacts | Open overview<br>Review status | read-only | game_events |
| `crafting` | `blueprints` | Blueprints | Open overview<br>Review status | read-only | game_events |
| `alliance` | `alliance-hub` | Alliance Hub | Open overview<br>Review status | read-only | game_events |
| `alliance` | `members` | Members | Open overview<br>Review status | read-only | game_events |
| `alliance` | `commanders` | Commanders | Open overview<br>Review status | read-only | game_events |
| `alliance` | `alliance-officers` | Officers | Open overview<br>Review status | read-only | game_events |
| `alliance` | `diplomacy` | Diplomacy | Open overview<br>Review status | read-only | game_events |
| `alliance` | `war` | War | Open overview<br>Review status | read-only | game_events |
| `alliance` | `alliance-acs` | ACS | Open overview<br>Review status | read-only | game_events |
| `alliance` | `alliance-logistics` | Alliance Logistics | Open overview<br>Review status | read-only | game_events |
| `alliance` | `alliance-stargates` | Alliance Stargates | Open overview<br>Review status | read-only | game_events |
| `alliance` | `alliance-intelligence` | Alliance Intelligence | Open overview<br>Review status | read-only | game_events |
| `lifeforms` | `lifeforms-population` | Population | Open overview<br>Review status | read-only | game_events |
| `lifeforms` | `food` | Food | Open overview<br>Review status | read-only | game_events |
| `lifeforms` | `lifeform-buildings` | Lifeform Buildings | Open overview<br>Review status | read-only | game_events |
| `lifeforms` | `lifeforms-lifeform-research` | Lifeform Research | Open overview<br>Review status | read-only | game_events |
| `lifeforms` | `civilization-tier` | Civilization Tier | Open overview<br>Review status | read-only | game_events |
| `lifeforms` | `traits` | Traits | Open overview<br>Review status | read-only | game_events |
| `lifeforms` | `lifeform-bonuses` | Lifeform Bonuses | Open overview<br>Review status | read-only | game_events |
| `activities` | `quests` | Quests | Open overview<br>Review status | read-only | game_events |
| `activities` | `activities-expeditions` | Expeditions | Open overview<br>Review status | read-only | game_events |
| `activities` | `pirate-hunting` | Pirate Hunting | Open overview<br>Review status | read-only | game_events |
| `activities` | `bounty-board` | Bounty Board | Open overview<br>Review status | read-only | game_events |
| `activities` | `world-bosses` | World Bosses | Open overview<br>Review status | read-only | game_events |
| `activities` | `activities-anomalies` | Anomalies | Open overview<br>Review status | read-only | game_events |
| `activities` | `activities-campaigns` | Campaigns | Open overview<br>Review status | read-only | game_events |
| `activities` | `achievements` | Achievements | Open overview<br>Review status | read-only | game_events |
| `activities` | `seasonal-events` | Seasonal Events | Open overview<br>Review status | read-only | game_events |
| `prestige` | `glory` | Glory | Open overview<br>Review status | read-only | game_events |
| `prestige` | `reputation` | Reputation | Open overview<br>Review status | read-only | game_events |
| `prestige` | `prestige-ascension` | Ascension | Open overview<br>Review status | read-only | game_events |
| `prestige` | `re-ascension` | Re-Ascension | Open overview<br>Review status | read-only | game_events |
| `prestige` | `ascended-races` | Ascended Races | Open overview<br>Review status | read-only | game_events |
| `prestige` | `titles` | Titles | Open overview<br>Review status | read-only | game_events |
| `prestige` | `permanent-bonuses` | Permanent Bonuses | Open overview<br>Review status | read-only | game_events |
| `rankings` | `empire` | Empire | Open overview<br>Review status | read-only | game_events |
| `rankings` | `economy` | Economy | Open overview<br>Review status | read-only | game_events |
| `rankings` | `fleet` | Fleet | Open overview<br>Review status | read-only | game_events |
| `rankings` | `research` | Research | Open overview<br>Review status | read-only | game_events |
| `rankings` | `rankings-defense` | Defense | Open overview<br>Review status | read-only | game_events |
| `rankings` | `covert` | Covert | Open overview<br>Review status | read-only | game_events |
| `rankings` | `alliance` | Alliance | Open overview<br>Review status | read-only | game_events |
| `rankings` | `lifeform` | Lifeform | Open overview<br>Review status | read-only | game_events |
| `rankings` | `galactic-control` | Galactic Control | Open overview<br>Review status | read-only | game_events |
| `premium` | `store` | Store | Open overview<br>Review status | read-only | game_events |
| `premium` | `premium-officers` | Officers | Open overview<br>Review status | read-only | game_events |
| `premium` | `commander` | Commander | Open overview<br>Review status | read-only | game_events |
| `premium` | `premium-services` | Premium Services | Open overview<br>Review status | read-only | game_events |

## Action semantics

| Action family | Required server behavior |
|---|---|
| Inspection | Load scoped records, apply permission filters, calculate state server-side, and return feedback without mutation. |
| Refresh/recalculate | Lock relevant rows, recalculate deterministic values, persist snapshots or audit events atomically, and roll back on failure. |
| Queue/build/research | Validate blueprint or design, prerequisites, ownership, resource balance, power/capacity, queue limits, and completion time before locking resources. |
| Fleet/combat | Validate source ownership, target visibility, readiness, protection, fuel/resources, cooldown, and deterministic resolution before mutation. |
| Social/market | Validate participant ownership, public visibility, rate limits, order bounds, fees, and transactional settlement. |

## Database scope index

| Table | Referenced by routes |
|---|---|
| `alliance_members` | `social/alliances` |
| `alliances` | `social/alliances` |
| `ascension_states` | `account/ascension` |
| `ascensions` | `account/ascension` |
| `attack_logs` | `attack/attack-log` |
| `battle_reports` | `attack/attack-log` |
| `battles` | `attack/targets`, `attack/attack-log` |
| `blacklists` | `social/messages` |
| `building_types` | `planets/settlement` |
| `covert_missions` | `attack/spy`, `attack/sabotage`, `intelligence/spy-log` |
| `game_events` | `command-center/dashboard`, `training/units`, `training/unit-production`, `intelligence/intelligence-espionage`, `intelligence/spy-missions`, `intelligence/counter-espionage`, `intelligence/intelligence-sabotage`, `intelligence/reconnaissance`, `intelligence/sensor-phalanx`, `intelligence/fleet-activity`, `intelligence/intelligence-reports`, `social/social-messages`, `social/notifications`, `social/global-chat`, `social/buddy-list`, `social/recruitment`, `social/empires-at-war`, `planets/planet-list`, `planets/settlement`, `universe/galaxies`, `universe/sectors`, `overview/overview-dashboard`, `overview/empire-overview`, `overview/active-operations`, `overview/alerts`, `overview/tutorial-objectives`, `empire/planets`, `empire/colonies`, `empire/empire-moons`, `empire/buildings`, `empire/facilities`, `empire/storage`, `empire/population`, `empire/planet-specialization`, `resources/resource-overview`, `resources/metal`, `resources/crystal`, `resources/deuterium`, `resources/naquadah`, `resources/energy`, `resources/dark-matter`, `resources/production`, `resources/energy-grid`, `construction/construction-buildings`, `construction/construction-facilities`, `construction/construction-queue`, `construction/shipyard`, `construction/defense`, `construction/robotics`, `construction/nanite-factory`, `construction/terraformer`, `construction/space-dock`, `research/research-technology`, `research/advanced-research`, `research/combat`, `research/propulsion`, `research/espionage`, `research/astrophysics`, `research/stargate-technology`, `research/mothership-technology`, `research/lifeform-research`, `research/ascension-research`, `fleet/fleet-manager`, `fleet/starships`, `fleet/motherships`, `fleet/ship-upgrades`, `fleet/formations`, `fleet/fleet-missions`, `fleet/expeditions`, `fleet/fleet-save`, `fleet/acs`, `military/ground-forces`, `military/military-units`, `military/officers`, `military/training-center`, `military/planetary-defense`, `military/missile-warfare`, `military/combat-simulator`, `military/war-room`, `military/campaigns`, `galaxy/galaxy-view`, `galaxy/galaxy-map`, `galaxy/galaxy-solar-systems`, `galaxy/3d-universe`, `galaxy/galaxy-sectors`, `galaxy/realm-systems`, `galaxy/stargate-network`, `galaxy/wormholes`, `galaxy/anomalies`, `galaxy/npc-factions`, `galaxy/seed-discovery`, `galaxy/galactic-calendar`, `economy/marketplace`, `economy/resource-trading`, `economy/trade-routes`, `economy/merchant`, `economy/auction-house`, `economy/black-market`, `economy/insurance`, `crafting/workshop`, `crafting/master-crafting`, `crafting/crafting-rank`, `crafting/materials`, `crafting/materials-lab`, `crafting/dismantling`, `crafting/augmentations`, `crafting/artifacts`, `crafting/blueprints`, `alliance/alliance-hub`, `alliance/members`, `alliance/commanders`, `alliance/alliance-officers`, `alliance/diplomacy`, `alliance/war`, `alliance/alliance-acs`, `alliance/alliance-logistics`, `alliance/alliance-stargates`, `alliance/alliance-intelligence`, `lifeforms/lifeforms-population`, `lifeforms/food`, `lifeforms/lifeform-buildings`, `lifeforms/lifeforms-lifeform-research`, `lifeforms/civilization-tier`, `lifeforms/traits`, `lifeforms/lifeform-bonuses`, `activities/quests`, `activities/activities-expeditions`, `activities/pirate-hunting`, `activities/bounty-board`, `activities/world-bosses`, `activities/activities-anomalies`, `activities/activities-campaigns`, `activities/achievements`, `activities/seasonal-events`, `prestige/glory`, `prestige/reputation`, `prestige/prestige-ascension`, `prestige/re-ascension`, `prestige/ascended-races`, `prestige/titles`, `prestige/permanent-bonuses`, `rankings/empire`, `rankings/economy`, `rankings/fleet`, `rankings/research`, `rankings/rankings-defense`, `rankings/covert`, `rankings/alliance`, `rankings/lifeform`, `rankings/galactic-control`, `premium/store`, `premium/premium-officers`, `premium/commander`, `premium/premium-services` |
| `game_settings` | `command-center/resources`, `command-center/income` |
| `glory_reputation` | `command-center/account-info`, `account/ascension` |
| `intelligence_reports` | `attack/spy`, `intelligence/spy-log`, `intelligence/enemy-intelligence` |
| `market_orders` | `armory/weapon-market`, `market/resource-exchange` |
| `mercenary_types` | `market/mercenary-market` |
| `messages` | `social/messages` |
| `mothership_modules` | `mothership/modules`, `universe/sectors` |
| `motherships` | `planets/planet-list`, `mothership/ship`, `mothership/exploration`, `universe/sectors` |
| `planet_bonuses` | `planets/planet-list`, `planets/planet-bonuses` |
| `planet_defenses` | `planets/planet-list`, `planets/planet-defenses` |
| `planet_explorations` | `planets/planet-list`, `mothership/exploration` |
| `player_colonies` | `planets/planet-list`, `universe/universe-planets`, `universe/coordinates` |
| `player_cooldowns` | `planets/planet-list`, `universe/sectors` |
| `player_mercenaries` | `market/mercenary-market` |
| `player_planets` | `command-center/income` |
| `player_resources` | `command-center/dashboard`, `command-center/resources`, `command-center/income`, `command-center/military-stats`, `armory/repair`, `training/units`, `training/miners`, `training/super-units`, `training/unit-production`, `market/resource-exchange`, `planets/planet-list`, `planets/settlement` |
| `player_technologies` | `technology/technology`, `technology/tech-offense`, `technology/tech-defense`, `technology/tech-covert`, `technology/tech-anti-covert`, `universe/sectors` |
| `player_unit_stats` | `command-center/military-stats`, `training/units`, `training/unit-production` |
| `player_weapons` | `armory/weapons`, `armory/repair` |
| `players` | `command-center/dashboard`, `command-center/account-info`, `attack/targets`, `account/race` |
| `protection_states` | `account/vacation` |
| `races` | `command-center/account-info`, `command-center/income`, `account/race` |
| `rank_snapshots` | `social/rankings` |
| `rankings` | `command-center/dashboard`, `command-center/account-info`, `command-center/military-stats`, `social/rankings` |
| `sabotage_missions` | `attack/sabotage` |
| `settlement_buildings` | `planets/settlement` |
| `settlement_construction_queues` | `planets/settlement` |
| `settlement_fields` | `planets/settlement` |
| `spy_missions` | `attack/spy` |
| `target_realms` | `attack/targets`, `universe/galaxies` |
| `technologies` | `training/super-units`, `technology/technology`, `technology/tech-offense`, `technology/tech-defense`, `technology/tech-covert`, `technology/tech-anti-covert` |
| `training_queues` | `training/units`, `training/unit-production` |
| `unit_types` | `training/units`, `training/unit-production` |
| `universe_discoveries` | `universe/galaxies`, `universe/coordinates` |
| `universe_galaxies` | `universe/galaxies`, `universe/coordinates` |
| `universe_moons` | `universe/moons` |
| `universe_planets` | `planets/planet-list`, `universe/galaxies`, `universe/sectors`, `universe/solar-systems`, `universe/universe-planets`, `universe/moons`, `universe/coordinates` |
| `universe_sectors` | `universe/galaxies`, `universe/sectors`, `universe/coordinates` |
| `universe_solar_systems` | `universe/galaxies`, `universe/sectors`, `universe/solar-systems`, `universe/coordinates` |
| `vacation_states` | `account/vacation` |
| `weapon_types` | `armory/weapons`, `armory/weapon-market` |
