<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

if ((count($slug) > 2) && (is_numeric($slug[2]))) {
	$productType = $slug[2];
} else {
	$productType = array_key_exists("searchvalue", $_GET) ? $_GET["searchvalue"] : 12000;
}
if (empty($productType) || !is_numeric($productType)) { $productType = 12000; }

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

include("$ISA_LIBDIR/product-type-detail.php");

if (array_key_exists("slug", $product)) {
	$canonicalLink = $seoLink . "/" . $product["slug"];
}

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('product-type-detail.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'productData' => $product,
	'products' => $products,
	'pageNav' => $pageNav,
	'copyrightYear' => date('Y')
	));
