# Laravel 5 Admin Amazing adminrole
adminamazing - a package admin with basic roles and basic packages

## Require

- [roles](https://github.com/selfrelianceme/fixroles)
- [iusers](http://github.com/selfrelianceme/iusers)

## How to install

Install via composer
```
composer require selfreliance/adminamazing
```

Config
```php
php artisan vendor:publish --provider="Selfreliance\Adminamazing\AdminAmazingServiceProvider" --tag="config" --force
```

Middleware
```php
php artisan vendor:publish --provider="Selfreliance\Adminamazing\AdminAmazingServiceProvider" --tag="middleware" --force
```

Styles
```php
php artisan vendor:publish --provider="Selfreliance\Adminamazing\AdminAmazingServiceProdiver" --tag="assets" --force
```

And if you have already install/installed package roles - [click here](https://github.com/selfrelianceme/fixroles/blob/master/README.md)
