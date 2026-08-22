# MMO Expansion Source Pack

This package adds a deep browser-MMO source foundation to `mmotest`.

## Included

- Shared PHP MMO layout
- Full navigation/page scaffold
- Economy service
- Building/construction service
- Research queue
- Fleet missions
- Combat resolver
- Intelligence resolver
- Procedural galaxy generator
- Stargate service
- Market service
- Event bus
- Turn processor
- Expansion SQL
- Cron entry point
- Blue metallic responsive UI

## Integration

1. Review existing database names before applying `sql/100_mmo_expansion.sql`.
2. Merge the service classes with the existing namespace/autoload convention.
3. Replace placeholder page controllers with the existing authenticated player context.
4. Add CSRF/authorization checks to all mutating actions.
5. Run the turn processor from the existing cron scheduler.
6. Keep the existing canonical schema as the source of truth where tables overlap.

## Important

This is an expansion scaffold, not a blind overwrite of the existing application. Existing repository services and schemas should be reconciled before production deployment.
