<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Product/Component Name:</th><th>Product/Component Type:</th></tr>
<?php
$query = "SELECT DISTINCT
*
FROM
product PC, product_type PT
WHERE
PC.factory_id=:factory AND
PC.product_type_id=PT.product_type_id
ORDER BY
PT.product_type_id, PT.product_type, PC.product_name";

$sth = $dbh->prepare($query);
$sth->execute(array(':factory' => $factory));
$components = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

for ($j = 0; $j < count($components); $j++) {
	echo "<tr><td>";
	$val = $components[$j]['product_name'];
	print_sp($val);
	echo "</td>";

	echo "<td><a href=\"./product-type-detail.php?searchvalue=",urlencode($components[$j]['product_type_id']),"\">";
	$val = $components[$j]['component_type'];
	print_sp($val);
	echo " (";
	$val = $components[$j]['product_type'];
	print_sp($val);
	echo ")</a></td>";

	echo "</tr>\n";
}
?>
</table>
