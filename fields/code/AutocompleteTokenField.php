<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutocompleteTokenField
 *
 * @author jrast
 */
class AutocompleteTokenField extends UIElement {
    private $ID = null;
    
    public function __construct($name = null) {
        $this->initialize($name);
        parent::__construct();
    }
    
    public function initialize($id = null) {
        if($id != null) {
            $this->ID = $id;
        } else {
            $this->ID = uniqid();
        }
        Requirements::css('frontend_components/fields/css/token-input.css');
        $this->includeJQuery();        
        Requirements::javascript('frontend_components/fields/javascript/jquery.tokeninput.js');
        Requirements::customScript(<<<JS
                $(document).ready(function() {
                    $("#tokenInput_{$this->ID}").tokenInput();
                });
JS
                , $this->ID);
    }
    
    public function forTemplate() {
        return '<input type="text" id="tokenInput_' . $this->ID . '"/>';
    }
}

?>
