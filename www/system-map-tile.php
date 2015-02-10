<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");

        $ISA_MAP_SIZE = 2600;
        $ISA_MAP_RADIUS = 1300;
        $ISA_MAP_OFFSET = $ISA_MAP_SIZE / 2;
        $ISA_MAP_SCALE = $ISA_MAP_SIZE / $ISA_MAP_RADIUS / 2;
        $ISA_MAP_PLANET_DIAMETER = 7;
        $ISA_MAP_PLANET_RADIUS = $ISA_MAP_PLANET_DIAMETER / 2;
        $ISA_MAP_TITLE_OFFSET = floor(($ISA_MAP_PLANET_DIAMETER + 1) / 2);
        $ISA_MAP_BUFFER = 15;

header("Content-type: image/png");

$im = @imageCreate ($ISA_MAP_SIZE, $ISA_MAP_SIZE) or die ("Cannot Initialize new GD image stream");

$background_color = imageColorAllocate ($im, 255, 255, 255);
$grey = imageColorAllocate ($im, 128, 128, 128);
$black = imageColorAllocate ($im, 0, 0, 0);
$ringSize = 30 * $ISA_MAP_SCALE * 2;
#imageArc($im, $ISA_MAP_OFFSET, $ISA_MAP_OFFSET, $ringSize, $ringSize, 0, 360, $grey);

$x = array_key_exists("x", $_REQUEST) ? $_REQUEST["x"] : "0";
if (!is_numeric($x)) { $x = 0; }
$y = array_key_exists("y", $_REQUEST) ? $_REQUEST["y"] : "0";
if (!is_numeric($y)) { $y = 0; }

$era = array_key_exists("era", $_REQUEST) ? $_REQUEST["era"] : "3062";
if (!is_numeric($era)) { $era = 3062; }
$era = preg_replace("/(2575|2750|30(25|30|40|52|57|62))/", "era_\\1", $era);

$query = "SELECT
P.name,
P.x_coord,
P.y_coord,
F.color1_r,
F.color1_g,
F.color1_b
FROM
planet P,
faction F,
" . $era . " E
WHERE
P.planet_id=E.planet_id AND
E.faction_id=F.faction_id
ORDER BY
F.color1_r,
F.color1_g,
F.color1_b,
P.x_coord,
P.y_coord";

$sth = $dbh->prepare($query);
$sth->execute();
$planets = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

$colorMap = array();
/* Loop through each item */
for ($i=0; $i < count($planets); $i++) {
	$name = $planets[$i]['name'];

	$x_coord = ($planets[$i]['x_coord'] - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
	$y_coord = ($planets[$i]['y_coord'] - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;

	$red = $planets[$i]['color1_r'];
	$green = $planets[$i]['color1_g'];
	$blue = $planets[$i]['color1_b'];
	$key = $red . ":" . $green . ":" . $blue;
	if (empty($colorMap[$key])) {
		$current_color = imageColorAllocate ($im, $red, $green, $blue);
		$colorMap[$key] = $current_color;
	} else {
		$current_color = $colorMap[$key];
	}
	imageArc($im, $x_coord, $y_coord, $ISA_MAP_PLANET_DIAMETER, $ISA_MAP_PLANET_DIAMETER, 0, 360, $current_color);
}

imagePng($im);
?>
