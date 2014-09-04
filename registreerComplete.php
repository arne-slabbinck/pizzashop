<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';
require_once('business/gebruikerService.php');

session_start();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('registreerComplete.twig');



$template->display(array());
