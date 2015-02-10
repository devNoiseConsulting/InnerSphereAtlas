<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$query = "SELECT * FROM planet WHERE planet_id=:planet";
$sth = $dbh->prepare($query);
$sth->execute(array(':planet' => $planet));
$planetData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;

if ($planetData) {

	echo "<div style=\"float: left; width: 50%; margin: 0 10px 0 0; padding: 5px; background-image: url(./images/gray_transparency.png); \">\n";
	
	echo "<b>System Name: </b>";
	$val = $planetData["name"];
	print_sp($val);
	echo "<br />\n";

	echo "<b>Coordinates:</b> ";
	$x = $planetData["x_coord"];
	print_sp($x);
	echo ", ";

	$y = $planetData["y_coord"];
	print_sp($y);
	echo "<br />\n";

	$val = $planetData["star_type"];
	if ($val) {
		echo "<b>Star Type:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = $planetData["position"];
	if ($val) {
		echo "<b>Position in System:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = $planetData["travel_time"];
	if ($val) {
		echo "<b>Time to Jump Point:</b> ";
		print_sp($val);
		echo " days<br />\n";
	}

	$val = $planetData["recharging_station"];
	if ($val) {
		echo "<b>Recharging Station:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = $planetData["comstar_facility"];
	if ($val) {
		echo "<b>ComStar Facility Class:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = $planetData["population"];
	if ($val) {
		echo "<b>Population:</b> ";
		print_sp(number_format($val));
		echo "<br />\n";
	}

	$val = $planetData["native_life"];
	if ($val) {
		echo "<b>Percentage and Level of Native Life:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	echo "</div>\n";
	
	$val = $planetData["description"];
	if ($val) {
		echo "<h2>Description:</h2>\n<blockquote>\n";
		print_sp($val);
		echo "\n</blockquote><br />\n";
	}

	$name = $planetData["name"];
}
?>
