<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

include("$ISA_LIBDIR/novel-overview.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('novel.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'novelData' => $novelData,
	'pageNav' => $pageNav,
	));
