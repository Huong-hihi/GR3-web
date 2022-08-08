## Requirement

- PHP >= 7.1.3
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL
- Composer
- Git

## Setup
- Installing project:

``git clone https://github.com/Huong-hihi/GR3-web.git``

- Create environment file:

Copy file `.env.example` to `.env`

- Installing vendor

``composer install``

- Generate key:

``php artisan key:generate``

- Database migration

``php artisan migrate``

Or import database

- Run project

``php artisan serve``
