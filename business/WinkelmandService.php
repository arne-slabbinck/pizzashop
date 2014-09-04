<?php

require_once('data/winkelmanddao.php');

class WinkelmandService {

    public static function voegToeAanWinkelmandje($product, $aantal, $extras, $id, $subtotaal) {
        WinkelmandDAO::create($product, $aantal, $extras, $id, $subtotaal);
    }

    public static function verwijderVanWinkelmandje($winkelmandId) {
        WinkelmandDAO::delete($winkelmandId);
    }

    public static function updateWinkelmandje($productid, $aantal) {
        WinkelmandDAO::update($productid, $aantal);
    }

    public static function getAantalItemsInWinkelmandje() {
        $aantal = WinkelmandDAO::getAantal();
        return $aantal;
    }

    public static function winkelmandjeLeegmaken() {
        WinkelmandDAO::leegMaken();
    }

}
