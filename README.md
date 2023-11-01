## Description
Exchange api

## Init setup
1. Clone project
2. Copy .env.example into .env
3. Change smtp params if you want to receive an email
4. Run docker: docker-compose up
5. Run composer install: docker exec php-exchange-api composer install
6. Run migrations: docker exec php-exchange-api php artisan migrate
7. Run database seeder: docker exec php-exchange-api php artisan db:seed

## Docker
Exchange front application is fully dockerized.
```bash
$ docker-compose up
```
Exchange api uses port `8000`.
