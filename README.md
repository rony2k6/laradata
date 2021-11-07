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

- git clone [repo url] && cd [project directory]/
- composer install
- write db credential in `.env` file following `.env.example`
- place `test-data.csv` inside database/seeders/seeds/ directory then rename to `users.csv`.
- php artisan migrate --seed
- php artisan key:generate
- php artisan serve


## Note

```so here you are fetching full result set from redis cache. Please rewrite pagination logic to fetch only the required rows from Redis.```
The above feedback gives me 2 different impressions below:
    1) It means I should cache with page too for all result sets (with & without search); which I did in my 1st submission but then requested to remove page number from caching.
    2) It means to cache results (for without search condition.. where I was caching all rows) with pagination but not all. And the implementation with search will be as they were.
I've concluded to point 1 in my current implementation; which seems to me more appropriate as it'll be effeicient for large data set.


## Output Snap

![alt text](screenshot.png "Output screenshot")


## License

This Laravel Application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
