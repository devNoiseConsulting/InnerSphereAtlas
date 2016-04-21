<?php
$script = explode("&mobile=", $_SERVER['REQUEST_URI']);
$server = str_replace("www.", "", $_SERVER['SERVER_NAME']);
$canonicalLink = $ISA_CANONICAL_PROTOCOL . '://' . $server . $script[0];
