<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use App\Config\Database;
use App\Middleware\CorsMiddleware;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
new Database();

require __DIR__ . '/../src/Routes/ProductRoutes.php';
require __DIR__ . '/../src/Routes/TypeRoutes.php';
require __DIR__ . '/../src/Routes/SaleRoutes.php';
require __DIR__ . '/../src/Routes/SaleProductRoutes.php';

$app->run();
