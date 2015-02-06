<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");

header("Content-type: image/png");

$im = @imageCreate ($ISA_MAP_SIZE, $ISA_MAP_SIZE) or die ("Cannot Initialize new GD image stream");

$background_color = imageColorAllocate ($im, 255, 255, 255);
$grey = imageColorAllocate ($im, 128, 128, 128);
$black = imageColorAllocate ($im, 0, 0, 0);
$ringSize = 30 * $ISA_MAP_SCALE * 2;
imageArc($im, $ISA_MAP_OFFSET, $ISA_MAP_OFFSET, $ringSize, $ringSize, 0, 360, $grey);

//$x_coord = (0 - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
//$y_coord = (0 - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
//$ringSize = 250 * $ISA_MAP_SCALE * 2;
//imageArc($im, $x_coord, $y_coord, $ringSize, $ringSize, 0, 360, $black);
//$ringSize = 500 * $ISA_MAP_SCALE * 2;
//imageArc($im, $x_coord, $y_coord, $ringSize, $ringSize, 0, 360, $black);

$x = $_REQUEST["x"];
if (empty($x) || !is_numeric($x)) { $x = 0; }
$y = $_REQUEST["y"];
if (empty($y) || !is_numeric($y)) { $y = 0; }

$era = $_REQUEST["era"];
if (empty($era)|| !is_numeric($era)) { $era = 3062; }
$era = preg_replace("/(2575|2750|30(25|30|40|52|57|62))/", "era_\\1", $era);

$query = "SELECT P.name, P.x_coord, P.y_coord, F.color1_r, F.color1_g, F.color1_b
FROM planet P, faction F, " . $era . " E
WHERE (P.x_coord > " . ($x - 60) . " AND P.x_coord < " . ($x + 60) . ") AND 
(P.y_coord > " . ($y - 60) . " AND P.y_coord < " . ($y + 60) . ") AND
P.planet_id=E.planet_id AND E.faction_id=F.faction_id
ORDER BY P.x_coord, P.y_coord";

$result = mysql_query($query);
$num = mysql_numrows($result);

/* Loop through each item */
for ($i=0; $i < $num; $i++) {
	$name = mysql_result($result, $i, "name");

	$x_coord = (mysql_result($result, $i, "x_coord") - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
	$y_coord = (mysql_result($result, $i, "y_coord") - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;

	$red = mysql_result($result, $i, "color1_r");
	$green = mysql_result($result, $i, "color1_g");
	$blue = mysql_result($result, $i, "color1_b");
	$current_color = imageColorAllocate ($im, $red, $green, $blue);
	
	imageArc($im, $x_coord, $y_coord, $ISA_MAP_PLANET_DIAMETER, $ISA_MAP_PLANET_DIAMETER, 0, 360, $current_color);
	imageString($im, 4, $x_coord - $ISA_MAP_TITLE_OFFSET, $y_coord + $ISA_MAP_TITLE_OFFSET, $name, $current_color);
}
mysql_free_result($result);

//imageline ( resource image, int x1, int y1, int x2, int y2, int col)
imageRectangle($im, 0, 0, $ISA_MAP_SIZE - 1, $ISA_MAP_SIZE - 1, $background_color);
imageRectangle($im, 1, 1, $ISA_MAP_SIZE - 2, $ISA_MAP_SIZE - 2, $black);
imageLine($im, $ISA_MAP_SIZE - 1, 2, $ISA_MAP_SIZE - 1, $ISA_MAP_SIZE - 1, $black);
imageLine($im, 2, $ISA_MAP_SIZE - 1, $ISA_MAP_SIZE - 1, $ISA_MAP_SIZE - 1, $black);

$isatlas = "http://isatlas.teamspam.net/";
imageString($im, 3, 6, $ISA_MAP_SIZE - 15, $isatlas, $background_color);
imageString($im, 3, 5, $ISA_MAP_SIZE - 16, $isatlas, $black);

imagePng($im);
?>
