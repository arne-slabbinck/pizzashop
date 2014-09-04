<?php

require_once('business/gebruikerservice.php');

GebruikerService::updateGebruikerStatus($_POST["gebruikersId"], $_POST["status"]);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
