<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';

require_once('business/gebruikerService.php');
require_once('business/winkelmandservice.php');

//session_start();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('gebruikers.twig');

$gebruikersLijst = GebruikerService::toonAlleGebruikers();

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);


$template->display(array("gebruikersLijst" => $gebruikersLijst, "aantal" => $aantal, "gebruiker" => $gebruiker));
