<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = $_REQUEST["func"];
if (empty($func)) { $func = "browselist"; }
$whichfield = $_REQUEST["whichfield"];
if (empty($whichfield)) { $whichfield = "F.name"; }
$searchvalue = $_REQUEST["searchvalue"];
if (empty($searchvalue)) { $searchvalue = "Majesty"; }
$start = $_REQUEST["start"];
if (empty($start) || !is_numeric($start)) { $start = 0; }
$limit = $_REQUEST["limit"];
if (empty($limit) || !is_numeric($limit)) { $limit = 25; }

$found = $_REQUEST["found"];
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$result = mysql_query("SELECT COUNT(*) FROM planet P, factory F WHERE $whichfield LIKE '%" . $searchvalue . "%' AND P.planet_id = F.planet_id");
	} else {
		$result = mysql_query("SELECT COUNT(*) FROM planet P, factory F WHERE P.planet_id = F.planet_id");
	}
	$found = mysql_result($result,0,0) - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

if (isset($func) && $func == "search") {
	$query = "SELECT
	F.factory_id, F.name, P.planet_id, P.name AS planet_name, P.x_coord, P.y_coord
	FROM
	planet P, factory F
	WHERE
	$whichfield LIKE '%" . $searchvalue . "%' AND
	P.planet_id = F.planet_id
	ORDER BY F.name
	LIMIT $start,$limit";
} else {
	$query = "SELECT
	F.factory_id, F.name, P.planet_id, P.name AS planet_name, P.x_coord, P.y_coord
	FROM
	planet P, factory F
	WHERE
	P.planet_id = F.planet_id
	ORDER BY F.name
	LIMIT $start,$limit";
}

$result = mysql_query($query);
$num = mysql_numrows($result);
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Name:</th><th>Planet:</th><th>X Coord:</th><th>Y Coord:</th></tr>
<?php
/* Loop through each item */
for ($i=0; $i < $num; $i++) {
		echo "<tr><td><a href=\"./factory-detail.php?factory=",urlencode(mysql_result($result,$i,"factory_id")),"\">";

		$val = mysql_result($result, $i, "name");
		print_sp($val);
		echo "</a></td>";

		echo "<td>";
		$val = mysql_result($result, $i, "planet_name");
		print_sp($val);
		echo "</td>";

		echo "<td align=\"right\">";
		$val = mysql_result($result, $i, "x_coord");
		print_sp($val);
		echo "</td>";

		echo "<td align=\"right\">";
		$val = mysql_result($result, $i, "y_coord");
		print_sp($val);
		echo "</td>";

		echo "</tr>\n";
}
mysql_free_result($result);

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
