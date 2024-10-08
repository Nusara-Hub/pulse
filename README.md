# Nusara Pulse
HRM manages the pulse of human resources within the company, ensuring that all employee-related aspects, from recruitment to development, run smoothly.

## What is Nusara Pulse?
Nusara Pulse is a Laravel-based HRM system that helps manage employee-related aspects within a company. It provides a comprehensive set of features to streamline HR processes, from recruitment to development.

## Usefull Commands
### Publishing Migration to core tenants:
```
php artisan vendor:publish --tag=pulse-migrations
```

### Execute Nusara Pulse Commands

#### Creating Pulse Migrations
```
<!-- Table name must be in plural and in lowercase -->
<!-- adding _table as prefix will be the important thing -->
php artisan nusara:pulse-exec --migration=create_examples_table
```

#### Seeder
```
php artisan nusara:pulse-exec --seed
```

#### Execute Tenants Migrations
```
<!-- For Migrating Tenant -->
php artisan tenants:migrate

<!-- Drop all existing tenants table and migrate -->
php artisan tenants:migrate-fresh

```

## Credits
- [Rembon Karya Digital](https://github.com/rembonnn)
- [DayCod](https://github.com/dayCod)
- [Ade Yusuf](https://github.com/adeyusuf211)
- [See All Contributors](https://github.com/rembonnn/laravel-auditor/contributors)
