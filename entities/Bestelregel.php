<?php

class Bestelregel {

    private $id;
    private $bestellingsid;
    private $productid;
    private $aantal;
    private $subtotaal;

    public function __construct($id, $bestellingsid, $productid, $aantal, $subtotaal) {
        $this->id = $id;
        $this->bestellingsid = $bestellingsid;
        $this->productid = $productid;
        $this->aantal = $aantal;
        $this->subtotaal = $subtotaal;
    }

    public function getId() {
        return $this->id;
    }

    public function getBestellingsid() {
        return $this->bestellingsid;
    }

    public function getProductid() {
        return $this->productid;
    }

    public function getAantal() {
        return $this->aantal;
    }

    public function getSubtotaal() {
        return $this->subtotaal;
    }

}
