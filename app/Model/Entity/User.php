<?php
namespace App\Model\Entity;
use App\Config\src\Database;

class User
{
    public $email;
    public $token;
    public $id;


    public function createTokenDb(){

        $this->id = (new Database('usuario'))->update('cod_empresa = "'.$_SESSION['usuarios']['codEmpresa'].'"',['token' => $this->token]);

        if(!empty($this->id)){
            return true;
        }else{
            return false;
        }
        
    }

    public static function getUserByEmail($email){
        return (new Database('usuario'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

    public static function getEmpresaByCode($cod){
        return (new Database('usuario'))->select('cod_empresa = "'.$cod.'"')->fetchObject(self::class);
    }

}