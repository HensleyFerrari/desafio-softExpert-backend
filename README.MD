## Desafio SoftExpert

## Tecnologias utilizadas

- [PHP](https://www.php.net/)
- [PostgreSQL](https://www.postgresql.org/)
- [Slim](https://www.slimframework.com/)
- [Phinx](https://phinx.org/)
- [PHPUnit](https://phpunit.de/index.html)
- [Composer](https://getcomposer.org/)


## Arquivo o Restore do PostgreSQL

`pg_restore.exe --username postgres --dbname products_db "PATH DO ARQUIVO"`

o banco de dados será criado automaticamente
criando assim 5 tabelas

| Tabela | Nome          | Descrição                   |
| ------ | ------------- | --------------------------- |
| 0      | phinxlog      | Log de migrações            |
| 1      | products      | Tabela de produtos          |
| 2      | sales         | Tabela de vendas            |
| 3      | sale_products | Tabela de produtos vendidos |
| 4      | types         | Tabela de tipos             |

### Comando para instalar as dependências

`composer install`

#### Comando para rodar o servidor

`php -S localhost:8000 -t public/`

## Rotas 

### Rotas Products

| Metodo | Rota | Descrição |
| ------ | ---- | --------- |
| GET    | /products | Retorna todos os produtos |
| GET    | /products/{id} | Retorna o produto com o id informado |
| POST   | /products | Cria um novo produto |
| PUT    | /products/{id} | Atualiza o produto com o id informado |
| DELETE | /products/{id} | Exclui o produto com o id informado |


### Rotas Types

| Metodo | Rota | Descrição |
| ------ | ---- | --------- |
| GET    | /types | Retorna todos os tipos |
| GET    | /types/{id} | Retorna o tipo com o id informado |
| POST   | /types | Cria um novo tipo |
| PUT    | /types/{id} | Atualiza o tipo com o id informado |
| DELETE | /types/{id} | Exclui o tipo com o id informado |


### Rotas Sales

| Metodo | Rota | Descrição |
| ------ | ---- | --------- |
| POST   | /sales | Cria uma nova venda |

## Rotas Sale Products

| Metodo | Rota | Descrição |
| ------ | ---- | --------- |
| POST   | /sale_products | Cria um novo produto vendido |
