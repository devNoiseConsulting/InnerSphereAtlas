<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Product/Component Name:</th><th>Product/Component Type:</th></tr>
<?php
$query = "SELECT DISTINCT
*
FROM
product PC, product_type PT
WHERE
PC.factory_id=$factory AND
PC.product_type_id=PT.product_type_id
ORDER BY
PT.product_type_id, PT.product_type, PC.product_name";
$result_pc = mysql_query($query);
$num_pc = mysql_numrows($result_pc);
		
for ($j = 0; $j < $num_pc; $j++) {
	echo "<tr><td>";
	$val = mysql_result($result_pc, $j, "product_name");
	print_sp($val);
	echo "</td>";

	echo "<td><a href=\"./product-type-detail.php?searchvalue=",urlencode(mysql_result($result_pc,$j,"product_type_id")),"\">";
	$val = mysql_result($result_pc, $j, "component_type");
	print_sp($val);
	echo " (";
	$val = mysql_result($result_pc, $j, "product_type");
	print_sp($val);
	echo ")</a></td>";

	echo "</tr>\n";
}
mysql_free_result($result_pc);
?>
</table>
