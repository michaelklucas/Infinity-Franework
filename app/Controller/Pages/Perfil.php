<?php

namespace App\Controller\Pages;

use App\Controller\modules\status;
use App\Model\Entity\Usuarios;
use App\Utils\View;

class Perfil extends Page
{

    public static function getItens(){

        $obUsuario = new Usuarios;
        $itens = '';
        $results = Usuarios::getPerfil('id = "'.$_SESSION['usuarios']['id'].'"');
        while ($obUsuario = $results->fetchObject(Usuarios::class)) {
            $itens .= View::render('pages/Painel/PartPerfil', [
                'id' => $obUsuario->id,
                'name' => $obUsuario->nome,
                'email' => $obUsuario->email,
                'senha' => ''
            ]);
        }

        return $itens;
    }

    public static function getPerfil(){
            $content = View::render('pages/Painel/Perfil', [
                'dados' => self::getItens(),
                'status' => ''
            ]);

        return self::getPage(NAME_APP, $content);
    }


    public static function postPerfil($request){

        new status;
        
        $postVars = $request->getPostVars();

        $obUsuario = new Usuarios;
        $obUsuario->id = $postVars['id'];
        $obUsuario->email = $postVars['email'];
        $obUsuario->senha = $postVars['senha'];
        $obUsuario->nome = $postVars['nome'];
        

        if($obUsuario->atualizarPerfil() == true){
            $Message = "Dados Atualizados com Sucesso!<br>";
            $status = status::renderMensagem($Message, 'success');
        }else{
            $Message = "Os dados não podem estar vazios!<br>";
            $status = status::renderMensagem($Message, 'danger');
        }



        $content = View::render('pages/Painel/Perfil', [
            'dados' => self::getItens(),
            'status' => $status
        ]);

    return self::getPage(NAME_APP, $content);
    }



}