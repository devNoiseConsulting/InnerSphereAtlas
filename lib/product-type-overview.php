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
if (empty($whichfield)) { $whichfield = "PT.product_type"; }
$searchvalue = $_REQUEST["searchvalue"];
if (empty($searchvalue)) { $searchvalue = "Dropships"; }
$start = $_REQUEST["start"];
if (empty($start) || !is_numeric($start)) { $start = 0; }
$limit = $_REQUEST["limit"];
if (empty($limit) || !is_numeric($limit)) { $limit = 25; }

$found = $_REQUEST["found"];
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$query = "SELECT COUNT(DISTINCT $whichfield) FROM product_type PT, product PC WHERE ($whichfield LIKE '%" . $searchvalue . "%' OR PT.component_type LIKE '%" . $searchvalue . "%' OR PC.product_name LIKE '%" . $searchvalue . "%') AND PT.product_type_id=PC.product_type_id";
		//echo "$query<P>\n";
		$result = mysql_query($query);
	} else {
		$query = "SELECT COUNT(DISTINCT $whichfield) FROM product_type PT, product PC WHERE PT.product_type_id=PC.product_type_id";
		//echo "$query<p>\n";
		$result = mysql_query($query);
	}
	$found = mysql_result($result,0,0) - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

if (isset($func) && $func == "search") {
	$query = "SELECT DISTINCT
	PT.product_type_id, PT.component_type, PT.product_type
	FROM
	product_type PT, product PC
	WHERE
	($whichfield LIKE '%" . $searchvalue . "%' OR
	PT.component_type LIKE '%" . $searchvalue . "%' OR
	PC.product_name LIKE '%" . $searchvalue . "%') AND
	PT.product_type_id=PC.product_type_id
	ORDER BY PT.product_type_id, PT.product_type
	LIMIT $start,$limit";
} else {
	$query = "SELECT DISTINCT
	PT.product_type_id, PT.component_type, PT.product_type
	FROM
	product_type PT, product PC
	WHERE
	PT.product_type_id=PC.product_type_id
	ORDER BY PT.product_type_id, PT.product_type
	LIMIT $start,$limit";
}

$result = mysql_query($query);
$num = mysql_numrows($result);
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Product/Component Type:</th></tr>
<?php
/* Loop through each item */
for ($i =0 ;$i < $num; $i++) {
	echo "<tr><td><a href=\"./product-type-detail.php?searchvalue=",urlencode(mysql_result($result,$i,"product_type_id")),"\">";
	$val = mysql_result($result, $i, "component_type");
	print_sp($val);
	echo " (";
	$val = mysql_result($result, $i, "product_type");
	print_sp($val);
	echo ")</a></td>";

	echo "</tr>\n";
}
mysql_free_result($result);

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
