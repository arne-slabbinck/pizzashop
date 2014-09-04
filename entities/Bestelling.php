<?php

class Bestelling {

    private $id;
    private $gebruikersid;
    private $statusid;
    private $betaald;
    private $totaal;

    public function __construct($id, $gebruikersid, $statusid, $betaald, $totaal) {
        $this->id = $id;
        $this->gebruikersid = $gebruikersid;
        $this->statusid = $statusid;
        $this->betaald = $betaald;
        $this->totaal = $totaal;
    }

    public function getGebruikersid() {
        return $this->gebruikersid;
    }

    public function getStatusid() {
        return $this->statusid;
    }

    public function getBetaald() {
        return $this->betaald;
    }

    public function getTotaal() {
        return $this->totaal;
    }

    public function getId() {
        return $this->id;
    }

}
