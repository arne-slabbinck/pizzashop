<?php

class Gemeente {

    
    private $postcode;
    private $gemeente;

    public function __construct($postcode, $gemeente) {
        $this->postcode = $postcode;
        $this->gemeente = $gemeente;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function getGemeente() {
        return $this->gemeente;
    }

}
