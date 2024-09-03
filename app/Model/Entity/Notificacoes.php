<?php

namespace App\Model\Entity;
use App\Config\src\Database;

class Notificacoes{

    public $id;
    public $mensagem;
    public $titulo;
    public $id_usuario;
    public $id_aprovacao;
    public $rota;
    public $global;
    public $visualizado;
    public $criado;
    public $Total;

    public static function getNotificacoes($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('notificacoes'))->select($where, $order, $limit, $fields);
    }


    public static function getDadosNotificacoes($table1, $table2, $on, $where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database(''))->selectInnerJoin($table1, $table2, $on, $where, $order, $limit, $fields);
    }

}
