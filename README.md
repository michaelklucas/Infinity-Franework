# Infinity Framework

Infinity é uma framework PHP minimalista para construção de aplicações web. Este documento fornece instruções para a instalação e uso da framework, com foco especial no sistema de migrações.

## Índice

- [Instalação](#instalação)
- [Configuração](#configuração)
- [Migrações](#migrações)
  - [Criar uma nova migração](#criar-uma-nova-migração)
  - [Aplicar migrações](#aplicar-migrações)
  - [Reverter migrações](#reverter-migrações)
- [Estrutura de Diretórios](#estrutura-de-diretórios)
- [Uso do ORM](#uso-do-orm)

## Instalação

Clone o repositório do Infinity Framework e instale as dependências via Composer:

```bash
git clone https://github.com/seu-usuario/infinity-framework.git
cd infinity-framework
composer install
```

Configuração
Crie um arquivo .env na raiz do projeto e configure as variáveis de ambiente conforme necessário:

```bash
URL=https://localhost
NAME_APP=Infinity
EMAIL=
DB_HOST=localhost
DB_NAME=seu_banco_de_dados
DB_USER=seu_usuario
DB_PASS=sua_senha
DB_PORT=3306
MAINTENANCE=false
```

Carregue o ambiente de desenvolvimento:

```bash
<?php

require __DIR__ . '/vendor/autoload.php';

use App\Config\src\Environment;

Environment::load(__DIR__);
```


## Migrações
O Infinity Framework possui um sistema de migrações para gerenciar alterações no banco de dados de forma organizada e versionada.

Criar uma nova migração
Para criar uma nova migração, use o comando 'make:migration' seguido do nome da migração:

```bash
php infinity make:migration CreateUsersTable
```

Este comando criará um novo arquivo de migração na pasta 'app/Config/src/Migrations' com um timestamp único no nome do arquivo.

## Aplicar migrações
Para aplicar todas as migrações pendentes, use o comando migrate:

```bash
php infinity migrate
```

Este comando executará o método 'up' de todas as migrações que ainda não foram aplicadas.

## Reverter migrações
Para reverter a última migração aplicada, use o comando 'rollback':

```bash
php infinity rollback
```

Este comando executará o método 'down' da última migração aplicada, revertendo as alterações feitas no banco de dados.

Estrutura de Diretórios
A estrutura de diretórios do Infinity Framework é organizada da seguinte forma:

```bash
infinity-framework/
├── app/
│   ├── Cache/
│   ├── Config/
│   │   ├── src/
│   │   │   ├── Environment.php
│   │   │   ├── Database.php
│   │   │   └── Migrations/
│   │   │       └── {timestamp}_CreateUsersTable.php
│   │   └── Migration.php
│   ├── Controller/
│   │   ├── api/
│   │   │   └── api.php
│   │   ├── login/
│   │   │   └── Login.php
│   │   ├── modules/
│   │   │   └── Status.php
│   │   └── Pages/
│   │       └── Page.php
│   ├── Http/
│   │   ├── Middleware/
│   │   │   ├── Cache.php
│   │   │   ├── Empresa.php
│   │   │   ├── Maintenance.php
│   │   │   ├── ProUser.php
│   │   │   ├── Queue.php
│   │   │   ├── RequireUserLogin.php
│   │   │   └── RequireUserLogout.php
│   │   ├── Request.php
│   │   ├── Response.php
│   │   └── Router.php
│   ├── Model/
│   │   └── Entity/
│   ├── Session/
│   │   └── Usuarios/
│   │       └── Login.php
│   └── Utils/
│       ├── Cache/
│       │   └── File.php
│       ├── Translator.php
│       └── View.php
├── includes/
│   └── app.php
├── resources/
│   ├── view/
│   │   ├── assets/
│   │   └── pages/
│   └── translations/
│       ├── en/
│       ├── es/
│       └── pt-br/
├── routes/
│   ├── api/
│   │   └── v1/
│   │       └── default.php
│   ├── api.php
│   └── web.php
├── vendor/
├── infinity
├── .env
├── composer.json
└── README.md
```


## Uso de Rotas
O Infinity Framework inclui um sistema de rotas na pasta 'routes/web.php', operações básicas:

### GET

```bash
$obRouter->get('/Home', [
    'middlewares' => [
        'require-usuarios-logout',
        'cache'
    ],
    function () {
        return new Response(200, Pages\Home::getHome());
    }
]);
```


### POST

```bash
$obRouter->post('/Home', [
    'middlewares' => [
        'require-usuarios-logout',
        'cache'
    ],
    function ($request) {
        return new Response(200, Pages\Home::postHome($request));
    }
]);
```


### GET com parâmetros

```bash
$obRouter->get('/Home/{id}', [
    'middlewares' => [
        'require-usuarios-logout',
        'cache'
    ],
    function ($request, $id) {
        return new Response(200, Pages\Home::getHome($request, $id));
    }
]);
```


### Recuperção dos dados na Controller via get e post

```bash

  public static function getHome($request, $id)
  {
    return View::render('pages/Painel/Home', [
        'id' => $id,
    ]);
  }



  
  public static function postHome($request)
  {
    $postVars = $request->getPostVars();

    return View::render('pages/Painel/Home', [
        'conteudo' => $postVars['campos-enviado-via-post']
    ]);
  }

```


### Recuperção dos dados na View (html)

```bash

<p>id vindo da controller: {{id}}</p>

<p>conteudo vindo da controller: {{conteudo}}</p>

```


#### obs 
utilização de {{ }} na view é para renderizar conteudos da da controller, utilização de { } na view é para textos/traduções



## Uso do ORM
O Infinity Framework inclui um ORM básico para interagir com o banco de dados. Aqui está um exemplo de uso do ORM para realizar operações básicas:

### Inserir dados

```bash
use App\Config\src\Database;

$db = new Database();
$userId = $db->insert('users', [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => password_hash('secret', PASSWORD_DEFAULT)
]);
```


### Selecionar dados

```bash
use App\Config\src\Database;

$db = new Database();
$users = $db->select('users', 'id > 0', 'id DESC', 10);

foreach ($users as $user) {
    echo $user['name'];
}
```


### Deletar dados

```bash
use App\Config\src\Database;

$db = new Database();
$db->delete('users', 'id = 1');
```

#
# Contribuições
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests no GitHub.

### Licença
Este projeto está licenciado sob a licença MIT. Consulte o arquivo LICENSE para mais detalhes.


Este README fornece uma visão geral de como usar o Infinity Framework, incluindo como configurar o ambiente, criar e aplicar migrações, e utilizar o ORM básico fornecido pela framework. Sinta-se à vontade para ajustar e expandir este documento conforme necessário para atender às necessidades específicas do seu projeto.
