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
F.factory_id=$factory AND
F.planet_id = P.planet_id";
//echo "$query <P>\n";
$result_f = mysql_query($query);
$num_f = mysql_numrows($result_f);

if ($num_f != 0) {
	echo "<h2><b>Factory:</b> ";
	$val = mysql_result($result_f, 0, "name");
	print_sp($val);
	echo "</h2>\n";

	echo "<b>Planet:</b> <a href=\"./planet-detail.php?planet=",urlencode(mysql_result($result_f,0,"planet_id")),"\">";
	$val = mysql_result($result_f, 0, "planet_name");
	print_sp($val);
	echo "</a> (";
	
	$val = mysql_result($result_f, 0, "x_coord");
	print_sp($val);
	echo ", ";
	
	$val = mysql_result($result_f, 0, "y_coord");
	print_sp($val);
	echo ")<br/><br/>\n";
	
	include("$ISA_LIBDIR/product_component.php");
}
mysql_free_result($result_f);

?>
