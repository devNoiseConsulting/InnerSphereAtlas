<?php
$script = explode("&amp=", $_SERVER['REQUEST_URI']);

$canonicalLink = $ISA_CANONICAL_PROTOCOL . '://' .
	$_SERVER['SERVER_NAME'] .
	$script[0];
#$canonicalLink = htmlspecialchars($canonicalLink, ENT_QUOTES, 'UTF-8');
