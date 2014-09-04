<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';
require_once('business/winkelmandservice.php');
require_once('business/gebruikerService.php');
require_once('business/bestellingService.php');
require_once('business/statusservice.php');
require_once('entities/overzicht.php');
require_once('entities/gebruiker.php');
require_once('entities/winkelmanditem.php');
require_once('entities/status.php');


Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('bestellingen.twig');


$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

$gebruiker = unserialize($_SESSION['gebruiker']);

$bestellingen = BestellingService::getAlleBestellingen();

$overzichten = BestellingService::getAllOverzichten();

$statussen = StatusService::toonAlleStatussen();

//var_dump($overzichten);

$template->display(array("gebruiker" => $gebruiker, "aantal" => $aantal, "bestellingen" => $bestellingen,
    "overzichten" => $overzichten, "statussen" => $statussen));
