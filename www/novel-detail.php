<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

include("$ISA_LIBDIR/novel-detail.php");
include("$ISA_LIBDIR/novel-detail-publications.php");
include("$ISA_LIBDIR/novel-detail-timeline.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('novel-detail.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'novelData' => $novelData,
	'publisherData' => $publisherData,
	'timeline' => $timeline,
	));
