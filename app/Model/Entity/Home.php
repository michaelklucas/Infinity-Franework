<?php

namespace App\Model\Entity;

use App\Config\src\Database;
use DateTime;
use DateInterval;
use DatePeriod;

class Home
{
    public $Ferias;
    public $criado;
    public $Total;
    public $Usuarios;
    

    public function __construct() {
        $this->Total = 0;
        $this->Ferias = 0;
        $this->Usuarios = '';
    }
    public function DadosUser()
    {
        return [
            'diasTrabalhados' => '1',
            'diasFaltasAteAtual' => '1',
        ];
    }


    public function DadosAdm(){

        return [
            'online' => '1',
            'faltas' => '1',
            'ferias' => '1'
        ];
    }

    public static function getFerias($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('associarusuarios'))->select($where, $order, $limit, $fields);
    }
}
