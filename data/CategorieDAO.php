<?php

require_once("DBConfig.php");
require_once("entities/categorie.php");

class CategorieDAO {

    public static function getAllCategories() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = " select id, omschrijving, extraMogelijk from categorie";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $categorie = Categorie::create($rij["id"], $rij["omschrijving"], $rij["extraMogelijk"]);
            array_push($lijst, $categorie);
        }
        $dbh = null;
        return $lijst;
    }

}
