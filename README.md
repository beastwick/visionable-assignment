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

### Update the following fields in .env

```
APP_ENV=local 

DB_DATABASE=visionable 
DB_USERNAME=visionable 
DB_PASSWORD=visionable 
```

Create a mariadb user named visionable, with password visionable, and database named visionable. 

Generate the database schema using the project's migration files.

```
php artisan migrate 
```

# Running

```
php artisan serve 
```

# Testing

I've included a postman workspace, postman_collection.json, with the basic CRUD routes. 

You may also run the two individual unit (integration) tests provided. 

```
php artisan test --filter ClinicControllerTest
php artisan test --filter AppointmentControllerTest
```

# Additional

I considered guarding the api with user authentication, so Laravel's Breeze authentication framework is in place, but I think it over complicated the ask of the project. In the real world I would have authentication in place to interact with my API.
