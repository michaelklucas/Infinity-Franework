<?php

namespace App\Controller\Pages;
use App\Utils\View;

class Maintenance extends Page
{

    public static function getMaintenance()
    {
        $content = View::render('pages/Painel/Maintenance', []);
        return self::getPage(NAME_APP, $content);
    }
}