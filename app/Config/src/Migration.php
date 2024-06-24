<?php

namespace App\Config\src;

abstract class Migration {

    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    abstract public function up();

    abstract public function down();
}
