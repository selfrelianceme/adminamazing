# Laravel 5 Admin Amazing adminrole
adminamazing - a package admin with basic roles and basic packages

## Require

- [roles](https://github.com/selfrelianceme/fixroles)
- [iusers](http://github.com/selfrelianceme/iusers)
- [adminmenu](https://github.com/selfrelianceme/adminmenu)

## How to install

Install via composer
```
composer require selfreliance/adminamazing
```

Config, Middleware, Styles
```php
php artisan vendor:publish --provider="Selfreliance\Adminamazing\AdminAmazingServiceProvider" --force
```

## Blocks

# Register

\Blocks::register('name', function(){
	return '123';
}); // register block with function

\Blocks::register('name', 'NameClass@function'); // register block with class

# Get

\Blocks::get('name'); // get block name

\Blocks::all(); // all blocks

##

And if you have already install/installed package roles - [click here](https://github.com/selfrelianceme/fixroles/blob/master/README.md)
have already install/installed package flash - [click here](https://github.com/laracasts/flash/blob/master/readme.md)
