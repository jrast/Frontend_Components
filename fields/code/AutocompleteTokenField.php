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
    private $object;
    
    public function __construct(Object $object, $callbackURL) {
        $this->object = $object;
        $this->callbackURL = $callbackURL;
        $this->initialize($this->object->ID);
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
                            hintText: "Gib einen Namen ein...",
                            noResultsText: "Kein Mitglied mit diesem Name gefunden!",
                            searchingText: "Bin am Suchen...",
                            preventDuplicates: true,
                            prePopulate: {$this->object->TeilnehmerJSON()},
                            onAdd: function(item) {
                                    $.ajax("tour/anmeldenVerwaltung/{$this->object->ID}/" + item.id,
                                    {
                                        statusCode: 
                                        {
                                            404: function() {
                                                alert("Mitglied kann nicht angemeldet werden, es ist ein Fehler aufgetreten");
                                            }
                                        }
                                    });
                                },
                            onDelete: function(item) {
                                    $.ajax("tour/abmeldenVerwaltung/{$this->object->ID}/" + item.id,
                                    {
                                        statusCode: 
                                        {
                                            404: function() {
                                                alert("Mitglied kann nicht abgemeldet werden, es ist ein Fehler aufgetreten");
                                            }
                                        }                                    
                                    });
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
