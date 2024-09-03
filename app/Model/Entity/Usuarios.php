<?php

namespace App\Model\Entity;

use App\Config\src\Database;

class Usuarios
{
    public $cod_empresa;
    public $cod_user;
    public $funcao;
    public $ferias;
    public $deletado;
    public $criado;
    public $nome;
    public $email;
    public $senha;
    public $id;

    // Adicione valores padrão no construtor
    public function __construct($cod_empresa = null, $cod_user = null, $funcao = null, $ferias = null, $deletado = null, $criado = null) {
        $this->cod_empresa = $cod_empresa;
        $this->cod_user = $cod_user;
        $this->funcao = $funcao;
        $this->ferias = $ferias;
        $this->deletado = $deletado;
        $this->criado = $criado;
    }

    public function atualizarPerfil()
    {

        $modificado = date("Y-m-d");;

        if (empty($this->nome && $this->email)) {
            return false;
        }

        if (!empty($this->senha)) {
            $senha = password_hash($this->senha, PASSWORD_DEFAULT);
            self::updateUser('senha', $senha, $this->id, $modificado);
        }

        if (!empty($this->nome)) {
            $nome = $this->nome;
            self::updateUser('nome', $nome, $this->id, $modificado);
        }

        if (!empty($this->email)) {
            $email = $this->email;
            self::updateUser('email', $email, $this->id, $modificado);
        }
        

        return true;
    }


    public static function updateUser($campo, $valor, $id, $modificado)
    {
        (new Database('usuario'))->update('id = "' . $id . '"', [
            $campo => $valor,
            'modificado' => $modificado
        ]);
    }

    public static function getPerfil($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('usuario'))->select($where, $order, $limit, $fields);
    }

    public static function getPerfilAssociar($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('associarusuarios'))->select($where, $order, $limit, $fields);
    }

    public static function getQuantidade($table1, $table2, $on, $where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database(''))->selectInnerJoin($table1, $table2, $on, $where, $order, $limit, $fields);
    }


    public static function getCategories($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('categories'))->select($where, $order, $limit, $fields);
    }
}
