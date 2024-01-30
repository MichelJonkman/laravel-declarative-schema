# Laravel Declarative Schema

Laravel integration for my [declarative-schema package](https://github.com/MichelJonkman/declarative-schema).

## Usage

To create a new schema file call the command below.

```
php artisan make:schema table_name
```

For more information on how to write schema files, take a look at [declarative-schema package](https://github.com/MichelJonkman/declarative-schema).

And in order to migrate them you can either use the normal migrate command:

```
php artisan migrate
```

Or use the specific command to migrate schema files.

```
php artisan migrate:schema
```

Rollbacks don't do anything for schema files since you can just revert the file to its previous state and migrate again.
