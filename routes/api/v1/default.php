<?php
use App\Http\Response;
use App\Controller\api;

//rota raiz
$obRouter->get('/api/v1',[
    function($request){
    return new Response(200, Api\api::getDetails($request), 'application/json');
    }
]);

$obRouter->post('/api/v1/users',[
    function($request){
    return new Response(200, Api\api::getUsers($request), 'application/json');
    }
]);