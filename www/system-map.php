<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

if ((count($slug) > 2) && (is_numeric($slug[2]))) {
	$planet = $slug[2];
} else {
	$planet = array_key_exists("planet", $_GET) ? $_GET["planet"] : 2266787;
}
if (empty($planet) || !is_numeric($planet)) { $planet = 2266787; }

if ((count($slug) > 4) && (is_numeric($slug[4]))) {
	$era = $slug[4];
} else {
	$era = array_key_exists("era", $_GET) ? $_GET["era"] : "3062";
}
if (empty($era) || !is_numeric($era)) { $era = 3062; }
$preg_eras = "/(2575|2750|30(25|30|40|52|57|62))/";
if (!preg_match($preg_eras, $era)) { $era = 3062; }
$era = preg_replace($preg_eras, "\\1", $era);

$amp = "";
if ((count($slug) > 5) && ($slug[5] == "amp")) {
	$mobile = true;
} else {
	$mobile = array_key_exists("mobile", $_GET) ? $_GET["mobile"] : false;
}
if ($mobile) {
	$mobile = true;
	$amp = "/amp";
}

include("$ISA_LIBDIR/system-map.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('system-map.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'planet' => $planet,
	'planetData' => $planetData,
	'currentEra' => 'E' . $era,
	'eras' => $eras,
	'svg_url' => $svg_url,
	'copyrightYear' => date('Y')
	));
