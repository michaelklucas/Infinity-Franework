<?php

namespace App\Config\src\Migrations;

use App\Config\src\Migration;

class CreateProducts_2024_06_20_133935 extends Migration {
    public function up() {
        $sql = "CREATE TABLE products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $this->db->execute($sql);
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS products";
        $this->db->execute($sql);
    }
}