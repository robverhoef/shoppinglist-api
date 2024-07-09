# Simple shopping list API

This is a very basic starter project for a shoppinglist REST API using Laravel. 

## Features: 
  - Multi-user CRUD for shoppinglists
  - each item has a togglable 'checked' attribute to indicate if it has been checked off.

## Requirements

This is based on Laravel 11. So the [minimum requirements of Laravel](https://laravel.com/docs/11.x/deployment#server-requirements) apply here. It currently aims for using SQLite so you don't need a database server.

## Install
To run this locally:
 - clone this repo 
 - run 
   ```composer install```
- copy .env.example to .env and optionally adjust the database settings
 - run 
   ```php artisan key:generate```
 - run 
   ```php artisan migrate```
 - run 
   ```php artisan serve```

## Usage
 - You may want to define a route in routes/web.php to connect a frontend to this API.
 - [CORS](https://laravel.com/docs/11.x/routing#cors) has not been implemented yet.
 - See ```artisan route:list``` for all available routes.
 - Authentication is token based. Save the token when registering or logging in. 
 - You may want to use the /postman_shoppinglist.json with [Postman](https://www.postman.com) or /bruno_shoppinglist.json with [Bruno](https://www.usebruno.com) for testing. 
 - Data structure to be used in your front-end: 
  ```
    users: [name, email, password]
    - shoppinglists: [name, shopping_date]
    - - items: [name, quantity, unit, checked]
  ```
 - Tip: if you are developing a separate frontend, you may want to use the [proxy feauture](https://vitejs.dev/config/server-options#server-proxy) of Vite to connect to this API. 

### Suggestions for further development
 - add softDelete to create a trash can feature 
 - add a sequence number to each item to allow reordering, so you can stop wandering around stores that you already know the layout of 
 - provide an endpoint for the optional unit (kg, gram, pack, etc.) to create an auto-complete input 
 - add [swagger-ui](https://swagger.io/tools/swagger-ui/) for easier development of the API and front-end.
 - add more tests

## Testing
A memory based SQLite database is used for testing.

run ```./vendor/bin/phpunit```


## License
[WTFPL license](https://en.wikipedia.org/wiki/WTFPL).
