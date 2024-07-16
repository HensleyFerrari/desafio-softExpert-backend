<?php

namespace App\Routes;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\SaleProductController;

$app->get('/sale_products', function (Request $request, Response $response, $args) {
    $saleProducts = new SaleProductController();
    $response->getBody()->write($saleProducts->index()->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/sale_products', function (Request $request, Response $response, $args) {
    $data = $request->getParsedBody();
    if ($data === null) {
        $response->getBody()->write(
            json_encode([
                'statusCode' => 400,
                'error' => 'Não foi possível salvar o produto, verifque os dados informados.'
            ])
        );
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }
    $saleProducts = new SaleProductController();
    $response->getBody()->write($saleProducts->create($data)->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});
