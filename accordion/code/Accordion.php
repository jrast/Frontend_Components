<?php

/**
 * Description of Accordion
 *
 * @author jrast
 */
class Accordion extends UIElement {

    private $items;
    private $item_template = 'Accordion_item';
    private $template = 'Accordion';
    private $ID;

    public function  __construct($items, $name = null, $template = null, $itemTemplate = null) {
        $this->initialize($name);
        if($template != null) {
            $this->setTemplate($template);
        }
        if($itemTemplate != null) {
            $this->setItemTemplate($itemTemplate);
        }
        $this->setItems($items);
    }

    public function  initialize($id = null) {
        if($id != null) {
            $this->ID = $id;
        } else {
            $this->ID = uniqid();
        }
        Requirements::css('frontend_components/accordion/css/accordion.css');
        $this->includeJQueryUI();
        Requirements::customScript(<<<JS
                	$(function() {
                            $( "#accordion_{$this->ID}" ).accordion({
                                active: false,
                                animated: false
                            });
                        });
JS
                ,$this->ID);
    }

    public function setItems($items) {
        $this->items = new DataObjectSet();
        foreach($items as $item) {
            $this->items->push(new Accordion_item($item,$this->item_template));
        }
    }

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function setItemTemplate($template) {
        $this->item_template = $template;
    }

    public function forTemplate() {
        $data = array(
            'ID'    => $this->ID
        );
        return $this->customise($data)->renderWith(array($this->template));
    }

    public function Items() {
        return $this->items;
    }
}

class Accordion_item extends ViewableData {
    private $data;
    private $template;

    public function __construct($item, $template) {
        $this->setData($item);
        $this->setTemplate($template);
    }

    public function setData($data) {
        $this->data = $data;
    }
    
    public function setTemplate($template) {
        $this->template = $template;
    }

    public function Item() {
        return $this->data->renderWith(array($this->template));
    }
}

?>
