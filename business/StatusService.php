<?php

require_once('data/StatusDAO.php');

class StatusService {

    public static function haalStatusOp($id) {
        $status = StatusDAO::getById($id);
        return $status;
    }

    public static function toonAlleStatussen() {
        $statussen = StatusDAO::getAll();
        return $statussen;
    }

}
