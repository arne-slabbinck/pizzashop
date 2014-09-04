<?php

require_once('data/GebruikerDAO.php');

class GebruikerService {

    public static function toonAlleGebruikers() {
        $gebruikersLijst = GebruikerDAO::getAllGebruikers();
        return $gebruikersLijst;
    }

    public static function voegNieuweGebruikerToe($voornaam, $naam, $adres, $postcode, $gemeente, $telefoonnummer, $emailadres, $gebruikersnaam, $hash) {
        $gebruiker = GebruikerDAO::create($voornaam, $naam, $adres, $postcode, $gemeente, $telefoonnummer, $emailadres, $gebruikersnaam, $hash);
        return $gebruiker;
    }

    public static function checkGebruiker($gebruikersnaam, $wachtwoord) {
        $gebruiker = GebruikerDAO::checkGebruiker($gebruikersnaam, $wachtwoord);
        return $gebruiker;
    }

    public static function getGebruikerById($id) {
        $gebruiker = GebruikerDAO::getById($id);
        return $gebruiker;
    }

    public static function updateGebruikerStatus($id, $status) {
        GebruikerDAO::changePassive($id, $status);
    }

}
