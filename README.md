# Laravel Auto Timestamps

This package adds the ability to use auto-updating timestamps for MySQL databases.


## Installation 
You can install the package via composer:

```bash
composer require esign/laravel-auto-timestamps
```

If you want to define the database connections on which the migration helpers should be available, you could publish the config file:

```bash
php artisan vendor:publish --provider="Esign\AutoTimestamps\AutoTimestampsServiceProvider"
```

## Usage

### Specifying database connections

To specify the database connections on which the migrations should be available, edit the connections array in the config file. The mysql connection is used by default.

```php
'connections' => [
    'mysql',
],
```

### Migrations

This package provides a `->useCurrentUpdate()` method on the blueprint class, which only triggers when running against a MySQL database.

A blueprint macro `->autoTimestamps()` is included that will allow you to quickly set up auto-updating `created_at` and `updated_at` timestamps. You may edit the name of this macro in the config file.

```php
$table->autoTimestamps();

// results in:
$table->timestamp('created_at')->useCurrent();
$table->timestamp('updated_at')->useCurrentUpdate();

```
