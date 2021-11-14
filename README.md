# Code challange
Service catalogue

## API
Routes are definied in [routes/web.php](routes/web.php). Main class for service catalog api is [App\Http\Controllers\ServiceController.php](app/Http/Controllers/ServiceController.php). 
1. Clone repository:
```git clone URL```
2. Start php dev server:
```php -S localhost:8000 -t public```
3. Available endpoints:
 - GET http://localhost:8000/services
 - GET http://localhost:8000/services/{countryCode}
 - POST http://localhost:8000/services, params: `Ref,Centre,Service,Country`
 
## CLI
Commands for service catalog are in [app\Console\Commands](https://github.com/laczakan/instruct-eric/tree/main/app/Console/Commands). 

1. Get all services
```
php artisan service:index
```
1. Query services
```
php artisan service:get {countryCode}
```

## Requirements
Laravel [Lumen](https://lumen.laravel.com/docs). is a stunningly fast PHP micro-framework for building web applications.

