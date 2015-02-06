<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = $_REQUEST["func"];
if (empty($func)) { $func = "search"; }
$searchvalue = $_REQUEST["searchvalue"];
if (empty($searchvalue)) { $searchvalue = 12000; }
$whichfield = $_REQUEST["whichfield"];
if (empty($whichfield)) { $whichfield = "PT.product_type_id"; }
$start = $_REQUEST["start"];
if (empty($start) || !is_numeric($start)) { $start = 0; }
$limit = $_REQUEST["limit"];
if (empty($limit) || !is_numeric($limit)) { $limit = 25; }

$query = "SELECT COUNT($whichfield) AS found, PT.component_type, PT.product_type FROM product PC, product_type PT WHERE ($whichfield = $searchvalue) AND PC.product_type_id=PT.product_type_id GROUP BY $whichfield";
//echo "$query<P>\n";
$result = mysql_query($query);
$found = mysql_result($result, 0, "found") - 1;

//echo "<b>Product/Component Type:</b> ";
echo "<h2>";
$val = mysql_result($result, 0, "component_type");
print_sp($val);
echo " (";
$val = mysql_result($result, 0, "product_type");
print_sp($val);
echo ")</h2>\n";

$query = "SELECT DISTINCT
PC.product_name, F.factory_id, F.name AS factory_name, P.planet_id,
P.name AS planet_name
FROM
product PC, product_type PT, factory F, planet P
WHERE
$whichfield = '$searchvalue' AND
PC.product_type_id=PT.product_type_id AND
PC.factory_id = F.factory_id AND
F.planet_id = P.planet_id
ORDER BY PC.product_name, F.name, P.name
LIMIT $start,$limit";
//echo "$query <p>\n";
$result_pt = mysql_query($query);
$num_pt = mysql_numrows($result_pt);

include("$ISA_LIBDIR/next_prev.php"); 
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Product/Component Name:</th><th>Factory:</th><th>Planet:</th></tr>
<?php
/* Loop through each item */
for ($i =0 ;$i < $num_pt; $i++) {
	echo "<tr><td>";
	$val = mysql_result($result_pt, $i, "product_name");
	print_sp($val);
	echo "</td>";

	echo "<td><a href=\"./factory-detail.php?factory=",urlencode(mysql_result($result_pt,$i,"factory_id")),"\">";
	$val = mysql_result($result_pt, $i, "factory_name");
	print_sp($val);
	echo "</a></td>";

	echo "<td><a href=\"./planet-detail.php?planet=",urlencode(mysql_result($result_pt,$i,"planet_id")),"\">";
	$val = mysql_result($result_pt, $i, "planet_name");
	print_sp($val);
	echo "</a></td>";

	echo "</tr>\n";
}
mysql_free_result($result_pt);

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
