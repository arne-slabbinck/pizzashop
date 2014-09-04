<?php

require_once("DBConfig.php");
require_once("entities/status.php");

class StatusDAO {

    public static function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select omschrijving from status where id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $status = Status::create($id, $rij["omschrijving"]);
        $dbh = null;
        return $status;
    }

    public static function getAll() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, omschrijving from status";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $status = Status::create($rij["id"], $rij["omschrijving"]);
            array_push($lijst, $status);
        }
        $dbh = null;
        return $lijst;
    }

}
