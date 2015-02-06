<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "browsebyletter";
$whichfield = array_key_exists("whichfield", $_REQUEST) ? $_REQUEST["whichfield"] : "P.name";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "A";
$searchvalue = trim($searchvalue);
if (strlen($searchvalue) == 1) {
	$searchvalue = $searchvalue . "%";
} else if ($searchvalue{1} <> "%") {
	$searchvalue = "%" . $searchvalue . "%";
}

$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : null;
if (empty($found) || !is_numeric($found)) {
	$query = "SELECT
	COUNT(*) AS found
	FROM
	planet P
	WHERE ($whichfield LIKE :searchvalue)
	";

	$sth = $dbh->prepare($query);
	$sth->bindParam(':searchvalue', $searchvalue);
	$sth->execute();
	$productData = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	$found = $productData['found'] - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

$query = "SELECT
P.planet_id,
P.name,
P.x_coord,
P.y_coord,
P.factory,
P.fluff
FROM
planet P
WHERE
($whichfield LIKE :searchvalue)
ORDER BY P.name
LIMIT :start, :limit";

$sth = $dbh->prepare($query);
$sth->bindParam(':searchvalue', $searchvalue);
$sth->bindParam(':start', $start, PDO::PARAM_INT);
$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
$sth->execute();
$planets = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Name:</th><th>X Coord:</th><th>Y Coord:</th></tr>
<?php
/* Loop through each item */
for ($i =0 ;$i < count($planets); $i++) {
	echo "<tr><td><a href=\"./planet-detail.php?planet=",urlencode($planets[$i]['planet_id']),"\">";

	$val = $planets[$i]['name'];
	print_sp($val);
	echo "</a></td>";

	echo "<td align=\"right\">";
	$val = $planets[$i]['x_coord'];
	print_sp($val);
	echo "</td>";

	echo "<td align=\"right\">";
	$val = $planets[$i]['y_coord'];
	print_sp($val);
	echo "</td>";

	$factory = $planets[$i]['factory'];
	$fluff = $planets[$i]['fluff'];
	if ($factory || $fluff) {
		echo "<td align=\"center\"><a href=\"./planet-detail.php?planet=",urlencode($planets[$i]['planet_id']),"\">";

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
