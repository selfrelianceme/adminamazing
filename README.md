# Laravel 5 Admin Amazing
adminamazing - a package admin with basic roles and basic packages

[How to config roles](https://github.com/selfrelianceme/fixroles/blob/master/README.md)
[How to config flash messages](https://github.com/laracasts/flash/blob/master/readme.md)

##

- [Blocks](#blocks)
	- [Creating blocks](#creating-blocks)
	- [Get blocks](#get-blocks)
- [Push](#push)
	- [Push scripts](#push-scripts)
	- [Push display](#push-display)

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

### Creating blocks

Blocks need to be created in __construct()

```php
\Blocks::register('name', function(){
	return 'test';
}); // with simple function

\Blocks::register('name', 'className@nameFunction'); // with function from controller/class
```

### Get blocks

```php
\Blocks::get('name'); // get block by name

\Blocks::all(); // get all blocks
```

## Push

### Push scripts

```
@push('scripts')
// any your scripts
@endpush
```

### Push display

```
@push('display')
// any for display
@endpush
```