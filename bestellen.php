<?php

require_once('entities/gebruiker.php');
require_once('entities/product.php');
require_once('entities/bestelling.php');
require_once('entities/bestelregel.php');
require_once('entities/extra.php');
require_once('business/winkelmandservice.php');
require_once('business/bestellingservice.php');


require_once './vendor/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('bestellingGeplaatst.twig');

$gebruiker = unserialize($_SESSION["gebruiker"]);
$gebruikersId = $gebruiker->getId();
$totaal = 0;

//Totaal berekenen van de bestelling

foreach ($_SESSION['winkelmandje'] as $winkelmandItem) {

    $winkelmandItem = unserialize($winkelmandItem);

    $totaal += $winkelmandItem->getSubtotaal();
}

//Bestelling toevoegen

$bestelling = BestellingService::plaatsBestelling($gebruikersId, 1, 0, $totaal);

$bestellingsid = $bestelling->getId();


//Voor elk item in het winkelmandje een regel toevoegen

foreach ($_SESSION['winkelmandje'] as $winkelmandItem) {
    $winkelmandItem = unserialize($winkelmandItem);
    $product = $winkelmandItem->getProduct();
    $productid = $product->getId();
    $aantal = $winkelmandItem->getAantal();
    $subtotaal = $winkelmandItem->getSubtotaal();

    $bestelregel = BestellingService::plaatsBestelregel($bestellingsid, $productid, $aantal, $subtotaal);

    $bestelregelId = $bestelregel->getId();
    //var_dump($bestelregel);
    //Extras per bestelregel toevoegen
    $extras = $winkelmandItem->getExtras();
    //var_dump($extras);
    foreach ($extras as $extra) {
        $extraId = $extra->getId();

        BestellingService::plaatsBestelregelExtra($bestelregelId, $extraId);
    }
}

WinkelmandService::winkelmandjeLeegmaken();


$template->display(array());

//header('Location: winkelmandje.php');






//var_dump($winkelmandItem);