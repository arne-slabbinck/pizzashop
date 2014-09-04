<?php

require_once('data/BestellingDAO.php');

class BestellingService {

    public static function plaatsBestelling($gebruikersId, $statusId, $betaald, $totaal) {
        $bestelling = BestellingDAO::create($gebruikersId, $statusId, $betaald, $totaal);
        return $bestelling;
    }

    public static function plaatsBestelregel($bestellingsid, $productid, $aantal, $subtotaal) {
        $bestelregel = BestellingDAO::createRegel($bestellingsid, $productid, $aantal, $subtotaal);
        return $bestelregel;
    }

    public static function plaatsBestelregelExtra($bestelregelId, $extraId) {
        BestellingDAO::createRegelExtra($bestelregelId, $extraId);
    }

    public static function getAlleBestellingen() {
        $bestellingen = BestellingDAO::getAll();
        return $bestellingen;
    }

    public static function getAllOverzichten() {
        $overzichten = BestellingDAO::getAllOverzichten();
        return $overzichten;
    }

    public static function getByGebruikersId($gebruikersid) {
        $overzichten = BestellingDAO::getByGebruiker($gebruikersid);
        return $overzichten;
    }

    public static function verwijderBestelling($id) {
        BestellingDAO::deleteBestelling($id);
    }

    public static function changeStatusBestelling($id, $statusid) {
        BestellingDAO::changeStatusBestelling($id, $statusid);
    }

}
