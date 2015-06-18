<?php

require_once('../vendor/autoload.php');

include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

include("$ISA_LIBDIR/factory-overview.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('factory.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'factories' => $factories,
	'pageNav' => $pageNav,
	));
