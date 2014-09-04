<?php

class WinkelmandItem {

    private $id;
    private $product;
    private $aantal;
    private $extras;
    private $subtotaal;

    public function __construct($product, $aantal, $extras, $id, $subtotaal) {
        $this->product = $product;
        $this->aantal = $aantal;
        $this->extras = $extras;
        $this->id = $id;
        $this->subtotaal = $subtotaal;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getAantal() {
        return $this->aantal;
    }

    public function getExtras() {
        return $this->extras;
    }

    public function setAantal($aantal) {
        $this->aantal = $aantal;
    }

    public function getId() {
        return $this->id;
    }

    public function getSubtotaal() {
        return $this->subtotaal;
    }

    public function setSubtotaal($subtotaal) {
        $this->subtotaal = $subtotaal;
    }

}
