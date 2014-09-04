<?php

require_once('business/gebruikerService.php');
require_once('business/winkelmandservice.php');
require_once('business/gemeenteservice.php');
require_once('entities/gebruiker.php');


//session_start();


require_once './vendor/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('index.twig');



//var_dump($winkelmandItems);

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postcode = $_POST["inputPostcode"];
    $gemeentes = GemeenteService::controlleerGemeente($postcode);
} else {
    $gemeentes = "nognietingevoerd";
}

$template->display(array("aantal" => $aantal, "gebruiker" => $gebruiker, "gemeentes" => $gemeentes));





