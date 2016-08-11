<?php
$script = explode("&mobile=", $_SERVER['REQUEST_URI']);
$server = str_replace("www.", "", $_SERVER['SERVER_NAME']);
$canonicalLink = $ISA_CANONICAL_PROTOCOL . '://' . $server . $script[0];

$slug = explode("/", $_SERVER['REQUEST_URI']);
$seoLink = $ISA_CANONICAL_PROTOCOL . '://' . $server . $_SERVER['SCRIPT_NAME'];
