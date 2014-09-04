<?php

require_once('entities/product.php');
require_once('entities/extra.php');
require_once('business/productservice.php');
require_once('business/gebruikerService.php');
require_once('business/extraservice.php');
require_once('business/winkelmandservice.php');


//session_start();


require_once './vendor/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('winkelmandje.twig');


$winkelmandItems = array();
if (isset($_SESSION['winkelmandje'])) {
    foreach ($_SESSION['winkelmandje'] as $winkelmandItem) {
        array_push($winkelmandItems, unserialize($winkelmandItem));
    }
}

//var_dump($winkelmandItems);

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);


$template->display(array('winkelmandItems' => $winkelmandItems, 'aantal' => $aantal, "gebruiker" => $gebruiker));
