<?php

require_once './vendor/twig/lib/Twig/Autoloader.php';
require_once('business/productservice.php');
require_once('entities/product.php');
require_once('business/winkelmandservice.php');
require_once('business/extraservice.php');
require_once('entities/extra.php');
//session_start();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('pres');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('toegevoegd.twig');

//print($_GET['productid']);
$product = ProductService::haalProductOp($_POST['id']);

//print($_POST["extraId"]);
//Als er extra's gegeven zijn, die nemen, anders gene meegeven (bv bij dranken)

$extras = array();

$id = "";
$id = $id . $_POST['id'];

$extraPrijs = 0;

if (isset($_POST["extraId1"])) {
    if ($_POST["extraId1"] != 0) {
        $extra = ExtraService::haalExtraOp($_POST["extraId1"]);
        array_push($extras, $extra);
        $id = $id . $_POST["extraId1"];
        $extraPrijs += $extra->getPrijs();
    } else {
        $extra = "geenextra";
    }
} else {
    //$extras = "geenextra";
}

if (isset($_POST["extraId2"])) {
    if ($_POST["extraId2"] != 0) {
        $extra = ExtraService::haalExtraOp($_POST["extraId2"]);
        array_push($extras, $extra);
        $id = $id . $_POST["extraId1"];
        $extraPrijs += $extra->getPrijs();
    } else {
        $extra = "geenextra";
    }
} else {
    //$extras = "geenextra";
}

if (isset($_POST["extraId3"])) {
    if ($_POST["extraId3"] != 0) {
        $extra = ExtraService::haalExtraOp($_POST["extraId3"]);
        array_push($extras, $extra);
        $id = $id . $_POST["extraId3"];
        $extraPrijs += $extra->getPrijs();
    } else {
        $extra = "geenextra";
    }
} else {
    //$extras = "geenextra";
}

//Als het aantal gegeven is, die nemen, anders standaar '1' nemen

if (isset($_POST["aantal"])) {
    $aantal = $_POST["aantal"];
} else {
    $aantal = 1;
}

$prijs = $product->getPrijs();
$subtotaal = ($prijs + $extraPrijs ) * $aantal;

//subtotaal toevoegen aan winkelmanditem


WinkelmandService::voegToeAanWinkelmandje($product, $aantal, $extras, $id, $subtotaal);

//header("Location: " . $_SERVER['PHP_SELF']);
//exit(0);
//$template->display(array("product" => $product));

$categorie = $product->getCategorieid();

$_SESSION["categorie"] = $categorie;
$_SESSION["product"] = $product->getNaam();
$_SESSION["aantal"] = $aantal;
$_SESSION["toegevoegd"] = true;


header("Location: {$_SERVER['HTTP_REFERER']}");
exit;


