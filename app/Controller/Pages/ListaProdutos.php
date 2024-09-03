<?php

namespace App\Controller\Pages;

use App\Controller\modules\status;
use App\Model\Entity\Home as EntityHome;
use App\Model\Entity\AdicionarProdutos as AdicionarProdutosEntity;

use App\Utils\View;

class AdicionarProdutos extends Page
{

    public static function getAdicionarProdutos($request)
    {
        $content = View::render('pages/Painel/AdicionarProdutos', [
            'status' => ''
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




    public static function postAdicionarProdutos($request)
    {
        $postVars = $request->getPostVars();
        
        $obDados = new AdicionarProdutosEntity();

        $obDados->nome = $postVars['nome'];
        $obDados->price = $postVars['price'];
        $obDados->stock = $postVars['stock'];
        $obDados->descricao = $postVars['descricao'];
        $obDados->category_id = $postVars['category_id'];
        $obDados->variants = $postVars['variants'];
        $obDados->exibir = isset($postVars['exibir']) ? 1 : 0;
        $obDados->destaque = isset($postVars['destaque']) ? 1: 0;
        $obDados->files = $postVars['files'];

    if ($obDados->cadastrar() == true) {
        $status = status::renderMensagem('Cadastro realizado com sucesso!', 'success');
    } else {
        $status = status::renderMensagem('Erro ao cadastrar!', 'danger');
    }

        $content = View::render('pages/Painel/AdicionarProdutos', [
            'status' => $status
        ]);
        return self::getPage(NAME_APP, $content);

    }
}
