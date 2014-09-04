<?php

require_once("entities/product.php");
require_once("entities/winkelmanditem.php");
require_once("entities/extra.php");


session_start();

class WinkelmandDAO {

    public static function create($product, $aantal, $extras, $id, $subtotaal) {

        //als het product dat we willen toevoegen al eens toegevoegd is aan het winkelmandje

        if (isset($_SESSION["winkelmandje"][$id])) {
            $winkelmandItem = unserialize($_SESSION["winkelmandje"][$id]);
            $aantalOrigineel = $winkelmandItem->getAantal();
            $subtotaalOrigineel = $winkelmandItem->getSubtotaal();

            $aantal += $winkelmandItem->getAantal();
            $subtotaal = ($subtotaalOrigineel / $aantalOrigineel) * $aantal;
        }


        $winkelmandItem = new WinkelmandItem($product, $aantal, $extras, $id, $subtotaal);

        //in session steken met key van productID, om later makkelijk terug
        //te vinden en te verwijderen

        $_SESSION['winkelmandje'][$id] = serialize($winkelmandItem);
    }

    public static function delete($productid) {
        $teDeletenItem = unserialize($_SESSION["winkelmandje"][$productid]);
        unset($_SESSION['winkelmandje'][$productid]);
    }

    public static function leegMaken() {
        unset($_SESSION['winkelmandje']);
    }

    public static function update($productid, $aantal) {
        $winkelmandItem = unserialize($_SESSION["winkelmandje"][$productid]);
        $subtotaalOrigineel = $winkelmandItem->getSubtotaal();
        $aantalOrigineel = $winkelmandItem->getAantal();
        $subtotaal = $subtotaalOrigineel / $aantalOrigineel;
        $subtotaal = $subtotaal * $aantal;
        $winkelmandItem->setAantal($aantal);
        $winkelmandItem->setSubtotaal($subtotaal);
        $_SESSION['winkelmandje'][$productid] = serialize($winkelmandItem);
    }

    public static function getAantal() {
        $aantal = 0;
        if (!isset($_SESSION["winkelmandje"])) {
            return $aantal;
        } else {
            foreach ($_SESSION["winkelmandje"] as $item) {
                $aantal += 1;
            }
        }
        return $aantal;
    }

}
