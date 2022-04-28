# Dependencies

php<br> 
composer<br>
mariadb<br> 

in php.ini enable

```
extension=mysqli 
extension=pdo_mysql
```

# Setup

```
composer install 
composer dumpautoload 
```

cp .env.example to .env 

## Update the following fields in .env:

```
APP_ENV=local 

DB_DATABASE=visionable 
DB_USERNAME=visionable 
DB_PASSWORD=visionable 
```

Create a mariadb user named visionable, with password visionable, and database named visionable. 

```
php artisan migrate 
```

# Running

```
php artisan serve 
```

# Testing

I've included a postman workspace with the basic CRUD routes. 

You may also run the two individual unit (integration) tests provided. 

```
php artisan test --filter ClinicControllerTest
php artisan test --filter AppointmentControllerTest
```
