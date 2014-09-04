<?php

require_once('data/ProductDAO.php');

class ProductService {

    public static function toonAllePizzas() {
        $pizzaLijst = ProductDAO::getAllPizzas();

        return $pizzaLijst;
    }

    public static function toonAlleDranken() {
        $drankenLijst = ProductDAO::getAllDranken();
        return $drankenLijst;
    }

    public static function haalProductOp($id) {
        $product = ProductDAO::getById($id);
        return $product;
    }

    public static function bewerkProduct($id, $naam, $prijs, $korting, $omschrijving, $imgpath, $categorieid) {
        $product = ProductDAO::getById($id);
        $product->setNaam($naam);
        $product->setPrijs($prijs);
        $product->setKorting($korting);
        $product->setOmschrijving($omschrijving);
        $product->setImgpath($imgpath);
        $product->setCategorieid($categorieid);
        
        ProductDAO::update($product);
    }

}
