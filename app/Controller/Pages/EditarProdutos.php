<?php

namespace App\Controller\Pages;

use App\Controller\modules\status;
use App\Model\Entity\AdicionarProdutos as AdicionarProdutosEntity;
use App\Model\Entity\Produtos as ProdutosEntity;
use App\Model\Entity\Categories;

use App\Utils\View;

class EditarProdutos extends Page
{

    public static function getEditarProdutos($request, $id)
    {
        $produtos = new ProdutosEntity;
        $content = '';

        $results = ProdutosEntity::getProdutos('id_tenant = "' . $_SESSION['usuarios']['codEmpresa'] . '" AND id = "' . $id . '"');

        while ($produtos = $results->fetchObject(ProdutosEntity::class)) {
            $content = View::render('pages/Painel/EditarProdutos', [
                'id' => $id,
                'status' => '',
                'idTenant' => $_SESSION['usuarios']['codEmpresa'],
                'nome' => $produtos->name,
                'price' => number_format($produtos->price, 2, ',', '.'),
                'stock' => $produtos->stock,
                'descricao' => $produtos->description,
                'category_id' => $produtos->category_id,
                'variants' => json_encode(self::getVariantes($id)),
                'free' => $produtos->free == '1' ? "checked" : "",
                'comprimento' => $produtos->comprimento,
                'altura' => $produtos->altura,
                'largura' => $produtos->largura,
                'peso' => $produtos->peso,
                'exibir' => $produtos->exibir  == '1' ? "checked" : "",
                'selected1' => $produtos->destaque == 1 ? 'selected' : '',
                'selected2' => $produtos->destaque == 2 ? 'selected' : '',
                'selected3' => $produtos->destaque == 3 ? 'selected' : '',
                'files' => json_encode(self::getImagens($produtos->id)),
                'options' => self::getCategories($produtos->category_id)
            ]);
        }

        return self::getPage(NAME_APP, $content);
    }


    public static function getVariantes($id)
    {
        $obVariants = new ProdutosEntity;
        $Variants = [];
        $results = ProdutosEntity::getVariants('product_id = "' . $id . '"');

        while ($obVariants = $results->fetchObject(ProdutosEntity::class)) {
            $Variants[] = [
                'size' => $obVariants->size,
                'color' => $obVariants->color,
                'stock' => $obVariants->stock,
            ];
        }
        return $Variants;
    }


    public static function getImagens($id)
    {
        $obImagens = new ProdutosEntity;
        $Imagens = [];
        $results = ProdutosEntity::getImagensProdutos('product_id = "' . $id . '"');

        while ($obImagens = $results->fetchObject(ProdutosEntity::class)) {
            $Imagens[] = [
                'image_url' => URL.'/resources/view/assets/uploads/'.$_SESSION['usuarios']['codEmpresa'].'/'.$obImagens->image_url
            ];
        }
        return $Imagens;
    }


    public static function getCategories($id)
    {

        $obCategories = new Categories;
        $Categories = '';

        $results = Categories::getCategories('id_tenant = "' . $_SESSION['usuarios']['codEmpresa'] . '"');

        while ($obCategories = $results->fetchObject(Categories::class)) {
            $Categories .= View::render('pages/Categorias/PartCategorias', [
                'selected' => $obCategories->id == $id ? 'selected' : '',
                'nome' => $obCategories->name,
                'id' => $obCategories->id,
            ]);
        }
        return $Categories;
    }

    public static function postEditarProdutos($request)
    {
        $postVars = $request->getPostVars();

        $obDados = new ProdutosEntity();

        $obDados->id = $postVars['id'];
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

        if ($obDados->atualizar() == true) {
            $status = status::renderMensagem('Item atualizado com sucesso!', 'success');
        } else {
            $status = status::renderMensagem('Erro ao atualizar item!', 'danger');
        }

        $content = View::render('pages/Painel/EditarProdutos', [
            'status' => $status
        ]);
        return $request->getRouter()->redirect('/Produtos');
    }
}
