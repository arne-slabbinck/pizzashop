<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';
require_once('business/productservice.php');
require_once('business/gebruikerService.php');
require_once('business/extraservice.php');
require_once('business/winkelmandservice.php');

//session_start();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('dranken.twig');

$drankenLijst = ProductService::toonAlleDranken();

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);
$toegevoegd = false;
$sDrank = "";
$sAantal = "";

if (isset($_SESSION["toegevoegd"]) && $_SESSION["toegevoegd"] == true && $_SESSION["categorie"] == 2) {
    $toegevoegd = true;
    $sDrank = $_SESSION["product"];
    $sAantal = $_SESSION["aantal"];
}



$template->display(array("drankenLijst" => $drankenLijst, "aantal" => $aantal, "gebruiker" => $gebruiker,
    "toegevoegd" => $toegevoegd, "sDrank" => $sDrank, "sAantal" => $sAantal));

$_SESSION["toegevoegd"] = false;


