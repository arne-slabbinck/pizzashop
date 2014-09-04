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
$template = $twig->loadTemplate('pizzas.twig');


$pizzaLijst = ProductService::toonAllePizzas();
$drankenLijst = ProductService::toonAlleDranken();

$extraLijst = ExtraService::toonAlleExtras();

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();


if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);




$template->display(array("pizzaLijst" => $pizzaLijst, "drankenLijst" => $drankenLijst,
    "gebruiker" => $gebruiker, "extraLijst" => $extraLijst, "aantal" => $aantal));
