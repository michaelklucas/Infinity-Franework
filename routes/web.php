<?php

use App\Controller\Login;
use App\Controller\Pages;
use App\Http\Response;


$obRouter->get('/', [
    'middlewares' => [
        'require-usuarios-logout'
    ],
    function ($request) {
        return new Response(200, Login\Login::getLogin($request));
    }
]);

$obRouter->post('/', [
    'middlewares' => [
        'require-usuarios-logout'
    ],
    function ($request) {
        return new Response(200, Login\Login::setLogin($request));
    }
]);



$obRouter->get('/logout', [
    'middlewares' => [
        'require-usuarios-login'
    ],
    function ($request) {
        return new Response(200, Login\Login::setLogout($request));
    }
]);


$obRouter->get('/Home', [
    'middlewares' => [
        'require-usuarios-login',
        'cache'
    ],
    function ($request) {
        return new Response(200, Pages\Home::getHome($request));
    }
]);

$obRouter->post('/Home', [
    'middlewares' => [
        'require-usuarios-login'
    ],
    function ($request) {
        return new Response(200, Pages\Home::postHome($request));
    }
]);



$obRouter->get('/Perfil', [
    'middlewares' => [
        'require-usuarios-login'
    ],
    function () {
        return new Response(200, Pages\Perfil::getPerfil());
    }
]);

$obRouter->post('/Perfil', [
    'middlewares' => [
        'require-usuarios-login'
    ],
    function ($request) {
        return new Response(200, Pages\Perfil::postPerfil($request));
    }
]);

$obRouter->get('/404', [
    'middlewares' => [
        'require-usuarios-login'
    ],
    function ($request) {
        return new Response(200, Pages\NotFound::getNotFound($request));
    }
]);

$obRouter->get('/Pagamento', [
    'middlewares' => [
        'require-usuarios-login',
        'empresa'
    ],
    function ($request) {
        return new Response(200, Pages\Pagamento::getPagamento($request));
    }
]);


$obRouter->get('/AdicionarProdutos', [
    'middlewares' => [
        'require-usuarios-login',
        'empresa'
    ],
    function ($request) {
        return new Response(200, Pages\AdicionarProdutos::getAdicionarProdutos($request));
    }
]);

$obRouter->post('/AdicionarProdutos', [
    'middlewares' => [
        'require-usuarios-login',
        'empresa'
    ],
    function ($request) {
        return new Response(200, Pages\AdicionarProdutos::postAdicionarProdutos($request));
    }
]);


$obRouter->get('/AdicionarCategorias', [
    'middlewares' => [
        'require-usuarios-login',
        'empresa'
    ],
    function ($request) {
        return new Response(200, Pages\Categorias::getAdicionarCategorias($request));
    }
]);

$obRouter->post('/AdicionarCategorias', [
    'middlewares' => [
        'require-usuarios-login',
        'empresa'
    ],
    function ($request) {
        return new Response(200, Pages\Categorias::postAdicionarCategorias($request));
    }
]);






$obRouter->get('/AdicionarCupons', [
    'middlewares' => [
        'require-usuarios-login',
        'empresa'
    ],
    function ($request) {
        return new Response(200, Pages\Categorias::getAdicionarCupons($request));
    }
]);

$obRouter->post('/AdicionarCupons', [
    'middlewares' => [
        'require-usuarios-login',
        'empresa'
    ],
    function ($request) {
        return new Response(200, Pages\Categorias::postAdicionarCupons($request));
    }
]);





