<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';
require_once('business/productservice.php');
require_once('business/winkelmandservice.php');
require_once('business/extraservice.php');
require_once('business/gebruikerService.php');

//session_start();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('product.twig');

$product = ProductService::haalProductOp($_GET["id"]);
$extraLijst = ExtraService::toonAlleExtras();

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);
$toegevoegd = false;
$sPizza = "";
$sAantal = "";


if (isset($_SESSION["toegevoegd"]) && $_SESSION["toegevoegd"] == true && $_SESSION["categorie"] == 1) {
    $toegevoegd = true;
    $sPizza = $_SESSION["product"];
    $sAantal = $_SESSION["aantal"];
}
$template->display(array("product" => $product, "extraLijst" => $extraLijst, "aantal" => $aantal, "gebruiker" => $gebruiker,
    "toegevoegd" => $toegevoegd, "sPizza" => $sPizza, "sAantal" => $sAantal));

$_SESSION["toegevoegd"] = false;
