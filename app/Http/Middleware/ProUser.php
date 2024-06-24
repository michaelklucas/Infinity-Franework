<?php

namespace App\Http\Middleware;

class ProUser{
    public function handle($request, $next){

        if ($_SESSION['usuarios']['pro'] == '0') {
            $request->getRouter()->redirect('/Pagamento');
        }
        return $next($request);

    }
}