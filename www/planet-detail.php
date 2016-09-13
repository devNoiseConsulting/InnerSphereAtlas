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

$amp = "";
if ((count($slug) > 4) && ($slug[4] == "amp")) {
	$mobile = true;
} else {
	$mobile = array_key_exists("mobile", $_GET) ? $_GET["mobile"] : false;
}
if ($mobile) {
	$mobile = true;
	$amp = "/amp";
}

include("$ISA_LIBDIR/planet-detail.php");

include("$ISA_LIBDIR/planet-detail-ownership.php");

include("$ISA_LIBDIR/planet-detail-factory.php");

include("$ISA_LIBDIR/planet-detail-neighbors.php");

include("$ISA_LIBDIR/planet-detail-novels.php");

if (array_key_exists("slug", $planetData)) {
	$canonicalLink = $seoLink . "/" . $planetData["slug"];
}

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('planet-detail.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'planet' => $planet,
	'planetData' => $planetData,
	'eraOwnership' => $eraOwnership,
	'eras' => $eras,
	'ownerDates' => $ownerDates,
	'factories' => $factories,
	'neighbors' => $neighbors,
	'novels' => $novels,
	'mobile' => $mobile,
	'amp' => $amp,
	'copyrightYear' => date('Y')
	));
