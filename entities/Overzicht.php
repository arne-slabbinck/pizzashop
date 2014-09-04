<?php

class Overzicht {

    private $gebruiker;
    private $bestellingsid;
    private $status;
    private $betaald;
    private $totaal;
    private $bestelregels;
    private $winkelmanditem;

    public function __construct($gebruiker, $bestellingsid, $status, $betaald, $totaal, $bestelregels, $winkelmanditem) {
        $this->gebruiker = $gebruiker;
        $this->bestellingsid = $bestellingsid;
        $this->status = $status;
        $this->betaald = $betaald;
        $this->totaal = $totaal;
        $this->bestelregels = $bestelregels;
        $this->winkelmanditem = $winkelmanditem;
    }

    public function getGebruiker() {
        return $this->gebruiker;
    }

    public function getBestellingsid() {
        return $this->bestellingsid;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getBetaald() {
        return $this->betaald;
    }

    public function getTotaal() {
        return $this->totaal;
    }

    public function getBestelregels() {
        return $this->bestelregels;
    }

    public function getWinkelmanditem() {
        return $this->winkelmanditem;
    }

}
