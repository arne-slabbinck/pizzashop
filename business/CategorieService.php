<?php

require_once('data/CategorieDAO.php');

class CategorieService {

    public static function toonAlleCategorien() {
        $categorieLijst = CategorieDAO::getAllCategories();
        return $categorieLijst;
    }

}
