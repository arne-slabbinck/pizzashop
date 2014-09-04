<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';
require_once('business/winkelmandservice.php');
require_once('business/gebruikerService.php');
require_once('entities/gebruiker.php');


//session_start();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('registreer.twig');

$formfail = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["inputVoornaam"])) {
        $voornaam = htmlspecialchars($_POST["inputVoornaam"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputNaam"])) {
        $naam = htmlspecialchars($_POST["inputNaam"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputAdres"])) {
        $adres = htmlspecialchars($_POST["inputAdres"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputPostcode"])) {
        $postcode = htmlspecialchars($_POST["inputPostcode"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputGemeente"])) {
        $gemeente = htmlspecialchars($_POST["inputGemeente"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputTelefoon"])) {
        $telefoonnummer = htmlspecialchars($_POST["inputTelefoon"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputEmail"]) && filter_var($_POST["inputEmail"], FILTER_VALIDATE_EMAIL)) {
        $emailadres = htmlspecialchars($_POST["inputEmail"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputGebruikersnaam"])) {
        $gebruikersnaam = htmlspecialchars($_POST["inputGebruikersnaam"]);
    } else {
        $formfail = true;
    }

    if (!empty($_POST["inputWw2"]) && ($_POST["inputWw2"] == $_POST["inputWw1"])) {
        $wachtwoord = htmlspecialchars($_POST["inputWw2"]);
    } else {
        $formfail = true;
    }


    if ($formfail != true) {


        //beveilig wachtwoord

        $cost = 10;  //hoe hoger de cost, hoe meer secure maar hoe meer processing power nodig is
        //random salt maken
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');


        // het wachtwoord prefixen zodat php weet hoe het te verifyen later
        // "$2a$"  betekent dat het blowfish algorithm gebruikt worden
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        //het wachtwoord hashen met de salt

        $hash = crypt($wachtwoord, $salt);

        $gebruiker = GebruikerService::voegNieuweGebruikerToe($voornaam, $naam, $adres, $postcode, $gemeente, $telefoonnummer, $emailadres, $gebruikersnaam, $hash);

        $template = $twig->loadTemplate('registreerComplete.twig');
        $template->display(array("gebruiker" => $gebruiker));
    } else {

        $failed = true;
    }
} else {
    $failed = false;
}

$aantal = WinkelmandService::getAantalItemsInWinkelmandje();
$template->display(array("aantal" => $aantal, "failed" => $failed));





