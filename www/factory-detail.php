<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

include("$ISA_LIBDIR/factory-detail.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('factory-detail.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'factoryData' => $factoryData,
	'components' => $components,
	'copyrightYear' => date('Y')
	));
