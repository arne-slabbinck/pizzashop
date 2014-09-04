<?php

require_once("DBConfig.php");
require_once("entities/extra.php");

class ExtraDAO {

    public static function getAllExtras() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, naam, omschrijving, prijs from extra";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $extra = Extra::create($rij["id"], $rij["naam"], $rij["omschrijving"], $rij["prijs"]);
            array_push($lijst, $extra);
        }
        $dbh = null;
        return $lijst;
    }

    public static function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select naam, omschrijving, prijs from extra where id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $extra = Extra::create($id, $rij["naam"], $rij["omschrijving"], $rij["prijs"]);
        $dbh = null;
        return $extra;
    }

    public static function getByBestelregel($id) {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select extra.id, extra.naam, extra.omschrijving, extra.prijs from extra
                inner join bestelregelextra on bestelregelextra.extraid = extra.id
                where bestelregelextra.bestelregelid = " . $id;
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $extra = Extra::create($rij["id"], $rij["naam"], $rij["omschrijving"], $rij["prijs"]);
            array_push($lijst, $extra);
        }
        $dbh = null;
        return $lijst;
    }

}
