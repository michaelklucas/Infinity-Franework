<?php

namespace App\Controller\Pages;

use DateTime;
use App\Utils\View;
use App\Config\src\Pagination;
use App\Controller\modules\status;
use App\Model\Entity\Cupons as EntityCupons;

class Cupons extends Page
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

        $quantidadeTotal = EntityCupons::getCupons('id_tenant = "' . $codEmpresa . '"', null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 10);


        $resultsFuncoes = EntityCupons::getCupons('id_tenant = "' . $codEmpresa . '"', null, $obPagination->getLimit());
        while ($Cupons = $resultsFuncoes->fetchObject()) {
            $content .= View::render('pages/Cupons/partCuponsTabela', [
                'status' => '',
                'id' => $Cupons->id,
                'code' => $Cupons->code,
                'discount_type' => $Cupons->discount_type == 'porcem' ? '%' : 'R$',
                'discount_value' => $Cupons->discount_value,
                'amount' => $Cupons->amount,
                'expiration_date' => date_format(new DateTime($Cupons->expiration_date), 'd-m-Y')
            ]);
        }

        return $content;
    }


    public static function postAdicionarCupons($request)
    {

        $postVars = $request->getPostVars();

        $obDados = new EntityCupons();


        if (isset($postVars['excluir'])) {
            $obDados->id = $postVars['id'];
            if ($obDados->apagar()) {
                $status = status::renderMensagem('Cupon apagado com sucesso!', 'success');
            } else {
                $status = status::renderMensagem('Erro ao apagar cupon', 'danger');
            }
        } else {

            $obDados->nome = $postVars['nomeCupon'];
            $obDados->valor = $postVars['valor'];
            $obDados->tipo = $postVars['tipo'];
            $obDados->quantidade = $postVars['quantidade'];
            $obDados->vencimento = $postVars['vencimento'];
            $obDados->id_tenant = $_SESSION['usuarios']['codEmpresa'];

            $retorno = $obDados->cadastrar();

            if ($retorno == '1') {
                $status = status::renderMensagem('Cadastro realizado com sucesso!', 'success');
            } elseif ($retorno == '2') {
                $status = status::renderMensagem('Erro ao cadastrar!', 'danger');
            } else {
                $status = status::renderMensagem('Esse nome de cupon já existe!', 'warning');
            }
        }

        $content = View::render('pages/Painel/Cupons', [
            'status' => $status,
            'itens' => self::getCupons($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);
        return self::getPage(NAME_APP, $content);
    }
}
