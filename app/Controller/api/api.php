<?php

namespace App\Controller\api;

class api
{
    public static function getDetails($request){
        return[
            'nome' => 'API - Infinity',
            'versao' => 'v1.0.0',
            'autor' => 'Tess Infinity',
            'email' =>  'contato@tessinfinity.com'
        ];
    }
}