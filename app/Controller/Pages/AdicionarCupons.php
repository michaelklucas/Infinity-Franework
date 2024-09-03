<?php

namespace App\Controller\Pages;

use App\Model\Entity\Usuarios;
use App\Utils\View;
use App\Config\src\Pagination;
use App\Controller\modules\status;
use App\Model\Entity\AdicionarCupons as EntityAdicionarCupons;

class AdicionarCupons extends Page
{
    public static function getAdicionarCupons($request)
    {
        $content = View::render('pages/Painel/Cupons', [
            'itens' => self::getCupons($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination),
            'status' => ''
        ]);
        return self::getPage(NAME_APP, $content);
    }

    public static function getCupons($request, &$obPagination)
    {

        $content = '';
        $codEmpresa = $_SESSION['usuarios']['codEmpresa'];

        $quantidadeTotal = Usuarios::getCupons('id_tenant = "' . $codEmpresa . '"', null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 10);


        $resultsFuncoes = Usuarios::getCupons('id_tenant = "' . $codEmpresa . '"', null, $obPagination->getLimit());
        while ($categorias = $resultsFuncoes->fetchObject()) {
            $content .= View::render('pages/Cupons/partCupons', [
                'status' => '',
                'id' => $categorias->id,
                'nome' => $categorias->name,
                'description' => $categorias->description,
                'criado' => $categorias->created_at,
                'total' => ''
            ]);
        }

        return $content;
    }


    public static function postAdicionarCupons($request)
    {
        $postVars = $request->getPostVars();


        $obCategorias = new EntityAdicionarCupons();

        if (isset($postVars['excluir'])) {
            $obCategorias->id = $postVars['id'];
            if ($obCategorias->apagar()) {
                $status = status::renderMensagem('Categoria apagada com sucesso!', 'success');
            } else {
                $status = status::renderMensagem('Erro ao apagar categoria', 'danger');
            }
        } else {

            $obCategorias->name = $postVars['nomeFuncao'];
            $obCategorias->description = $postVars['descricao'];
            $obCategorias->id_tenant = $_SESSION['usuarios']['codEmpresa'];

            if ($obCategorias->cadastrar()) {
                $status = status::renderMensagem('Categoria adiciona com sucesso!', 'success');
            } else {
                $status = status::renderMensagem('Erro ao adicioar nova categoria', 'danger');
            }
        }

        $content = View::render('pages/Painel/Categorias', [
            'itens' => self::getAdicionarCupons($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination),
            'status' => $status
        ]);

        return self::getPage(NAME_APP, $content);
    }
}
