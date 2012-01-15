<?php

/**
 * Description of UILoader
 *
 * @author jrast
 */
abstract class UIElement extends ViewableData {
    private $jQuery = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';
    private $jQueryUI = 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js';

    abstract public function initialize();

    protected function includeJQuery() {
        Requirements::javascript($this->jQuery);
    }

    protected function includeJQueryUI() {
        $this->includeJQuery();
        Requirements::javascript($this->jQueryUI);
    }
}
?>
