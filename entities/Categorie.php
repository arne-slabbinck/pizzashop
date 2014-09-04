<?php

class Categorie {

    private static $idMap = array();
    private $id;
    private $omschrijving;
    private $extraMogelijk;

    private function __construct($id, $omschrijving, $extraMogelijk) {
        $this->id = $id;
        $this->omschrijving = $omschrijving;
        $this->extraMogelijk = $extraMogelijk;
    }

    public static function create($id, $omschrijving, $extraMogelijk) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Categorie($id, $omschrijving, $extraMogelijk);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }

    public function getPrijs() {
        return $this->prijs;
    }

}
