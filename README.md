## Dependencies

Sentry: https://cartalyst.com/manual/sentry/2.1

## Installation

### Provider: 
```
'Lqdi\LaravelLogin\ServiceProvider',
```

### Command: 

```
php artisan config:publish lqdi/laravel-login
php artisan config:publish lqdi/laravel-login --path="workbench/lqdi/laravel-login/src/config"
php artisan asset:publish lqdi/laravel-login
php artisan asset:publish --bench="lqdi/laravel-login"
```

### Config:
app/config/packages/lqdi/laravel-login/config.php

#### Filter:

```
auth.laravel-login
```

#### Route name for edit Profile:

```
profile.edit
```