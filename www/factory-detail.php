<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

if ((count($slug) > 2) && (is_numeric($slug[2]))) {
	$factory = $slug[2];
} else {
	$factory = array_key_exists("factory", $_REQUEST) ? $_REQUEST["factory"] : "6253789";
}
if (empty($factory) || !is_numeric($factory)) { $factory = 6253789; }

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

include("$ISA_LIBDIR/factory-detail.php");
include("$ISA_LIBDIR/product_component.php");


if (array_key_exists("slug", $factoryData)) {
	$canonicalLink = $seoLink . "/" . $factoryData["slug"];
}

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('factory-detail.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'factoryData' => $factoryData,
	'components' => $components,
	'copyrightYear' => date('Y')
	));
