# Installation

Install the packages

```bash
composer require nwidart/laravel-modules 
```

Add This line to composer.json

```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      // Start
      "Modules\\": "Modules/"
      // End
    }
  }
}
"post-update-cmd": [
// Start
"@php artisan filament:upgrade"
// End
],
```

Download the module and place it in Modules directory. Then enable it with this command

```bash
php artisan module:enable FilamentBase
php artisan module:update
```

Publish the assets

```bash
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
php artisan vendor:publish --tag=filament-config
php artisan vendor:publish --tag=filament-translations
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --tag="filament-spatie-roles-permissions-config"
```