<?php

namespace App\Routes;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\ProductController;

$app->get('/products', function (Request $request, Response $response, $args) {
    $products = new ProductController();
    $response->getBody()->write($products->index()->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $products = new ProductController();
    $response->getBody()->write($products->show($id)->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/products', function (Request $request, Response $response, $args) {
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
    $products = new ProductController();
    $response->getBody()->write($products->create($data)->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/products/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $products = new ProductController();
    $deleteResponse = $products->destroy($id);
    if (!$deleteResponse) {
        $response->getBody()->write(json_encode(['statusCode' => 404, 'error' => 'Não foi possível excluir o produto.']));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
    $response->getBody()->write(json_encode(['statusCode' => 200, 'message' => 'Produto excluído com sucesso.']));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->put('/products/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $data = $request->getParsedBody();
    if ($data === null) {
        $response->getBody()->write(
            json_encode([
                'statusCode' => 400,
                'error' => 'Não foi possível atualizar o produto, verifque os dados informados.'
            ])
        );
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }
    $products = new ProductController();
    $productUpdated = $products->update($id, $data);
    if (!$productUpdated) {
        $response->getBody()->write(json_encode(['statusCode' => 404, 'error' => 'Não foi possível atualizar o produto.']));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
    $response->getBody()->write($productUpdated->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});
