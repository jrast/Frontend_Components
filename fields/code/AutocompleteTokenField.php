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
    private $callbackURL;
    
    public function __construct($callbackURL, $name = null) {
        $this->callbackURL = $callbackURL;
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
        Requirements::css('frontend_components/fields/css/token-input-facebook.css');
        $this->includeJQuery();        
        Requirements::javascript('frontend_components/fields/javascript/jquery.tokeninput.js');
        Requirements::customScript(<<<JS
                $(document).ready(function() {
                    $("#tokenInput_{$this->ID}").tokenInput("{$this->callbackURL}",
                        {
                            theme: "facebook",
                            hintText: "Gib einen Namen ein...",
                            noResultsText: "Kein Mitglied mit diesem Name gefunden!",
                            searchingText: "Bin am Suchen...",
                            preventDuplicates: true,
                            onAdd: function(item) {
                                alert("Added " + item.name + " ID:" + item.id);
                                },
                            onDelete: function(item) {
                                alert("Deleted " + item.name + " ID:" + item.id);
                                }
                        });
                });
JS
                , $this->ID);
    }
    
    public function forTemplate() {
        return '<input type="text" id="tokenInput_' . $this->ID . '"/>';
    }
}

?>
