<?php

namespace App\Controller\Pages;

use App\Config\iugu\lib\Iugu;
use App\Utils\View;


class Pagamento extends Page
{

    public static function getPagamento($request)
    {
        $content = View::render('pages/Painel/Pagamento', []);

        return self::getPage(NAME_APP, $content);
    }

    public static function getPagementoby($request)
    {

        // Defina suas chaves de API da Iugu
        Iugu::setApiKey('SUA_CHAVE_DE_API');

        // Dados do pagamento
        $valorTotal = 100.00; // Valor total da compra
        $descricao = 'Exemplo de pagamento'; // Descrição do produto ou serviço

        // Dados do cartão de crédito ou débito
        $numeroCartao = '0000000000000000'; // Número do cartão
        $nomeTitular = 'FULANO DE TAL'; // Nome do titular do cartão
        $vencimentoCartao = '12/2023'; // Data de vencimento no formato MM/AAAA
        $codigoSeguranca = '123'; // Código de segurança (CVV)
        $parcelas = 12; // Número de parcelas (1 a 12)

        // Crie uma nova fatura na Iugu
        $fatura = Iugu_Invoice::create([
            'email' => 'email@exemplo.com',
            'due_date' => date('Y-m-d'),
            'items' => [
                ['description' => $descricao, 'quantity' => 1, 'price_cents' => $valorTotal * 100],
            ],
        ]);

        // Crie um token para o cartão de crédito ou débito
        $token = Iugu_PaymentToken::create([
            'account_id' => $fatura->customer_id,
            'method' => 'credit_card',
            'test' => true, // Defina como false em ambiente de produção
            'data' => [
                'number' => $numeroCartao,
                'verification_value' => $codigoSeguranca,
                'first_name' => $nomeTitular,
                'last_name' => '',
                'month' => substr($vencimentoCartao, 0, 2),
                'year' => substr($vencimentoCartao, -4),
            ],
        ]);

        // Realize o pagamento da fatura usando o token
        $pagamento = Iugu_Charge::create([
            'token' => $token->id,
            'email' => 'email@exemplo.com',
            'months' => $parcelas,
            'items' => [
                ['description' => $descricao, 'quantity' => 1, 'price_cents' => $valorTotal * 100],
            ],
        ]);

        // Verifique o status do pagamento e salve no banco de dados
        if ($pagamento->success) {
            // Pagamento bem-sucedido, salve no banco de dados com status "pago"
            // Insira o código para salvar os dados no banco de dados aqui
            $statusPagamento = 'pago';
        } else {
            // Pagamento com erro, salve no banco de dados com status "erro"
            // Insira o código para salvar os dados no banco de dados aqui
            $statusPagamento = 'erro';
        }

        echo 'Status do pagamento: ' . $statusPagamento;


    }


}