<?php

require_once('business/gebruikerService.php');
require_once('business/winkelmandservice.php');
require_once('entities/gebruiker.php');
require_once('business/productservice.php');
require_once('business/categorieservice.php');

require_once './vendor/twig/lib/Twig/Autoloader.php';
//session_start();
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('bewerkProduct.twig');


$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);
$categorielijst = CategorieService::toonAlleCategorien();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product = ProductService::haalProductOp($_GET["productId"]);

    $template->display(array("product" => $product, "categorielijst" => $categorielijst, "gebruiker" => $gebruiker, "aantal" => $aantal));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["inputId"];
    $naam = $_POST["inputNaam"];
    $prijs = $_POST["inputPrijs"];
    $korting = $_POST["inputKorting"];
    $omschrijving = $_POST["inputOmschrijving"];
    $imgpath = $_POST["inputImgpath"];
    $categorieid = $_POST["inputCategorieId"];

    ProductService::bewerkProduct($id, $naam, $prijs, $korting, $omschrijving, $imgpath, $categorieid);
    $template = $twig->loadTemplate('productBewerkt.twig');
    $template->display(array("naam" => $naam));
}

