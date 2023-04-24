# Laravel DBAL Schema

Uses doctrine/dbal to manage a declarative schema approach that works together with migrations

## Usage

To create a new schema file and use the [DBAL docs](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/schema-representation.html#column) to create your columns:

```
php artisan make:schema database_name
```

And in order to migrate them you can either use the normal migrate command:

```
php artisan migrate
```

Or use the specific command to migrate schema files.

```
php artisan migrate:schema
```
