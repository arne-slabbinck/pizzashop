<?php

require_once("DBConfig.php");
require_once("entities/bestelling.php");
require_once("entities/bestelregel.php");
require_once("entities/winkelmanditem.php");
require_once("entities/status.php");
require_once("business/gebruikerservice.php");
require_once("business/productservice.php");
require_once("business/statusservice.php");
require_once("business/extraservice.php");
require_once("business/winkelmandservice.php");

class BestellingDAO {

    public static function create($gebruikersId, $statusId, $betaald, $totaal) {
        $sql = "insert into bestelling (gebruikersid, statusid, betaald, totaal) values "
                . "('" . $gebruikersId . "', '" . $statusId . "', '" . $betaald . "', '" . $totaal . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $bestellingId = $dbh->lastInsertId();
        $dbh = null;
        $bestelling = new Bestelling($bestellingId, $gebruikersId, $statusId, $betaald, $totaal);
        return $bestelling;
    }

    public static function createRegel($bestellingsid, $productid, $aantal, $subtotaal) {
        $sql = "insert into bestelregel (bestellingsid, productid, aantal, subtotaal) values "
                . "('" . $bestellingsid . "', '" . $productid . "', '" . $aantal . "', '" . $subtotaal . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $bestelregelId = $dbh->lastInsertId();
        $dbh = null;
        $bestelregel = new Bestelregel($bestelregelId, $bestellingsid, $productid, $aantal, $subtotaal);
        return $bestelregel;
    }

    public static function createRegelExtra($bestelregelId, $extraId) {
        $sql = "insert into bestelregelextra (bestelregelid, extraid) values "
                . "('" . $bestelregelId . "', '" . $extraId . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

    public static function getAll() {
        $lijst = array();
        $sql = "select id, gebruikersid, statusid, betaald, totaal from bestelling ";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        //$dbh->exec($sql);
        foreach ($resultSet as $rij) {
            $bestelling = new Bestelling($rij["id"], $rij["gebruikersid"], $rij["statusid"], $rij["betaald"], $rij["totaal"]);
            array_push($lijst, $bestelling);
        }
        $dbh = null;
        return $lijst;
    }

    public static function getAllOverzichten() {
        $overzichten = array();
        $gebruikers = array();

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, gebruikersid, statusid, betaald, totaal from bestelling ";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $bestelregels = array();

            $winkelmanditems = array();
            $gebruiker = GebruikerService::getGebruikerById($rij["gebruikersid"]);
            $sql2 = "select id, productid, aantal, subtotaal from bestelregel where bestellingsid = " . $rij["id"];
            $resultSet2 = $dbh->query($sql2);
            foreach ($resultSet2 as $rij2) {

                //toevoegen, in plaats van product ID, product object!!!

                $product = ProductService::haalProductOp($rij2["productid"]);

                $bestelregel = new Bestelregel($rij2["id"], $rij["id"], $product, $rij2["aantal"], $rij2["subtotaal"]);
                $extras = ExtraService::toonExtrasPerBestelregel($rij2["id"]);
                array_push($bestelregels, $bestelregel);


                $winkelmanditem = new WinkelmandItem($product, $rij2["aantal"], $extras, $rij2["id"], $rij2["subtotaal"]);
                array_push($winkelmanditems, $winkelmanditem);
            }

            $status = StatusService::haalStatusOp($rij["statusid"]);


            $overzicht = new Overzicht($gebruiker, $rij["id"], $status, $rij["betaald"], $rij["totaal"], $bestelregels, $winkelmanditems);
            array_push($overzichten, $overzicht);
        }

        return $overzichten;
    }

    public static function getByGebruiker($gebruikersid) {
        $overzichten = array();
        $gebruiker = GebruikerService::getGebruikerById($gebruikersid);
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, statusid, betaald, totaal from bestelling where gebruikersid = " . $gebruikersid;
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $bestelregels = array();
            $winkelmanditems = array();
            $sql2 = "select id, productid, aantal, subtotaal from bestelregel where bestellingsid = " . $rij["id"];
            $resultSet2 = $dbh->query($sql2);
            foreach ($resultSet2 as $rij2) {

                //toevoegen, in plaats van product ID, product object!!!

                $product = ProductService::haalProductOp($rij2["productid"]);

                $bestelregel = new Bestelregel($rij2["id"], $rij["id"], $product, $rij2["aantal"], $rij2["subtotaal"]);
                $extras = ExtraService::toonExtrasPerBestelregel($rij2["id"]);
                array_push($bestelregels, $bestelregel);


                $winkelmanditem = new WinkelmandItem($product, $rij2["aantal"], $extras, $rij2["id"], $rij2["subtotaal"]);
                array_push($winkelmanditems, $winkelmanditem);
            }
            $status = StatusService::haalStatusOp($rij["statusid"]);


            $overzicht = new Overzicht($gebruiker, $rij["id"], $status, $rij["betaald"], $rij["totaal"], $bestelregels, $winkelmanditems);
            array_push($overzichten, $overzicht);
        }

        return $overzichten;
    }

    public static function deleteBestelling($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        //bestellingen van tabel bestelling verwijderen
        $sql = "delete from bestelling where id = " . $id;
        $dbh->exec($sql);


        //bestelregel ID's opzoeken van de bestelling zodat de gekoppelde extra's verwijderd
        //kunnnen worden
        $sql = "select id from bestelregel where bestellingsid = " . $id;
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {

            //bestelregel extras verwijderen
            $sql2 = "delete from bestelregelextra where bestelregelid = " . $rij["id"];
            $dbh->exec($sql2);
        }

        $sql = "delete from bestelregel where bestellingsid = " . $id;
        $dbh->exec($sql);
        $dbh = null;
    }

    public static function leverBestelling($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
    }

    public static function changeStatusBestelling($id, $statusid) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "update bestelling set statusid = " . $statusid . " where id = " . $id;
        $dbh->exec($sql);
        $dbh = null;
    }

}
