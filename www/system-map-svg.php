<?php
include("./isatlas-config.php");
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

$planet = $_REQUEST["planet"];
if (empty($planet) || !is_numeric($planet)) { $planet = 2266787; }

$era = $_REQUEST["era"];
if (empty($era) || !is_numeric($era)) { $era = 3062; }
$era = preg_replace("/(2575|2750|30(25|30|40|52|57|62))/", "era_\\1", $era);

$query = "
SELECT P.planet_id,
       P.name,
       P.x_coord,
       P.y_coord,
       F.color1_r,
       F.color1_g,
       F.color1_b
  FROM planet P,
       faction F, 
       " . $era . " E
 WHERE P.planet_id = " . $planet . "
   AND P.planet_id=E.planet_id
   AND E.faction_id=F.faction_id
";

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


	$query = "
SELECT P.x_coord,
       P.y_coord
  FROM jump_points J,
       planet P
 WHERE J.planet_id = " . $planet_id . "
   AND J.jump_id = P.planet_id
 ORDER BY P.x_coord, P.y_coord
	";
	
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	$ringSize = 30 * $ISA_MAP_SCALE - 0.5;
?>
<defs>
<radialGradient id="jumpradial">
<stop offset="0%" style="stop-color:White;" />
<stop offset="100%" style="stop-color:rgb(<?php echo($rgb); ?>);">
<animate attributeName="offset" from="0%" to="100%" dur="10s" repeatCount="indefinite"/>
</stop>
</radialGradient>
</defs>
<rect x="1" y="0.5" width="<?php echo($ISA_MAP_SIZE - 1); ?>" height="<?php echo($ISA_MAP_SIZE - 1); ?>" fill="whitesmoke" />
<circle cx="<?php echo($ISA_MAP_OFFSET); ?>" cy="<?php echo($ISA_MAP_OFFSET); ?>" r="<?php echo($ringSize); ?>" stroke="black" stroke-width="1" stroke-dasharray="15" opacity="0.5" fill="url(#jumpradial)" />
<g stroke="black" stroke-width="0.5" stroke-dasharray="3" opacity="0.33" fill="none">
<?php
	/* Loop through each item */
	for ($i=0; $i < $num; $i++) {
	
		$x_coord = (mysql_result($result, $i, "x_coord") - $x) * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		$y_coord = (mysql_result($result, $i, "y_coord") - $y) * -1 * $ISA_MAP_SCALE + $ISA_MAP_OFFSET;
		
		echo '<line x1="' . $ISA_MAP_OFFSET . '" y1="' . $ISA_MAP_OFFSET;
		echo '" x2="' . $x_coord . '" y2="' . $y_coord;
		echo '" />' . "\n";
	}
	mysql_free_result($result);
	echo '</g>' . "\n\n";

	$query = "
SELECT P.planet_id,
       P.name,
       P.x_coord,
       P.y_coord,
       F.color1_r,
       F.color1_g,
       F.color1_b,
       E.capital
  FROM planet P,
       faction F,
       " . $era . " E
 WHERE (P.x_coord > " . ($x - 60) . " AND P.x_coord < " . ($x + 60) . ")
   AND (P.y_coord > " . ($y - 60) . " AND P.y_coord < " . ($y + 60) . ")
   AND P.planet_id = E.planet_id
   AND E.faction_id = F.faction_id
 ORDER BY P.x_coord, P.y_coord
		";
	
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
	mysql_free_result($result);
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
