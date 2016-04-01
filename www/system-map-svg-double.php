<?php
include("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
include("$ISA_LIBDIR/connect.php");

header("Content-type: image/svg+xml");

//mark this as XML
print('<?xml version="1.0" encoding="UTF-8" ?>' . "\n");
?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1 Basic//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11-basic.dtd">
<svg
     version="1.1"
     baseProfile="basic"
     xmlns="http://www.w3.org/2000/svg"
     xmlns:xlink="http://www.w3.org/1999/xlink"
     id="svg-root"
     width="100%"
     height="100%"
     viewBox="0 0 <?php echo($ISA_MAP_SIZE . ' ' . $ISA_MAP_SIZE); ?>" >
<?php

$planet = array_key_exists("planet", $_REQUEST) ? $_REQUEST["planet"] : "2266787";
if (!is_numeric($planet)) { $planet = 2266787; }

$era = array_key_exists("era", $_REQUEST) ? $_REQUEST["era"] : "3062";
if (!is_numeric($era)) { $era = 3062; }
$preg_eras = "/(2575|2750|30(25|30|40|52|57|62))/";
if (!preg_match($preg_eras, $era)) { $era = 3062; }
$era = preg_replace($preg_eras, "era_\\1", $era);

$query = "SELECT
P.planet_id,
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
P.planet_id = :planet AND
P.planet_id=E.planet_id AND
E.faction_id=F.faction_id
";

$sth = $dbh->prepare($query);
$sth->bindParam(':planet', $planet);
$sth->execute();
$planetData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;

if ($planetData) {
	$name = $planetData['name'];
	$planet_id = $planetData['planet_id'];

	$x = $planetData['x_coord'];
	$x_min = $x - 60;
	$x_max = $x + 60;

	$y = $planetData['y_coord'];
	$y_min = $y - 60;
	$y_max = $y + 60;

	$red = $planetData['color1_r'];
	$green = $planetData['color1_g'];
	$blue = $planetData['color1_b'];
	$rgb = 	$red . "," . $green . "," .$blue;

	$query = "SELECT
	P1.x_coord AS P1x,
	P1.y_coord AS P1y,
	P2.x_coord AS P2x,
	P2.y_coord AS P2y
	FROM
	jump_points J1,
	jump_points J2,
	planet P1,
	planet P2
	WHERE
	J1.planet_id = :planet_id AND
	J1.jump_id = P1.planet_id AND
	J1.jump_id = J2.planet_id AND
	J2.jump_id = P2.planet_id
	ORDER BY
	P1.x_coord,
	P1.y_coord,
	P2.x_coord,
	P2.y_coord
	";

	$sth = $dbh->prepare($query);
	$sth->bindParam(':planet_id', $planet_id);
	$sth->execute();
	$planetJumps = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;

	$ringSize = 30 * $ISA_MAP_SCALE - 0.5;
?>
<rect x="1" y="0.5" width="<?php echo($ISA_MAP_SIZE - 1); ?>" height="<?php echo($ISA_MAP_SIZE - 1); ?>" fill="whitesmoke" />
<circle cx="<?php echo($ISA_MAP_OFFSET); ?>" cy="<?php echo($ISA_MAP_OFFSET); ?>" r="<?php echo($ringSize); ?>" stroke="black" stroke-width="1" stroke-dasharray="15" opacity="0.25" fill="rgb(<?php echo($rgb); ?>)" />
<g stroke="black" stroke-width="0.5" stroke-dasharray="3" opacity="0.33" fill="none">
<?php
	$jump = array();
	/* Loop through each item */
	for ($i=0; $i < count($planetJumps); $i++) {

		$x1_coord = ($planetJumps[$i]['P1x'] - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$y1_coord = ($planetJumps[$i]['P1y'] - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$x2_coord = ($planetJumps[$i]['P2x'] - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$y2_coord = ($planetJumps[$i]['P2y'] - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;

		$key1 = $x1_coord . "_" . $y1_coord . ":" . $x2_coord . "_" . $y2_coord;
		$key2 = $x2_coord . "_" . $y2_coord . ":" . $x1_coord . "_" . $y1_coord;

		if (($jump[$key1] == null) || ($jump[$key2] == null)) {
			echo '<line x1="' . $x1_coord . '" y1="' . $y1_coord;
			echo '" x2="' . $x2_coord . '" y2="' . $y2_coord;
			echo '" />' . "\n";

			$jump[$key1] = 1;
			$jump[$key2] = 1;
		}
	}
	echo '</g>' . "\n\n";

	$query = "SELECT
	P.planet_id,
	P.name,
	P.x_coord,
	P.y_coord,
	F.color1_r,
	F.color1_g,
	F.color1_b,
	E.capital
	FROM
	planet P,
	faction F,
	" . $era . " E
	WHERE
	(P.x_coord > :x_min AND P.x_coord < :x_max) AND
	(P.y_coord > :y_min AND P.y_coord < :y_max) AND
	P.planet_id = E.planet_id AND
	E.faction_id = F.faction_id
	ORDER BY
	P.x_coord,
	P.y_coord
	";

	$sth = $dbh->prepare($query);
	$sth->bindParam(':x_min', $x_min);
	$sth->bindParam(':x_max', $x_max);
	$sth->bindParam(':y_min', $y_min);
	$sth->bindParam(':y_max', $y_max);
	$sth->execute();
	$planets = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;

	$font_size = $ISA_MAP_PLANET_DIAMETER * 1.5;
	echo '<g font-family="Helvetica" font-size="' . $font_size . '" >' . "\n";
	/* Loop through each item */
	for ($i=0; $i < count($planets); $i++) {
		$name = $planets[$i]['name'];
		$planet_id = $planets[$i]['planet_id'];

		$x_coord = ($planets[$i]['x_coord'] - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$y_coord = ($planets[$i]['y_coord'] - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;

		$red = $planets[$i]['color1_r'];
		$green = $planets[$i]['color1_g'];
		$blue = $planets[$i]['color1_b'];
		$color = 'rgb(' . $red . ',' . $green . ',' . $blue . ')';

		$capital = $planets[$i]['capital'];

		$x_title = $x_coord - $ISA_MAP_TITLE_OFFSET + 1;
		$y_title = $y_coord + $font_size + 2;

		echo '<a xlink:href="./planet-detail.php?planet=' . $planet_id . '" xlink:alt="' . $name . '" target="_top">' . "\n";
		if ($capital == 0) {
			echo '<circle id="jump_limit" cx="' . $x_coord . '" cy="' . $y_coord . '" r="' . $ISA_MAP_PLANET_RADIUS;
			echo '" fill="' . $color . '" />' . "\n";
		} else {
			echo '<polygon stroke="' . $color . '" stroke-width="1.5" ';
			echo 'fill="' . $color . '" points="';

			$radius = ((1 / $capital) + 1) * $ISA_MAP_PLANET_RADIUS;
			$sides = $capital + 2;
			$angle = 2 * pi() / $sides;
			$currentAngle = 0;
			if (($sides % 2) == 0) {
				$currentAngle = $angle / 2;
			}
			for ($j = 1; $j <= $sides; $j++) {
				$pX = $x_coord - ($radius * sin($currentAngle));
				$pY = $y_coord - ($radius * cos($currentAngle));
				echo round($pX, 2) . "," . round($pY, 2) . " ";
				$currentAngle += $angle;
			}

			echo '" />';
			$x_title -= ($radius / 4);
			$y_title += ($radius / 4);
		}
		echo '<text x="' . $x_title . '" y="' . $y_title . '">' . $name . '</text></a>' . "\n";
	}
	echo '</g>' . "\n\n";
}
$font_size = $ISA_MAP_PLANET_DIAMETER * 3;
$x_coord = $ISA_MAP_PLANET_RADIUS;
$y_coord = $ISA_MAP_SIZE - $ISA_MAP_PLANET_DIAMETER;

?>
<g stroke="black" stroke-width="1" opacity="0.5" >
<text font-family="Helvetica" font-size="<?php echo($font_size); ?>"  x="<?php echo($x_coord); ?>" y="<?php echo($y_coord); ?>">
<a xlink:href="http://isatlas.teamspam.net/">IS Atlas</a>
</text>
</g>

</svg>
