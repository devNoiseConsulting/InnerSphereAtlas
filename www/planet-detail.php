<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");

$planet = $_REQUEST["planet"];
if (empty($planet) || !is_numeric($planet)) { $planet = 2266787; }

include("$ISA_LIBDIR/planet-detail.php"); 

include("$ISA_LIBDIR/planet-detail-ownership.php"); 

include("$ISA_LIBDIR/planet-detail-factory.php"); 

include("$ISA_LIBDIR/planet-detail-neighbors.php"); 

include("$ISA_LIBDIR/planet-detail-novels.php"); 

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('planet-detail.html');

echo $template->render(array(
	'planet' => $planet,
	'planetData' => $planetData,
	'eraOwnership' => $eraOwnership,
	'eras' => $eras,
	'ownerDates' => $ownerDates,
	'factories' => $factories,
	'neighbors' => $neighbors,
	'novels' => $novels,
	));
