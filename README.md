# Kanye Quotes App

## Prerequisites

- [PHP](https://www.php.net/) (8.1 or higher)
- [Composer](https://getcomposer.org/)

## Installation

```bash
git clone https://github.com/andgith/kanye-app.git
cd kanye-app
composer install
cp .env.example .env

# Update .env with desired API key

php artisan key:generate
php artisan serve
```
Visit http://localhost:8000 in your browser.

## Testing
    
```bash
php artisan test
```

## Usage

### Get quotes
```bash
GET /api/v1/quotes
```

### Refresh quotes
```bash
GET /api/v1/quotes/refresh
```

Note: This will only work if you have an API key set in your .env file and include the key as a `X-API-KEY` header with your request.
