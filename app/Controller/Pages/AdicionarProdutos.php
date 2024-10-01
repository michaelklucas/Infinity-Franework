<?php

namespace App\Controller\Pages;

use App\Controller\modules\status;
use App\Model\Entity\Home as EntityHome;
use App\Model\Entity\AdicionarProdutos as AdicionarProdutosEntity;
use App\Model\Entity\Categories;

use App\Utils\View;

class AdicionarProdutos extends Page
{

    public static function getAdicionarProdutos($request)
    {
        $content = View::render('pages/Painel/Produtos', [
            'status' => '',
            'options' => self::getCategories()
        ]);
        return self::getPage(NAME_APP, $content);
    }

    public static function getCategories()
    {

        $obCategories = new Categories;
        $Categories = '';

        $results = Categories::getCategories('id_tenant = "' . $_SESSION['usuarios']['codEmpresa'] . '"');

        while ($obCategories = $results->fetchObject(Categories::class)) {
            $Categories .= View::render('pages/Categorias/PartCategorias', [
                'nome' => $obCategories->name,
                'id' => $obCategories->id,
            ]);
        }
        return $Categories;
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
        $obDados->free = isset($postVars['free']) ? 1 : 0;
        $obDados->comprimento = isset($postVars['comprimento']) ? $postVars['comprimento'] : '';
        $obDados->altura = isset($postVars['altura']) ? $postVars['altura'] : '';
        $obDados->largura = isset($postVars['largura']) ? $postVars['largura'] : '';
        $obDados->peso = isset($postVars['peso']) ? $postVars['peso'] : '';
        $obDados->exibir = isset($postVars['exibir']) ? 1 : 0;
        $obDados->destaque = isset($postVars['destaque']) ? 1 : 0;
        $obDados->files = $postVars['files'];

        if ($obDados->cadastrar() == true) {
            $status = status::renderMensagem('Cadastro realizado com sucesso!', 'success');
        } else {
            $status = status::renderMensagem('Erro ao cadastrar!', 'danger');
        }

        $content = View::render('pages/Painel/Produtos', [
            'status' => $status
        ]);
        return self::getPage(NAME_APP, $content);
    }
}
