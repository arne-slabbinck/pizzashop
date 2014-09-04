<?php

class Gebruiker {

    private static $idMap = array();
    private $id;
    private $beheerder;
    private $passief;
    private $gebruikersnaam;
    private $wachtwoord;
    private $naam;
    private $voornaam;
    private $telefoonnummer;
    private $emailadres;
    private $adres;
    private $postcode;
    private $gemeente;

    private function __construct($id, $beheerder, $passief, $gebruikersnaam, $wachtwoord, $naam, $voornaam, $telefoonnummer, $emailadres, $adres, $postcode, $gemeente) {
        $this->id = $id;
        $this->beheerder = $beheerder;
        $this->passief = $passief;
        $this->gebruikersnaam = $gebruikersnaam;
        $this->wachtwoord = $wachtwoord;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->telefoonnummer = $telefoonnummer;
        $this->emailadres = $emailadres;
        $this->adres = $adres;
        $this->postcode = $postcode;
        $this->gemeente = $gemeente;
    }

    public static function create($id, $beheerder, $passief, $gebruikersnaam, $wachtwoord, $naam, $voornaam, $telefoonnummer, $emailadres, $adres, $postcode, $gemeente) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Gebruiker($id, $beheerder, $passief, $gebruikersnaam, $wachtwoord, $naam, $voornaam, $telefoonnummer, $emailadres, $adres, $postcode, $gemeente);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getBeheerder() {
        return $this->beheerder;
    }

    public function getPassief() {
        return $this->passief;
    }

    public function getGebruikersnaam() {
        return $this->gebruikersnaam;
    }

    public function getWachtwoord() {
        return $this->wachtwoord;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getVoornaam() {
        return $this->voornaam;
    }

    public function getTelefoonnummer() {
        return $this->telefoonnummer;
    }

    public function getEmailadres() {
        return $this->emailadres;
    }

    public function getAdres() {
        return $this->adres;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function getGemeente() {
        return $this->gemeente;
    }

}
