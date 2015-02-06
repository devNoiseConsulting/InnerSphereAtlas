<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");

header("Content-type: image/svg+xml");

//mark this as XML
print('<?xml version="1.0" encoding="utf-8" ?>' . "\n");
?>
<!-- <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd"> -->
<!-- <svg height="8.5in" width="8.5in" viewBox="0 0 <?php echo($ISA_MAP_SIZE . ' ' . $ISA_MAP_SIZE); ?>" preserveAspectRatio="xMinYMin" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20001102//EN" "http://www.w3.org/TR/2000/CR-SVG-20001102/DTD/svg-20001102.dtd">
<svg width="<?php echo($ISA_MAP_SIZE); ?>" height="<?php echo($ISA_MAP_SIZE); ?>" viewBox="0 0 <?php echo($ISA_MAP_SIZE . ' ' . $ISA_MAP_SIZE); ?>" xml:space="preserve">

<?php

$planet = $_REQUEST["planet"];
if (empty($planet) || !is_numeric($planet)) { $planet = 2266787; }

$era = $_REQUEST["era"];
if (empty($era) || !is_numeric($era)) { $era = 3062; }
$era = preg_replace("/(2575|2750|30(25|30|40|52|57|62))/", "era_\\1", $era);

$query = "SELECT P.planet_id, P.name, P.x_coord, P.y_coord, F.color1_r,
	F.color1_g, F.color1_b FROM planet P, faction F, " . $era . " E
	WHERE P.planet_id = " . $planet . " AND P.planet_id=E.planet_id AND
	E.faction_id=F.faction_id";

$result = mysql_query($query);
$num = mysql_numrows($result);

if ($num > 0) {
	$name = mysql_result($result, 0, "name");
	$planet_id = mysql_result($result, 0, "planet_id");
	$x = mysql_result($result, 0, "x_coord");
	$y = mysql_result($result, 0, "y_coord");
	$red = mysql_result($result, $i, "color1_r");
	$green = mysql_result($result, $i, "color1_g");
	$blue = mysql_result($result, $i, "color1_b");
	$rgb = 	$red . "," . $green . "," .$blue;


	$query = "SELECT P1.x_coord AS P1x, P1.y_coord AS P1y, P2.x_coord AS
		P2x, P2.y_coord AS P2y FROM jump_points J1, jump_points J2,
		planet P1, planet P2 WHERE J1.planet_id = " . $planet_id . " AND
		J1.jump_id = P1.planet_id AND J1.jump_id = J2.planet_id AND
		J2.jump_id = P2.planet_id ORDER BY P1.x_coord, P1.y_coord,
		P2.x_coord, P2.y_coord";
	
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	$ringSize = 30 * $ISA_MAP_SCALE - 0.5;
?>
<defs>
<radialGradient id="jumpradial">
<stop offset="0" style="stop-color:rgb(<?php echo($rgb); ?>);"/>
<stop offset="100%" style="stop-color:White;">
<animate attributeName="offset" from="1%" to="100%" dur="10s" repeatCount="indefinite"/>
</stop>
</radialGradient>
</defs>
<circle cx="<?php echo($ISA_MAP_OFFSET); ?>" cy="<?php echo($ISA_MAP_OFFSET); ?>" r="<?php echo($ringSize); ?>" stroke="grey" stroke-width="1" stroke-dasharray="15" opacity="0.75" fill="url(#jumpradial);" />
<g stroke="black" stroke-width="0.5" opacity="0.25" fill="none">
<?php
	/* Loop through each item */
	for ($i=0; $i < $num; $i++) {
	
		$x1_coord = (mysql_result($result, $i, "P1x") - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$y1_coord = (mysql_result($result, $i, "P1y") - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$x2_coord = (mysql_result($result, $i, "P2x") - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$y2_coord = (mysql_result($result, $i, "P2y") - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
	
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
	mysql_free_result($result);
	echo '</g>' . "\n\n";

	$query = "SELECT P.planet_id, P.name, P.x_coord, P.y_coord, F.color1_r,
		F.color1_g, F.color1_b, E.capital FROM planet P, faction F, " . $era . " E
		WHERE (P.x_coord > " . ($x - 60) . " AND P.x_coord < " . ($x + 60) . ") AND
		(P.y_coord > " . ($y - 60) . " AND P.y_coord < " . ($y + 60) . ") AND
		P.planet_id = E.planet_id AND E.faction_id = F.faction_id ORDER BY
		P.x_coord, P.y_coord";
	
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	
	$font_size = $ISA_MAP_PLANET_DIAMETER * 1.5;
	echo '<g font-family="Helvetica" font-size="' . $font_size . '" >' . "\n";
	/* Loop through each item */
	for ($i=0; $i < $num; $i++) {
		$name = mysql_result($result, $i, "name");
		$planet_id = mysql_result($result, $i, "planet_id");
	
		$x_coord = (mysql_result($result, $i, "x_coord") - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$y_coord = (mysql_result($result, $i, "y_coord") - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
	
		$red = mysql_result($result, $i, "color1_r");
		$green = mysql_result($result, $i, "color1_g");
		$blue = mysql_result($result, $i, "color1_b");
		$color = 'rgb(' . $red . ',' . $green . ',' . $blue . ')';
		
		$capital = mysql_result($result, $i, "capital");
	
		$x_title = $x_coord - $ISA_MAP_TITLE_OFFSET + 1;
		$y_title = $y_coord + $font_size + 2;
		
		echo '<a xlink:href="./planet-detail.php?planet=' . $planet_id . '" xlink:alt="' . $name . '">' . "\n";
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
	mysql_free_result($result);
	echo '</g>' . "\n\n";
}
$font_size = $ISA_MAP_PLANET_DIAMETER * 3;
$x_coord = $ISA_MAP_PLANET_RADIUS;
$y_coord = $ISA_MAP_SIZE - $ISA_MAP_PLANET_DIAMETER;

?>
<g stroke="black" stroke-width="1" opacity="0.5" >
<rect x="0" y="0" width="<?php echo($ISA_MAP_SIZE); ?>" height="<?php echo($ISA_MAP_SIZE); ?>" fill="none" />
<text font-family="Helvetica" font-size="<?php echo($font_size); ?>"  x="<?php echo($x_coord); ?>" y="<?php echo($y_coord); ?>">
<a xlink:href="http://isatlas.teamspam.net/">IS Atlas</a>
</text>
</g>

<?php
$padding = 2 * $ISA_MAP_PLANET_DIAMETER;
$width = (30 * $ISA_MAP_SCALE) + $padding;
$height = (5 * $ISA_MAP_SCALE) + $font_size + $padding;
$x_coord = $ISA_MAP_SIZE - $ISA_MAP_PLANET_DIAMETER - $width;
$y_coord = $ISA_MAP_SIZE - $ISA_MAP_PLANET_DIAMETER - $height;

?>
<g stroke="black" stroke-width="0.5" opacity="1" fill="white">
<rect x="<?php echo($x_coord); ?>" y="<?php echo($y_coord); ?>" width="<?php echo($width); ?>" height="<?php echo($height); ?>" fill="white" />

<line x1="317.73" y1="303.17" x2="420" y2="420" />
</g>
<set xlink:href="#jump_limit" attributeName="fill" to="url(#mygradient3)" begin="start.begin+15s" repeatCount="1" fill="freeze"/>

</svg>
