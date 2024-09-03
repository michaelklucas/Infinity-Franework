<?php

namespace App\Controller\Pages;

use App\Model\Entity\Home as EntityHome;
use App\Utils\View;

class Home extends Page
{

    public static function getHome($request)
    {
        $content = View::render('pages/Painel/Home', [
            'dados' => self::getDados($request)
        ]);
        return self::getPage(NAME_APP, $content);
    }

    public static function getDados($request)
    {

        $obDados = new EntityHome;
        $dados = $obDados->DadosUser();
        $dadosAdm = $obDados->DadosAdm();

        if (empty($_SESSION['usuarios']['empresa'])) {
            $content = View::render('pages/Home/DadosUser', [
                'faltas' => $dados['diasFaltasAteAtual'],
                'diasTrabalhados' => $dados['diasTrabalhados'],
            ]);
        } else {

            $content = View::render('pages/Home/Dados', [
                'online' => $dadosAdm['online'],
                'faltas' => $dadosAdm['faltas'],
                'ferias' => $dadosAdm['ferias']
            ]);
        }

        return $content;
    }




    public static function postHome($request)
    {
        $postVars = $request->getPostVars();

        echo '<pre>';
        print_r($postVars);
        echo '</pre>';
        exit;
        
        return true;
    }
}
