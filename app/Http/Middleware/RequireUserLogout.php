<?php

namespace App\Http\Middleware;

use App\Session\Usuarios\Login as SessionLoginUsers;


class RequireUserLogout{
    public function handle($request, $next){

        if(SessionLoginUsers::isLogged()){

            $request->getRouter()->redirect('/');
        }
        return $next($request);

    }
}