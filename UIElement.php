<?php

/**
 * Description of UILoader
 *
 * @author jrast
 */
abstract class UIElement extends ViewableData {
    private static $jQuery = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';
    private static $jQueryUI = 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js';

    abstract public function initialize();

    static function includeJQuery() {
        Requirements::javascript(self::$jQuery);
    }

    static function includeJQueryUI() {
        self::includeJQuery();
        Requirements::javascript(self::$jQueryUI);
    }

    static function getJQuery() {
        return self::$jQuery;
    }

    static function getJQueryUI() {
        return self::$jQueryUI;
    }
}
?>
