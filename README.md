# Getting Started with I Event Php Laravel APP

This project was created with PHP Laravel

## Projet Setup
Clone the repository from master branch

RUN
### `Composer Install`
Installs necessary packages using composer

### `cp .env.example .env`
Copies example env file into your env file\
Create a database and add credentials to your database using\
DB_CONNECTION=mysql\
DB_HOST=127.0.0.1\
DB_PORT=3306\
DB_DATABASE=eventapp\
DB_USERNAME=root\
DB_PASSWORD=

### `php artisan key:generate`
generates application key

### `php artisan passport:install`
Installs passport migrations and necessary dependencies

### `php artisan migrate`
Runs the migration in your local database

### `php artisan db:seed`
Seeds the necessary tables 

### `Run the frontend react app form other repo`
Login using following credentials or you can sign up anytime\
email:user@gmail.com\
password:User@12345

### `Enjoy the application`
