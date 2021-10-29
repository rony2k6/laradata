# laradata
A test app to show/filter data, using laravel, prosgres, redis


## Requirements

- nginx/apache
- php7.4+
- postgreSQL
- redis
- composer
- git


## Installation

- git clone <repo url> && cd [project directory]/
- composer install
- write db credential in `.env` file following `.env.example`
- place `test-data.csv` inside database/seeders/seeds/ directory after renaming to `users.csv`; *if csv file is not there 
- php artisan migrate --seed
- php artisan serve


## License

This Laravel Application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
