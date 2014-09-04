<?php

require_once('business/bestellingservice.php');

BestellingService::verwijderBestelling($_POST["bestellingId"]);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
