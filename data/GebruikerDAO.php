<?php

require_once("DBConfig.php");
require_once("entities/gebruiker.php");

class GebruikerDAO {

    public static function getAllGebruikers() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, beheerder, passief, gebruikersnaam, wachtwoord, naam, voornaam, telefoonnummer, "
                . "emailadres, adres, postcode, gemeente from gebruiker";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $gebruiker = Gebruiker::create($rij["id"], $rij["beheerder"], $rij["passief"], $rij["gebruikersnaam"], $rij["wachtwoord"], $rij["naam"], $rij["voornaam"], $rij["telefoonnummer"], $rij["emailadres"], $rij["adres"], $rij["postcode"], $rij["gemeente"]);
            array_push($lijst, $gebruiker);
        }
        $dbh = null;
        return $lijst;
    }

    public static function create($voornaam, $naam, $adres, $postcode, $gemeente, $telefoonnummer, $emailadres, $gebruikersnaam, $hash) {
        $sql = "insert into gebruiker (gebruikersnaam, wachtwoord, naam, voornaam, telefoonnummer, emailadres, adres, postcode, gemeente)"
                . " values ('" . $gebruikersnaam . "', '" . $hash . "', '" . $naam . "', '" . $voornaam . "', '" . $telefoonnummer . "', '" . $emailadres . "', '" . $adres . "', '" . $postcode . "', '" . $gemeente . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $gebruikersId = $dbh->lastInsertId();
        $dbh = null;
        $gebruiker = Gebruiker::create($gebruikersId, 0, 0, $gebruikersnaam, $hash, $naam, $voornaam, $telefoonnummer, $emailadres, $adres, $postcode, $gemeente);
        return $gebruiker;
    }

    public static function checkGebruiker($gebruikersnaam, $wachtwoord) {

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, beheerder, passief, wachtwoord, naam, voornaam, telefoonnummer, emailadres, adres, postcode, gemeente"
                . " from gebruiker where gebruikersnaam = '" . $gebruikersnaam . "'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        if (!$rij) {
            return false;
        } else {
            if (crypt($wachtwoord, $rij["wachtwoord"]) == $rij["wachtwoord"]) {
                $gebruiker = Gebruiker::create($rij["id"], $rij["beheerder"], $rij["passief"], $gebruikersnaam, $rij["wachtwoord"], $rij["naam"], $rij["voornaam"], $rij["telefoonnummer"], $rij["emailadres"], $rij["adres"], $rij["postcode"], $rij["gemeente"]);

                return $gebruiker;
            } else {
                return false;
            }
        }
        $dbh = null;
    }

    public static function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select beheerder, passief, gebruikersnaam, wachtwoord, naam, voornaam, telefoonnummer, emailadres, adres, postcode, gemeente "
                . "from gebruiker where id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $gebruiker = Gebruiker::create($id, $rij["beheerder"], $rij["passief"], $rij["gebruikersnaam"], $rij["wachtwoord"], $rij["naam"], $rij["voornaam"], $rij["telefoonnummer"], $rij["emailadres"], $rij["adres"], $rij["postcode"], $rij["gemeente"]);
        $dbh = null;
        return $gebruiker;
    }

    public static function changePassive($id, $stat) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "update gebruiker set passief = " . $stat . " where id = " . $id;
        $dbh->exec($sql);
        $dbh = null;
    }

}
