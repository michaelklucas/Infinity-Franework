<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Config\src\Database;
use App\Config\src\Environment;
use App\Http\Middleware\Queue;
use App\Utils\View;

Environment::load(__DIR__ . '/../');

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT'),
);

define('URL', getenv('URL'));
define('NAME_APP', getenv('NAME_APP'));
define('EMAIL', getenv('EMAIL'));

View::init([
    'TITLE' => NAME_APP,
    'URL' => URL,
    'NAME_APP' => NAME_APP,
    'EMAIL' => EMAIL
]);

Queue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class,
    'require-usuarios-logout' => \App\Http\Middleware\RequireUserLogout::class,
    'require-usuarios-login' => \App\Http\Middleware\RequireUserLogin::class,
    'pro-user' => \App\Http\Middleware\ProUser::class,
    'empresa' => \App\Http\Middleware\Empresa::class,
    'cache' => App\Http\Middleware\Cache::class,
]);

Queue::setDeafault([
    'maintenance'
]);
