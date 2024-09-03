<?php

namespace App\Model\Entity;

use App\Config\src\Database;


class Categories
{

    public $criado;
    public $id;
    public $description;
    public $name;
    public $id_tenant;
    public $delete;

    public function cadastrar()
    {

        $this->id = (new Database('categories'))->insert([
            'name' => $this->name,
            'description' => $this->description,
            'id_tenant' => $this->id_tenant,
        ]);

        if ($this->id) {
            return true;
        } else {
            return false;
        }
    }

    public function apagar()
    {
        $this->delete = (new Database('categories'))->delete('id = "' . $this->id . '"');

        if ($this->delete) {
            return true;
        } else {
            return false;
        }
    }


    public static function getCategories($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('categories'))->select($where, $order, $limit, $fields);
    }
}
