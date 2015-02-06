<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "browselist";
$whichfield = array_key_exists("whichfield", $_REQUEST) ? $_REQUEST["whichfield"] : "PT.product_type";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "Dropships";
$searchvalue = '%' . trim($searchvalue) . '%';
$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : null;
if (empty($found) || !is_numeric($found)) {
	if ($func == "search") {
		$query = "SELECT 
		COUNT(DISTINCT PT.product_type) AS found
		FROM 
		product_type PT, 
		product PC 
		WHERE 
		(PT.product_type LIKE :searchvalue OR 
		PT.component_type LIKE :searchvalue) AND 
		PT.product_type_id=PC.product_type_id
		";
		//echo "$query<P>\n";
	} else {
		$query = "SELECT 
		COUNT(DISTINCT PT.product_type) AS found
		FROM 
		product_type PT, 
		product PC 
		WHERE 
		PT.product_type_id=PC.product_type_id
		";
		//echo "$query<p>\n";
	}
	$sth = $dbh->prepare($query);
	if ($func == "search") {
		$sth->bindParam(':searchvalue', $searchvalue);
	}
	$sth->execute();
	$productData = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	$found = $productData['found'] - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

if ($func == "search") {
	$query = "SELECT DISTINCT
	PT.product_type_id, 
	PT.component_type, 
	PT.product_type
	FROM
	product_type PT,
	product PC
	WHERE
	(PT.product_type LIKE :searchvalue OR
	PT.component_type LIKE :searchvalue) AND
	PT.product_type_id=PC.product_type_id
	ORDER BY 
	PT.component_type, 
	PT.product_type
	LIMIT $start,$limit";
} else {
	$query = "SELECT DISTINCT
	PT.product_type_id, 
	PT.component_type, 
	PT.product_type
	FROM
	product_type PT,
	product PC
	WHERE
	PT.product_type_id=PC.product_type_id
	ORDER BY 
	PT.component_type, 
	PT.product_type
	LIMIT $start,$limit";
}

$sth = $dbh->prepare($query);
if ($func == "search") {
	$sth->bindParam(':searchvalue', $searchvalue);
}
$sth->execute();
$products = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Product/Component Type:</th></tr>
<?php
/* Loop through each item */
for ($i = 0; $i < count($products); $i++) {
	echo "<tr><td><a href=\"./product-type-detail.php?searchvalue=",urlencode($products[$i]['product_type_id']),"\">";
	$val = $products[$i]['component_type'];
	print_sp($val);
	echo " (";
	$val = $products[$i]['product_type'];
	print_sp($val);
	echo ")</a></td>";

	echo "</tr>\n";
}

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
