<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

$planet = array_key_exists("planet", $_REQUEST) ? $_REQUEST["planet"] : 2266787;
$query = "SELECT
P.name,
P.x_coord,
P.y_coord
FROM
planet P
where
P.planet_id = :planet
";

$sth = $dbh->prepare($query);
$sth->bindParam(':planet', $planet);
$sth->execute();
$planetData = $sth->fetch(PDO::FETCH_ASSOC);

if ($planetData) {
	$name = $planetData['name'];
	$x = $planetData['x_coord'];
	$y = $planetData['y_coord'];
}

if (empty($x)) { $x = 0; }
if (empty($y)) { $y = 0; }
if (empty($name)) { $name = "Terra"; }

$era = array_key_exists("era", $_REQUEST) ? $_REQUEST["era"] : "3062";
if (!is_numeric($era)) { $era = 3062; }
$preg_eras = "/(2575|2750|30(25|30|40|52|57|62))/";
if (!preg_match($preg_eras, $era)) { $era = 3062; }
$era = preg_replace($preg_eras, "\\1", $era);

$eras = array('E2575', 'E2750', 'E3025', 'E3030', 'E3040', 'E3052', 'E3057', 'E3062');

$svg_url = "./system-map-svg.php?planet=" . urlencode($planet) . "&era=" . $era;

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('system-map.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'planet' => $planet,
	'planetData' => $planetData,
	'currentEra' => 'E' . $era,
	'eras' => $eras,
	'svg_url' => $svg_url,
	));
