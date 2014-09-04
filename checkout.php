<?php

require_once('entities/product.php');
require_once('entities/extra.php');
require_once('entities/gebruiker.php');
require_once('business/productservice.php');
require_once('business/gebruikerService.php');
require_once('business/extraservice.php');
require_once('business/winkelmandservice.php');
require_once('business/gemeenteservice.php');


require_once './vendor/twig/lib/Twig/Autoloader.php';


Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('checkout.twig');

$winkelmandItems = array();
if (isset($_SESSION['winkelmandje'])) {
    foreach ($_SESSION['winkelmandje'] as $winkelmandItem) {
        array_push($winkelmandItems, unserialize($winkelmandItem));
    }
}

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

if ($_SESSION['gebruiker'] != "") {
    $gebruiker = unserialize($_SESSION['gebruiker']);

    $gemeentes = GemeenteService::controlleerGemeente($gebruiker->getPostcode());
    $template->display(array('winkelmandItems' => $winkelmandItems, "aantal" => $aantal, "gebruiker" => $gebruiker, "gemeentes" => $gemeentes));
} else {
    $template->display(array('winkelmandItems' => $winkelmandItems, "aantal" => $aantal));
}

//var_dump($_SESSION['gebruiker']);





