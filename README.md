Laravel 5 adminamazing
======================
base admin for laravel
simple


-----------------
Install via composer
```
composer require selfreliance/adminamazing
```

Add Service Provider to `config/app.php` in `providers` section
```php
Selfreliance\Adminamazing\AdminAmazingServiceProvider::class,
```


Go to `http://myapp/admin` to view admin amazing

**Move public fields** for view customization:

```
php artisan vendor:publish
``` 
```
php artisan vendor:publish --tag=config|assets --force
``` 