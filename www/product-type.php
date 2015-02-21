<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");

include("$ISA_LIBDIR/product-type-overview.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('product-type.html');

echo $template->render(array(
	'products' => $products,
	'pageNav' => $pageNav,
	));

