<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = $_REQUEST["func"];
if (empty($func)) { $func = "browsebyletter"; }
$whichfield = $_REQUEST["whichfield"];
if (empty($whichfield)) { $whichfield = "P.name"; }
$searchvalue = $_REQUEST["searchvalue"];
if (empty($searchvalue)) { $searchvalue = "A"; }
$start = $_REQUEST["start"];
if (empty($start) || !is_numeric($start)) { $start = 0; }
$limit = $_REQUEST["limit"];
if (empty($limit) || !is_numeric($limit)) { $limit = 25; }

$searchvalue = $_REQUEST["searchvalue"];
if (strlen($searchvalue) == 1) {
	$searchvalue = $searchvalue . "%";
} else if ($searchvalue{1} <> "%") {
	$searchvalue = "%" . $searchvalue . "%";
}


$found = $_REQUEST["found"];
if (empty($found) || !is_numeric($found)) {
	$query = "SELECT COUNT(*) FROM planet P WHERE ($whichfield LIKE '" . $searchvalue . "') ORDER BY $whichfield";
	$result = mysql_query($query);
	$found = mysql_result($result,0,0) - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

$query = "SELECT
P.planet_id, P.name, P.x_coord, P.y_coord, P.factory, P.fluff
FROM
planet P
WHERE ($whichfield LIKE '" . $searchvalue . "')
ORDER BY P.name
LIMIT $start,$limit";

$result = mysql_query($query);
$num = mysql_numrows($result);
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Name:</th><th>X Coord:</th><th>Y Coord:</th></tr>
<?php
/* Loop through each item */
for ($i =0 ;$i < $num; $i++) {
	echo "<tr><td><a href=\"./planet-detail.php?planet=",urlencode(mysql_result($result,$i,"planet_id")),"\">";

	$val = mysql_result($result, $i, "name");
	print_sp($val);
	echo "</a></td>";

	echo "<td align=\"right\">";
	$val = mysql_result($result, $i, "x_coord");
	print_sp($val);
	echo "</td>";

	echo "<td align=\"right\">";
	$val = mysql_result($result, $i, "y_coord");
	print_sp($val);
	echo "</td>";

	$factory = mysql_result($result, $i, "factory");
	$fluff = mysql_result($result, $i, "fluff");
	if ($factory || $fluff) {
		echo "<td align=\"center\"><a href=\"./planet-detail.php?planet=",urlencode(mysql_result($result,$i,"planet_id")),"\">";

		if ($factory && $fluff) {
			echo "<img src=\"./images/fluff.gif\" alt=\"Description\" width=\"16\" height=\"16\" border=\"0\" /><img src=\"./images/factory.gif\" alt=\"Factory\" width=\"16\" height=\"16\" border=\"0\" />";

		} else if ($factory) {
			echo "<img src=\"./images/factory.gif\" alt=\"Factory\" width=\"16\" height=\"16\" border=\"0\" />";
		} else if ($fluff) {
			echo "<img src=\"./images/fluff.gif\" alt=\"Description\" width=\"16\" height=\"16\" border=\"0\" />";
		}
		echo "</a></td>";
	}

	echo "</tr>\n";
}
mysql_free_result($result);

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
