<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

include("$ISA_LIBDIR/planet-overview.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('planet.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'planets' => $planets,
	'pageNav' => $pageNav,
	'copyrightYear' => date('Y')
	));
