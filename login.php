<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';
require_once('business/winkelmandservice.php');
require_once('business/gebruikerService.php');
require_once('entities/gebruiker.php');

//session_start();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('login.twig');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruiker = GebruikerService::checkGebruiker($_POST['inputGebruikersnaam'], $_POST['inputWachtwoord']);

    if ($gebruiker == false) {
        $_SESSION['loginFail'] = true;
    } else {
        $_SESSION['gebruiker'] = serialize($gebruiker);
        $_SESSION['loginFail'] = false;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();

if (!isset($_SESSION['gebruiker'])) {
    $_SESSION['gebruiker'] = "";
}

//var_dump($_SESSION['gebruiker']);
$gebruiker = unserialize($_SESSION['gebruiker']);

$template->display(array("aantal" => $aantal, "gebruiker" => $gebruiker));
