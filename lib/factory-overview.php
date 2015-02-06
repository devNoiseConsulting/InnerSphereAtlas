<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "browselist";
$whichfield = array_key_exists("whichfield", $_REQUEST) ? $_REQUEST["whichfield"] : "F.name";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "Majesty";
$searchvalue = '%' . trim($searchvalue) . '%';
$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : null;
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$query = "SELECT 
		COUNT(*) AS found
		FROM 
		planet P, 
		factory F 
		WHERE 
		F.name LIKE :searchvalue AND 
		P.planet_id = F.planet_id
		";
	} else {
		$query = "SELECT 
		COUNT(*) AS found
		FROM 
		planet P, 
		factory F 
		WHERE 
		P.planet_id = F.planet_id
		";
	}
	$sth = $dbh->prepare($query);
	if ($func == "search") {
		$sth->bindParam(':searchvalue', $searchvalue);
	}
	$sth->execute();
	$factoryData = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	$found = $factoryData['found'] - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

if ($func == "search") {
	$query = "SELECT
	F.factory_id,
	F.name,
	P.planet_id,
	P.name AS planet_name,
	P.x_coord,
	P.y_coord
	FROM
	planet P,
	factory F
	WHERE
	F.name LIKE :searchvalue AND 
	P.planet_id = F.planet_id
	ORDER BY F.name
	LIMIT :start, :limit
	";
} else {
	$query = "SELECT
	F.factory_id,
	F.name,
	P.planet_id,
	P.name AS planet_name,
	P.x_coord,
	P.y_coord
	FROM
	planet P,
	factory F
	WHERE
	P.planet_id = F.planet_id
	ORDER BY F.name
	LIMIT $start, $limit
	";
}

$sth = $dbh->prepare($query);
if ($func == "search") {
	$sth->bindParam(':searchvalue', $searchvalue);
}
$sth->execute();
$factories = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Name:</th><th>Planet:</th><th>X Coord:</th><th>Y Coord:</th></tr>
<?php
/* Loop through each item */
for ($i=0; $i < count($factories); $i++) {
		echo "<tr><td><a href=\"./factory-detail.php?factory=",urlencode($factories[$i]['factory_id']),"\">";

		$val = $factories[$i]['name'];
		print_sp($val);
		echo "</a></td>";

		echo "<td>";
		$val = $factories[$i]['planet_name'];
		print_sp($val);
		echo "</td>";

		echo "<td align=\"right\">";
		$val = $factories[$i]['x_coord'];
		print_sp($val);
		echo "</td>";

		echo "<td align=\"right\">";
		$val = $factories[$i]['y_coord'];
		print_sp($val);
		echo "</td>";

		echo "</tr>\n";
}

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
