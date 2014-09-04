<?php

require_once("DBConfig.php");
require_once("entities/product.php");

class ProductDAO {

    public static function getAllPizzas() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, naam, prijs, korting, omschrijving, imgpath from product where categorieid = 1";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $pizza = Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["korting"], $rij["omschrijving"], $rij["imgpath"], 1);
            array_push($lijst, $pizza);
        }
        $dbh = null;

        return $lijst;
    }

    public static function getAllDranken() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, naam, prijs, korting, omschrijving, imgpath from product";
        $sql .= " where categorieid = 2";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $pizza = Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["korting"], $rij["omschrijving"], $rij["imgpath"], 2);
            array_push($lijst, $pizza);
        }
        $dbh = null;

        return $lijst;
    }

    public static function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select naam, prijs, korting, omschrijving, imgpath, categorieid from product where id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $product = Product::create($id, $rij["naam"], $rij["prijs"], $rij["korting"], $rij["omschrijving"], $rij["imgpath"], $rij["categorieid"]);
        $dbh = null;
        return $product;
    }

    public static function update($product) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "update product set naam='" . $product->getNaam() . "', prijs='" . $product->getPrijs() . "', korting='" . $product->getKorting() . "', omschrijving='" . $product->getOmschrijving() .
                "', imgpath='" . $product->getImgpath() . "', categorieid='" . $product->getCategorieid() . "' where id = " . $product->getId();
        $dbh->exec($sql);
        $dbh = null;
    }

}
