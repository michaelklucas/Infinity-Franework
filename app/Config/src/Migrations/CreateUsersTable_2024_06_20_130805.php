<?php

namespace App\Config\src\Migrations;

use App\Config\src\Migration;

class CreateUsersTable_2024_06_20_130805 extends Migration {
    public function up() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $this->db->execute($sql);
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS users";
        $this->db->execute($sql);
    }
}
