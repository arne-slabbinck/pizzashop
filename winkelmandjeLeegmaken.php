<?php

require_once('business/winkelmandservice.php');

WinkelmandService::winkelmandjeLeegmaken();

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
