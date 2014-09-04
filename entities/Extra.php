<?php

class Extra {

    private static $idMap = array();
    private $id;
    private $naam;
    private $omschrijving;
    private $prijs;

    private function __construct($id, $naam, $omschrijving, $prijs) {
        $this->id = $id;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
    }

    public static function create($id, $naam, $omschrijving, $prijs) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Extra($id, $naam, $omschrijving, $prijs);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }

    public function getPrijs() {
        return $this->prijs;
    }

}
