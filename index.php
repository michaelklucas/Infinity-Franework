<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 0);


ob_start();

date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/includes/app.php';

use App\Http\Router;
$obRouter = new Router(URL);

include __DIR__.'/routes/web.php';
include __DIR__.'/routes/api.php';

$obRouter->run()->sendResponse();
