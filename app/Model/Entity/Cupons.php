<?php

namespace App\Model\Entity;

use App\Config\src\Database;


class Cupons
{

    public $criado;
    public $id;
    public $id_tenant;
    public $delete;
    public $nome;
    public $valor;
    public $tipo;
    public $quantidade;
    public $vencimento;

    public function cadastrar()
    {

        $existe = (new Database('coupons'))->select('code = "' . $this->nome . '"')->fetchObject();

        if ($existe) {
            return '0';
        }

        $this->id = (new Database('coupons'))->insert([
            'code' => $this->nome,
            'discount_type' => $this->tipo,
            'discount_value' => $this->valor,
            'amount' => $this->quantidade,
            'expiration_date' => $this->vencimento,
            'id_tenant' => $this->id_tenant,
        ]);

        return $this->id ? '1' : '2';
    }

    public function apagar()
    {
        $this->delete = (new Database('coupons'))->delete('id = "' . $this->id . '"');

        return $this->delete ? true : false;
    }


    public static function getCupons($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('coupons'))->select($where, $order, $limit, $fields);
    }
}
