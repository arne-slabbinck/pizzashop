<?php

session_start();

unset($_SESSION['gebruiker']);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
