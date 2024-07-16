<?php

use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ServerRequestFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

use Slim\Factory\AppFactory;
use App\Middleware\CorsMiddleware;
use App\Models\Product;

class RouteTest extends TestCase
{
    protected $app;

    public function setUp(): void
    {
        $this->app = AppFactory::create();

        $this->app->addErrorMiddleware(true, true, true);
        $this->app->addBodyParsingMiddleware();
        $this->app->add(new CorsMiddleware());
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'pgsql',
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_NAME'],
            'username' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
    public function testGetAllProducts()
    {
        $request = (new ServerRequestFactory)->createServerRequest('GET', '/products');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode(), 'Falha ao obter todos os produtos: Status code diferente de 200');
        // Caso o banco de dados esteja vazio
        $this->assertStringContainsString('[]', (string) $response->getBody());

        return $response->getStatusCode();
    }

    public function testAddProduct()
    {
        $productData = [
            'name' => 'Teste',
            'description' => 'Descrição do teste',
            'price' => 100,
            'type_id' => 1,
        ];

        $request = (new ServerRequestFactory)->createServerRequest('POST', '/products')->withParsedBody($productData);
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode(), 'Falha ao adicionar produto: Status code diferente de 200');
        $responseBody = json_decode((string) $response->getBody(), true);
        $this->assertEquals('Teste', $responseBody['name'], 'Falha ao adicionar produto: Nome do produto diferente de Teste');
        $this->assertEquals(100, $responseBody['price'], 'Falha ao adicionar produto: Preço do produto diferente de 100');
        $this->assertEquals(1, $responseBody['type_id'], 'Falha ao adicionar produto: Tipo do produto diferente de 1');
    }

    public function testGetProduct()
    {
        $product = Product::create([
            'name' => 'Teste',
            'description' => 'Descrição do teste',
            'price' => 100,
            'type_id' => 1,
        ]);

        $request = (new ServerRequestFactory)->createServerRequest('GET', "/products/{$product->id}");
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $responseBody = json_decode((string) $response->getBody(), true);
        $this->assertEquals('Teste', $responseBody['name'], 'Falha ao obter produto: Nome do produto diferente de Teste');
        $this->assertEquals(100, $responseBody['price'], 'Falha ao obter produto: Preço do produto diferente de 100');
        $this->assertEquals(1, $responseBody['type_id'], 'Falha ao obter produto: Tipo do produto diferente de 1');
    }

    public function testUpdateProduct()
    {
        $product = Product::create([
            'name' => 'Teste',
            'description' => 'Descrição do teste',
            'price' => 100,
            'type_id' => 1,
        ]);

        $productData = [
            'name' => 'Teste atualizado',
            'description' => 'Descrição do teste atualizado',
            'price' => 200,
            'type_id' => 1,
        ];

        $request = (new ServerRequestFactory)->createServerRequest('PUT', "/products/{$product->id->withParsedBody($productData)}");
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode(), 'Falha ao atualizar produto: Status code diferente de 200');
        $responseBody = json_decode((string) $response->getBody(), true);
        $this->assertEquals('Teste atualizado', $responseBody['name'], 'Falha ao atualizar produto: Nome do produto diferente de Teste atualizado');
        $this->assertEquals(200, $responseBody['price'], 'Falha ao atualizar produto: Preço do produto diferente de 200');
        $this->assertEquals(1, $responseBody['type_id'], 'Falha ao atualizar produto: Tipo do produto diferente de 1');
    }

    public function testDeleteProduct()
    {
        $product = Product::create([
            'name' => 'Teste',
            'description' => 'Descrição do teste',
            'price' => 100,
            'type_id' => 1,
        ]);

        $request = (new ServerRequestFactory)->createServerRequest('DELETE', "/products/{$product->id}");
        $response = $this->app->handle($request);

        $this->assertEquals(204, $response->getStatusCode(), 'Falha ao excluir produto: Status code diferente de 204');
        $this->assertNull(Product::find($product->id), 'Falha ao excluir produto: Produto não excluído');
    }
}
