<?php

class BestelregelExtra {

    private $bestelregelid;
    private $extraid;

    public function __construct($bestelregelid, $extraid) {
        $this->bestelregelid = $bestelregelid;
        $this->extraid = $extraid;
    }

    public function getBestelregelid() {
        return $this->bestelregelid;
    }

    public function getExtraid() {
        return $this->extraid;
    }

}
