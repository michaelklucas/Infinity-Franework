<?php

namespace App\Utils;

class Translator {
    private $language;
    private $translations = [];

    public function __construct($language = LANGUAGE) {
        $this->language = $language;
        $this->loadTranslations();
    }

    private function loadTranslations() {
        $filePath = __DIR__ . "/../../resources/translations/{$this->language}/messages.php";
        $this->translations = include $filePath;        
    }
    

    public function translate($key) {
        return $this->translations[$key] ?? $key;
    }

    public function setLanguage($language) {
        $this->language = $language;
        $this->loadTranslations();
    }

    public function getTranslations() {
        return $this->translations;
    }
}
