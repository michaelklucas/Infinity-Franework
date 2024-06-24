<?php

namespace App\Utils;

class View {

    private static $vars = [];
    private static $translator;

    public static function init($vars = [], $translator = null) {
        self::$vars = $vars;
        self::$translator = $translator;
    }

    private static function getContentView($view) {
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        if (file_exists($file)) {
            return file_get_contents($file);
        } else {
            return '';
        }
    }

    private static function replaceVariables($content, $vars) {
        $keys = array_keys($vars);
        $keys = array_map(function($item) {
            return '{{'.$item.'}}';
        }, $keys);

        $replacedContent = str_replace($keys, array_values($vars), $content);
        return $replacedContent;
    }

    private static function replaceTranslations($content) {
        if (!self::$translator) {
            return $content;
        }

        $replacedContent = preg_replace_callback('/\{([^{}]+)\}/', function($matches) {
            $translation = self::$translator->translate($matches[1]);

            return $translation;
        }, $content);

        return $replacedContent;
    }

    public static function render($view, $vars = []) {
        $contentView = self::getContentView($view);
        $vars = array_merge(self::$vars, $vars);
        $contentView = self::replaceVariables($contentView, $vars);
        $contentView = self::replaceTranslations($contentView);

        return $contentView;
    }
}
