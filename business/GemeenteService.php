<?php

require_once('data/GemeenteDAO.php');

class GemeenteService {

    public static function controlleerGemeente($postcode) {
        $gemeente = GemeenteDAO::getByPostcode($postcode);
        return $gemeente;
    }

}
