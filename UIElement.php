<?php

/**
 * Description of UILoader
 *
 * @author jrast
 */
abstract class UIElement extends ViewableData {
    public static $jQuery = 'framework/thirdparty/jquery/jquery.min.js';
    public static $jQueryUI = 'framework/thirdparty/jquery-ui/jquery-ui.min.js';

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
