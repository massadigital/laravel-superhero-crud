## Super Hero CRUD

CRUD usando Laravel 5.6


Configurar o Banco de dados em config/database.php
```bash
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'SERVIDOR'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'NOME_DO_BANCO'),
            'username' => env('DB_USERNAME', 'USUARIO'),
            'password' => env('DB_PASSWORD', 'SENHA'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

```

Executar os comandos:
```bash
composer install
npm install
npm run dev
php artisan storage:link
php artisan key:generate
php artisan migrate
php artisan serve
```
Abrir o navegador em: http://localhost:8000
