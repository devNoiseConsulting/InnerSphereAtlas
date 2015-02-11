<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");

$planet = $_REQUEST["planet"];
if (empty($planet) || !is_numeric($planet)) { $planet = 2266787; }

include("$ISA_LIBDIR/planet-detail.php"); 

include("$ISA_LIBDIR/planet-detail-ownership.php"); 

/*


echo "<a name=\"map\" /><h2>Starmap of Surrounding Systems:</h2>\n";
$eras = array(2575, 2750, 3025, 3030, 3040, 3052, 3057, 3062);
for ($i = 0; $i < 8; $i++) {
	$eraMaps .= "<a href=\"./system-map.php?planet=". urlencode($planet) . "&amp;era=" . $eras[$i] . "\">" . $eras[$i] . "</a> | ";
}
$eraMaps = rtrim($eraMaps, " |");
echo "$eraMaps\n";

include("$ISA_LIBDIR/planet-detail-factory.php"); 

include("$ISA_LIBDIR/planet-detail-neighbors.php"); 

include("$ISA_LIBDIR/planet-detail-novels.php"); 

include("$ISA_DOCROOTDIR/adsense.php"); 
include("$ISA_DOCROOTDIR/cya.php"); 
*/

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('planet-detail.html');

echo $template->render(array(
	'planetData' => $planetData,
	'eraOwnership' => $eraOwnership,
	'eras' => $eras,
	'ownerDates' => $ownerDates
	));
