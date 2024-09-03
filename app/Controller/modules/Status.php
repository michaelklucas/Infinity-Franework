<?php

namespace App\Controller\modules;

use App\Controller\Pages\Page;
use App\Utils\View;


class status extends Page{

    public static function renderMensagem($Message, $cor)
    {
        $status = View::render('pages/Status/Status', [
            'message' => $Message,
            'cor' => $cor
        ]);
        return $status;
    }

}