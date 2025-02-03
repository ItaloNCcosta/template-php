<?php

use App\Http\Router;
use Symfony\Component\Dotenv\Dotenv;

session_start();

define('ROOT', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR);

require '../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__).'/.env');

$routes = require_once '../routes/web.php';

try {
    Router::run($routes);
} catch (\Exception $e) {
    echo $e->getMessage();
    http_response_code($e->getCode());
}
