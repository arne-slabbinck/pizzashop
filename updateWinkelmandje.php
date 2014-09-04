<?php

require_once('business/winkelmandservice.php');


WinkelmandService::updateWinkelmandje($_POST["winkelmandId"], $_POST["aantal"]);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;

