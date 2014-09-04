<?php

require_once("DBConfig.php");
require_once("entities/gemeente.php");

class GemeenteDAO {

    public static function getByPostcode($postcode) {

        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select postcode, gemeente from gemeente where postcode = " . $postcode;
        $resultSet = $dbh->query($sql);
        $bestaat = $resultSet->fetch();
        if (!$bestaat) {
            return false;
        } else {
            foreach ($resultSet as $rij) {
                $gemeente = new Gemeente($rij["postcode"], $rij["gemeente"]);
                array_push($lijst, $gemeente);
            }
            return $lijst;
        }
    }

}
