# Setup

## Sail

### Dependencies

composer<br>
docker<br>

### Install

```
composer install
cp .env.example .env
```

### Modify .env

```
DB_DATABASE=visionable
DB_USERNAME=visionable
DB_PASSWORD=visionable

WWWGROUP=1000
WWWUSER=1000
```

### Install Sail

Select MariaDB at the prompt.

```
php artisan sail:install
```

### Run

```
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
```

### Test

```
./vendor/bin/sail artisan test --filter ClinicControllerTest
./vendor/bin/sail artisan test --filter AppointmentControllerTest
```

## Local

### Dependencies

composer<br>
php<br>
mariadb>br>

## Install

```
composer install
composer dumpautoload
cp .env.example .env
```

### Modify php.ini

```
extension=mysqli
extension=pdo_mysql
```

### Setup MariaDB

Create a mariadb user named visionable, with password visionable, and database named visionable.

### Modify .env

```
DB_DATABASE=visionable
DB_USERNAME=visionable
DB_PASSWORD=visionable
```

### Run database migrations.

```
php artisan migrate
```

### Run

```
php artisan serve
```

### Test

```
php artisan test --filter ClinicControllerTest
php artisan test --filter AppointmentControllerTest
```

# Authentication

I considered guarding the api with user authentication, so Laravel's Breeze framework is in place, but I felt it complicated the basic ask so it has not been fully implemented.
