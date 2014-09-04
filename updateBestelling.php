<?php

require_once('business/bestellingservice.php');


BestellingService::changeStatusBestelling($_POST["bestellingId"], $_POST["statusId"]);


header("Location: {$_SERVER['HTTP_REFERER']}");
exit;