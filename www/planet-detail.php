<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");

$planet = $_REQUEST["planet"];
if (empty($planet) || !is_numeric($planet)) { $planet = 2266787; }
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
<div id="doc2" class="yui-t4">
	<div id="hd">
		<h1><a href="./">IS Atlas</a> / <a href="./planet.php">System</a> / Detail</h1>
	</div>
	<div id="bd">
		<div id="yui-main">
			<div class="yui-b">
				<div class="yui-g">
					<?php include("$ISA_LIBDIR/planet-detail.php"); ?>
				</div>
				<div class="yui-g">
					<div class="yui-u first">
						<?php include("$ISA_LIBDIR/planet-detail-ownership.php"); ?>
					</div>
					<div class="yui-u">
						<?php
							echo "<a name=\"map\" /><h2>Starmap of Surrounding Systems:</h2>\n";
							$eraMaps = "";
							$eras = array(2575, 2750, 3025, 3030, 3040, 3052, 3057, 3062);
							for ($i = 0; $i < 8; $i++) {
								$eraMaps .= "<a href=\"./system-map.php?planet=". urlencode($planet) . "&amp;era=" . $eras[$i] . "\">" . $eras[$i] . "</a> | ";
							}
							$eraMaps = rtrim($eraMaps, " |");
							echo "$eraMaps\n";
						?>
						<br/><br/>
						<?php include("$ISA_LIBDIR/planet-detail-factory.php"); ?>
					</div>
				</div>
				<div class="yui-g">
					<div class="yui-u first">
						<?php include("$ISA_LIBDIR/planet-detail-neighbors.php"); ?>
					</div>
					<div class="yui-u">
						<?php include("$ISA_LIBDIR/planet-detail-novels.php"); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="yui-b">
			<?php include("$ISA_DOCROOTDIR/adsense.php"); ?>
		</div>
	</div>
	<div id="ft">
		<?php include("$ISA_DOCROOTDIR/cya.php"); ?>
	</div>
</div>
</body>
</html>