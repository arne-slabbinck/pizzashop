<?php

require_once('business/winkelmandservice.php');

WinkelmandService::verwijderVanWinkelmandje($_POST['winkelmandId']);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
