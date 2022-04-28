# Setup

## Sail

This is Laravel's built in docker functionality.

```
composer install
cp .env.example to .env 
```

### Update the following fields in .env

```
DB_DATABASE=visionable 
DB_USERNAME=visionable 
DB_PASSWORD=visionable 

WWWGROUP=1000
WWWUSER=1000
```

### Install sail.

``` 
php artisan sail:install

  select mariadb at the prompt
```

### Run sail.

```
./vendor/bin/sail up
```

### Generate the database.

```
./vendor/bin/sail artisan migrate
```

### Run the provided integration tests.

```
./vendor/bin/sail artisan test --filter ClinicControllerTest
./vendor/bin/sail artisan test --filter AppointmentControllerTest
```

## Manually 

### Dependencies

php<br> 
composer<br>
mariadb<br> 

in php.ini enable

```
extension=mysqli 
extension=pdo_mysql
```

```
composer install 
composer dumpautoload 
```

cp .env.example to .env 

### Update the following fields in .env

```
DB_DATABASE=visionable 
DB_USERNAME=visionable 
DB_PASSWORD=visionable 
```

Create a mariadb user named visionable, with password visionable, and database named visionable. 

Generate the database schema using the project's migration files.

```
php artisan migrate 
```

### Running

```
php artisan serve 
```

### Testing

I've included a postman workspace, postman_collection.json, with the basic CRUD routes. The routes are setup to work with the default laravel instance Sail sets up. 

You may also run the two individual unit (integration) tests provided. 

```
php artisan test --filter ClinicControllerTest
php artisan test --filter AppointmentControllerTest
```

# Authentication

I considered guarding the api with user authentication, so Laravel's Breeze framework is in place, but I felt it complicated the basic ask so it has not been fully implemented.
