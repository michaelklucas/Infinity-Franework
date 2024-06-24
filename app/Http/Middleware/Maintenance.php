<?php
namespace App\Http\Middleware;

use mysql_xdevapi\Exception;

class Maintenance{
    public function handle($request, $next){
        if(getenv('MAINTENANCE') == 'true'){
            throw new \Exception("Pagina em Manutenção", 200);
        }
        return $next($request);
    }
}