<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "search";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "12000";
$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$query = "SELECT 
COUNT(PT.product_type_id) AS found, 
PT.component_type, 
PT.product_type 
FROM 
product PC, 
product_type PT
WHERE
(PT.product_type_id = :searchvalue) AND 
PC.product_type_id=PT.product_type_id 
GROUP BY 
PT.product_type_id
";
//echo "$query<P>\n";

$sth = $dbh->prepare($query);
$sth->bindParam(':searchvalue', $searchvalue);
$sth->execute();
$product = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;

$found = $product['found'] - 1;

//echo "<b>Product/Component Type:</b> ";
echo "<h2>";
$val = $product['component_type'];
print_sp($val);
echo " (";
$val = $product['product_type'];
print_sp($val);
echo ")</h2>\n";

$query = "SELECT DISTINCT
PC.product_name,
F.factory_id,
F.name AS factory_name,
P.planet_id,
P.name AS planet_name
FROM
product PC,
product_type PT,
factory F,
planet P
WHERE
PT.product_type_id = :searchvalue AND
PC.product_type_id = PT.product_type_id AND
PC.factory_id = F.factory_id AND
F.planet_id = P.planet_id
ORDER BY 
PC.product_name, 
F.name, P.name
LIMIT :start, :limit
";
//echo "$query <p>\n";

$sth = $dbh->prepare($query);
$sth->bindParam(':searchvalue', $searchvalue);
$sth->bindParam(':start', $start, PDO::PARAM_INT);
$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
$sth->execute();
$products = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

include("$ISA_LIBDIR/next_prev.php"); 
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Product/Component Name:</th><th>Factory:</th><th>Planet:</th></tr>
<?php
/* Loop through each item */
for ($i = 0; $i < count($products); $i++) {
	echo "<tr><td>";
	$val = $products[$i]['product_name'];
	print_sp($val);
	echo "</td>";

	echo "<td><a href=\"./factory-detail.php?factory=",urlencode($products[$i]['factory_id']),"\">";
	$val = $products[$i]['factory_name'];
	print_sp($val);
	echo "</a></td>";

	echo "<td><a href=\"./planet-detail.php?planet=",urlencode($products[$i]['planet_id']),"\">";
	$val = $products[$i]['planet_name'];
	print_sp($val);
	echo "</a></td>";

	echo "</tr>\n";
}

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
