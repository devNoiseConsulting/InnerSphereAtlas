<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");
?>
<?php
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

$era = $_REQUEST["era"];
if (empty($era) || !is_numeric($era)) { $era = 3062; }
$era = preg_replace("/(2575|2750|30(25|30|40|52|57|62))/", "\\1", $era);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Inner Sphere Atlas: System</title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/reset-fonts-grids/reset-fonts-grids.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/base/base-min.css">
	<link rel="stylesheet" type="text/css" href="./style/isatlas.css" media="screen" />
</head>
<body>
<div id="doc2" class="yui-t7">
	<div id="hd"><h1><a href="./">IS Atlas</a> / <a href="./planet.php">System</a> / Starmaps</h1></div>
	<div id="bd">
		<div class="yui-g">
			<div class="yui-u first">
			<b>System Name: </b><?php echo $name; ?></b><br/>
			<b>Coordinates: </b><?php echo $x . ", " . $y; ?><br />
						</div>
			<div class="yui-u">
			<?php 
			$eraMaps = "";
			$eras = array(2575, 2750, 3025, 3030, 3040, 3052, 3057, 3062);
			for ($i = 0; $i < 8; $i++) {
				if ($era == $eras[$i]) {
					$eraMaps .= "$eras[$i] | ";
				} else {
					$eraMaps .= "<a href=\"./system-map.php?planet=" . urlencode($planet) . "&amp;era="
								. $eras[$i] . "\">" . $eras[$i] . "</a> | ";
				}
			}
			$eraMaps = rtrim($eraMaps, " |");
			echo "$eraMaps\n";
			?>
			</div>
		</div>
		<div class="yui-g">
			<p>
			<?php
			$svg_url = "./system-map-svg.php?planet=" . urlencode($planet) . "&amp;era=" . $era;
			?>
			</p>
			<embed src="<?php echo $svg_url; ?>" width="840" height="840" type="image/svg+xml" pluginspage="http://www.adobe.com/svg/viewer/install/" />
			<p>This page makes use of <a href="http://www.w3.org/TR/SVG/">SVG</a>. You may need a plug-in for your browser to render this image.</p>
		</div>
	</div>
	<div id="ft"><?php include("$ISA_DOCROOTDIR/cya.php"); ?></div>
</div>
</body>
</html>