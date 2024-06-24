<?php


use App\Controller\Pages;
use App\Http\Response;


$obRouter->get('/', [
    'middlewares' => [
        'require-usuarios-logout',
        'cache'
    ],
    function ($request) {
        return new Response(200, Pages\Home::getHome($request));
    }
]);
