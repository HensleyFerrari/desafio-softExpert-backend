<?php

namespace App\Routes;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\TypeController;

$app->get('/types', function (Request $request, Response $response, $args) {
    $types = new TypeController();
    $response->getBody()->write($types->index()->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/types/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $types = new TypeController();
    $response->getBody()->write($types->show($id)->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/types', function (Request $request, Response $response, $args) {
    $data = $request->getParsedBody();
    if ($data === null) {
        $response->getBody()->write(
            json_encode([
                'statusCode' => 400,
                'error' => 'Não foi possível salvar o tipo, verifque os dados informados.'
            ])
        );
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }
    $types = new TypeController();
    $response->getBody()->write($types->create($data)->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/types/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $types = new TypeController();
    $deleteResponse = $types->destroy($id);
    if (!$deleteResponse) {
        $response->getBody()->write(json_encode(['statusCode' => 404, 'error' => 'Não foi possível excluir o tipo.']));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
    $response->getBody()->write(json_encode(['statusCode' => 200, 'message' => 'Tipo excluído com sucesso.']));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->put('/types/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $data = $request->getParsedBody();
    if ($data === null) {
        $response->getBody()->write(
            json_encode([
                'statusCode' => 400,
                'error' => 'Não foi possível atualizar o tipo, verifque os dados informados.'
            ])
        );
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }
    $types = new TypeController();
    $typeUpdated = $types->update($id, $data);
    if (!$typeUpdated) {
        $response->getBody()->write(json_encode(['statusCode' => 404, 'error' => 'Não foi possível atualizar o tipo.']));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
    $response->getBody()->write($typeUpdated->toJson());
    return $response->withHeader('Content-Type', 'application/json');
});
