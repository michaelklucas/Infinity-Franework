<?php

namespace App\Model\Entity;
use App\Config\src\Database;

class Modulos{

    public $id;
    public $icone;
    public $descricao;
    public $nomemodulo;
    public $status;
    public $adm;
    public $criado;

    public static function getModulos($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('modulos'))->select($where, $order, $limit, $fields);
    }

}
