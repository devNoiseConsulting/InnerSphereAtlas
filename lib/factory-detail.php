<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$factory = $_REQUEST["factory"];
if (empty($factory) || !is_numeric($factory)) { $factory = 6253789; }

$query = "SELECT DISTINCT
F.factory_id, F.name, P.planet_id, P.name AS planet_name, P.x_coord, P.y_coord
FROM
factory F, planet P
WHERE
F.factory_id=:factory AND
F.planet_id = P.planet_id";
//echo "$query <P>\n";

$sth = $dbh->prepare($query);
$sth->execute(array(':factory' => $factory));
$factoryData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;

if ($factoryData) {
	echo "<h2><b>Factory:</b> ";
	$val = $factoryData['name'];
	print_sp($val);
	echo "</h2>\n";

	echo "<b>Planet:</b> <a href=\"./planet-detail.php?planet=",urlencode($factoryData['planet_id']),"\">";
	$val = $factoryData['planet_name'];
	print_sp($val);
	echo "</a> (";
	
	$val = $factoryData['x_coord'];
	print_sp($val);
	echo ", ";
	
	$val = $factoryData['y_coord'];
	print_sp($val);
	echo ")<br/><br/>\n";
	
	include("$ISA_LIBDIR/product_component.php");
}

?>
