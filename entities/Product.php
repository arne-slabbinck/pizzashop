<?php

class Product {

    private static $idMap = array();
    private $id;
    private $naam;
    private $prijs;
    private $korting;
    private $omschrijving;
    private $imgpath;
    private $categorieid;

    private function __construct($id, $naam, $prijs, $korting, $omschrijving, $imgpath, $categorieid) {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
        $this->korting = $korting;
        $this->omschrijving = $omschrijving;
        $this->imgpath = $imgpath;
        $this->categorieid = $categorieid;
    }

    public static function create($id, $naam, $prijs, $korting, $omschrijving, $imgpath, $categorieid) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Product($id, $naam, $prijs, $korting, $omschrijving, $imgpath, $categorieid);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getPrijs() {
        return $this->prijs;
    }

    public function getKorting() {
        return $this->korting;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }

    public function getImgpath() {
        return $this->imgpath;
    }

    public function getCategorieid() {
        return $this->categorieid;
    }

    public function setNaam($naam) {
        $this->naam = $naam;
    }

    public function setPrijs($prijs) {
        $this->prijs = $prijs;
    }

    public function setKorting($korting) {
        $this->korting = $korting;
    }

    public function setOmschrijving($omschrijving) {
        $this->omschrijving = $omschrijving;
    }

    public function setImgpath($imgpath) {
        $this->imgpath = $imgpath;
    }

    public function setCategorieid($categorieid) {
        $this->categorieid = $categorieid;
    }

}
