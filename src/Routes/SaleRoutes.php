<?php

namespace App\Routes;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\SaleController;

$app->post('/sales', function (Request $request, Response $response, $args) {
    $sale = new SaleController();
    $response->getBody()->write($sale->create()->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});
