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
    private $queryURL;
    private $prePopulate;
    private $object;
    
    
    /**
     * Erstellt ein neues AutocompleteTokenField
     * @param Object $object normalerweise $this
     * @param type $queryURL URl welche aufgerufen wird um die Elemente vorzuschlagen
     * @param type $prePopulate  array(array(id => 1, name => foo), array(id => 2, name => bar))
     */
    public function __construct(Object $object, $queryURL, $prePopulate = null) {
        $this->object = $object;
        if($object->ID != null) {
            $this->ID = $object->ID;
        } else {
            $this->ID = uniqid();
        }
        
        $this->queryURL = $queryURL;
        
        if(is_array($prePopulate)) {
            $this->prePopulate = Convert::array2json($prePopulate);
        } else {
            $this->prePopulate = null;
        }
        
        $this->initialize();
        parent::__construct();
    }
    
    public function initialize() {
        Requirements::css('frontend_components/fields/css/token-input.css');
        //Requirements::css('frontend_components/fields/css/token-input-facebook.css');
        $this->includeJQuery();
        Requirements::javascript('frontend_components/fields/javascript/jquery.tokeninput.js');
        Requirements::customScript(<<<JS
                $(document).ready(function() {
                    $("#tokenInput_{$this->ID}").tokenInput("{$this->queryURL}",
                        {
                            hintText: "Gib einen Namen ein...",
                            noResultsText: "Kein Mitglied mit diesem Name gefunden!",
                            searchingText: "Bin am Suchen...",
                            preventDuplicates: true,
                            prePopulate: {$this->prePopulate},
                            onAdd: function(item) {
                                    $.ajax("tour/anmeldenVerwaltung/{$this->object->ID}/" + item.id,
                                    {
                                        statusCode: 
                                        {
                                            404: function() {
                                                alert("Es ist ein Fehler aufgetreten, Element konnte nicht richtig hinzugefügt werden!");
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
                                                alert("Es ist ein Fehler aufgetreten, Element konnte nicht richtig entfernt werden!");
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
