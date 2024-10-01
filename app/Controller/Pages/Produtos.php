<?php

namespace App\Controller\Pages;

use App\Controller\modules\status;
use App\Model\Entity\Produtos as ProdutosEntity;
use App\Model\Entity\Categories;
use App\Config\src\Pagination;


use App\Utils\View;

class Produtos extends Page
{

    public static function getProdutos($request)
    {
        //adicionar produtos
        $obProdutos = new ProdutosEntity;
        $produtos = '';
    

        $quantidadeTotal = ProdutosEntity::getProdutos('id_tenant = "' . $_SESSION['usuarios']['codEmpresa'] . '"', null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 10);
        $results = ProdutosEntity::getProdutos('id_tenant = "' . $_SESSION['usuarios']['codEmpresa'] . '"', null, $obPagination->getLimit());


        while ($obProdutos = $results->fetchObject(ProdutosEntity::class)) {
            $produtos .= View::render('pages/Produtos/PartListaProdutos', [
                'nome' => $obProdutos->name,
                'id' => $obProdutos->id,
                'idTenant' => $_SESSION['usuarios']['codEmpresa'],
                'categoria' => self::getCategorias($obProdutos->category_id),
                'foto' => self::getImagens($obProdutos->id),
                'valor' => number_format($obProdutos->price, 2, ',', '.'),
                'quantidade' => $obProdutos->stock,
                'color' => $obProdutos->exibir == '1' ? 'success' : 'warning',
                'status' => $obProdutos->exibir == '1' ? 'Ativo' : 'Inativo',
            ]);
        }        
        
        $content = View::render('pages/Produtos/ListaProdutos', [
            'itens' => $produtos,
            'pagination' => parent::getPagination($request, $obPagination),
            'status' => ''
        ]);


        return self::getPage(NAME_APP, $content);
    }


    public static function getCategorias($id)
    {
        //adicionar produtos
        $obDados = new Categories;
        $categoria = '';
        
        $results = Categories::getCategories('id ='.$id);

        while ($obDados = $results->fetchObject(Categories::class)) {
            $categoria = $obDados->name;
        }        
        
        return $categoria;
    }

    public static function getImagens($id)
    {
        //adicionar produtos
        $obDados = new ProdutosEntity;
        $imagens = '';
        
        $results = ProdutosEntity::getImagensProdutos('product_id = "'.$id.'"');

        while ($obDados = $results->fetchObject(ProdutosEntity::class)) {
            $imagens = $obDados->image_url;
        }        
        
        return $imagens;
    }



    public static function postProdutos($request)
    {
        $postVars = $request->getPostVars();
        $obDados = new ProdutosEntity();

        if (isset($postVars['excluir'])) {
            $obDados->id = $postVars['id'];
            if ($obDados->apagar()) {
                $status = status::renderMensagem('Item apagado com sucesso!', 'success');
            } else {
                $status = status::renderMensagem('Erro ao apagar item', 'danger');
            }
        }

        return $request->getRouter()->redirect('/Produtos');

    }
}
