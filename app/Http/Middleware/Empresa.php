<?php

namespace App\Http\Middleware;

class Empresa{
    public function handle($request, $next){

        if ($_SESSION['usuarios']['empresa'] != '1') {
            $request->getRouter()->redirect('/');
        }
        return $next($request);

    }
}