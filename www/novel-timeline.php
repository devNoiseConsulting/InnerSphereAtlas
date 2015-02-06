<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Inner Sphere Atlas: Novels</title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/reset-fonts-grids/reset-fonts-grids.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/base/base-min.css">
	<link rel="stylesheet" type="text/css" href="./style/isatlas.css" media="screen" />
</head>
<body>
<div id="doc2" class="yui-t4">
	<div id="hd">
		<h1><a href="./">IS Atlas</a> / <a href="./novel.php">Novels</a> / Timeline</h1>
	</div>
	<div id="bd">
		<div id="yui-main">
			<div class="yui-b">
				<div class="yui-g">
					<?php
					include("$ISA_LIBDIR/novel-timeline-overview.php");
					?>
				</div>
			</div>
			</div>
		<div class="yui-b">
			<?php include("$ISA_DOCROOTDIR/adsense.php"); ?>
		</div>
	</div>
	<div id="ft"><? include("$ISA_DOCROOTDIR/cya.php"); ?></div>
</div>
</body>
</html>