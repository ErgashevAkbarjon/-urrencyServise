# CurrencyServise

Service in Lumen that takes it's data from http://www.cbr.ru/development/SXML/

## Installation

1. Clone repo
2. Create database for service
3. Copy .env.example to .env and change db configs to yours
4. Run

    ```bash
    composer install
    ```

5. Run

    ```bash
    php artisan migrate:refresh
    ```

6) Run

    ```bash
    php -S localhost:8000 -t public
    ```

7) Run

    ```bash
    php artisan update:currencies
    ```

That's all!

## Update Currencies

Run

```bash
php artisan update:currencies
```
