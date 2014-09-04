<?php

require_once('data/ExtraDAO.php');

class ExtraService {

    public static function toonAlleExtras() {
        $extraLijst = ExtraDAO::getAllExtras();
        return $extraLijst;
    }

    public static function haalExtraOp($id) {
        $extra = ExtraDAO::getById($id);
        return $extra;
    }

    public static function toonExtrasPerBestelregel($id) {
        $extras = ExtraDAO::getByBestelregel($id);
        return $extras;
    }

}
