<?php

namespace App\Controller\Pages;

use App\Utils\View;

class NotFound extends Page{

    public static function getNotFound(){

        $content = View::render('pages/Painel/404', []);
        return self::getPage(NAME_APP, $content);
    }
}