<?php

namespace App\Config\src\Migrations;

use App\Config\src\Migration;

class CreateUsersTable_2024_06_20_130805 extends Migration {
    public function up() {
        $sql = "CREATE TABLE IF NOT EXISTS usuario (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL UNIQUE,
            senha VARCHAR(255) DEFAULT NULL,
            cod_user VARCHAR(255) DEFAULT NULL,
            avatar VARCHAR(255) NOT NULL,
            pro INT(11) DEFAULT NULL,
            deletado INT(1) DEFAULT 0 COMMENT '0 = ativo, 1 = deletado',
            dataNascimento DATE DEFAULT NULL,
            genero VARCHAR(255) DEFAULT NULL,
            estadoCivil VARCHAR(255) DEFAULT NULL,
            endereco VARCHAR(255) DEFAULT NULL,
            telefone VARCHAR(255) DEFAULT NULL,
            cpf VARCHAR(255) DEFAULT NULL,
            token VARCHAR(255) DEFAULT NULL,
            modificado DATE DEFAULT NULL,
            criado TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        $this->db->execute($sql);
    }
    
    public function down() {
        $sql = "DROP TABLE IF EXISTS users";
        $this->db->execute($sql);
    }
}
