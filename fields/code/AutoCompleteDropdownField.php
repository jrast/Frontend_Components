<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoCompleteDropdownField
 *
 * @author jrast
 */
class AutoCompleteDropdownField extends DropdownField {

    public function __construct($name, $title = null, $source = array(), $value = "", $form = null, $emptyString = null) {
        parent::__construct($name, $title, $source, $value, $form, $emptyString);
        //Requirements::javascript(UIElement::getJQuery());
        //Requirements::javascript(UIElement::getJQueryUI());
        //Requirements::javascript('frontend_components/fields/javascript/AutoCompleteDropdownField.js');
    }
}
?>
