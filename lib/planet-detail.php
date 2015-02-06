<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$query = "SELECT * FROM planet WHERE planet_id=$planet";
//echo "$query <p>\n";
$result_p = mysql_query($query);
$num_p = mysql_numrows($result_p);

if ($num_p != 0) {

	echo "<div style=\"float: left; width: 50%; margin: 0 10px 0 0; padding: 5px; background-image: url(./images/gray_transparency.png); \">\n";
	
	echo "<b>System Name: </b>";
	$val = mysql_result($result_p, $i, "name");
	print_sp($val);
	echo "<br />\n";

	echo "<b>Coordinates:</b> ";
	$x = mysql_result($result_p, $i, "x_coord");
	print_sp($x);
	echo ", ";

	$y = mysql_result($result_p, $i, "y_coord");
	print_sp($y);
	echo "<br />\n";

	$val = mysql_result($result_p, $i, "star_type");
	if ($val) {
		echo "<b>Star Type:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "position");
	if ($val) {
		echo "<b>Position in System:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "travel_time");
	if ($val) {
		echo "<b>Time to Jump Point:</b> ";
		print_sp($val);
		echo " days<br />\n";
	}

	$val = mysql_result($result_p, $i, "recharging_station");
	if ($val) {
		echo "<b>Recharging Station:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "comstar_facility");
	if ($val) {
		echo "<b>ComStar Facility Class:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "population");
	if ($val) {
		echo "<b>Population:</b> ";
		print_sp(number_format($val));
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "native_life");
	if ($val) {
		echo "<b>Percentage and Level of Native Life:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	echo "</div>\n";
	
	$val = mysql_result($result_p, $i, "description");
	if ($val) {
		echo "<h2>Description:</h2>\n<blockquote>\n";
		print_sp($val);
		echo "\n</blockquote><br />\n";
	}

	$name = mysql_result($result_p, 0, "name");
}
mysql_free_result($result_p);

?>
