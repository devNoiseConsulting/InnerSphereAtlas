<?php
$query = "SELECT
*
FROM
publisher
WHERE
novel_id = :novel
ORDER BY
print_year,
publisher
";
//echo "$query <p>\n";

$sth = $dbh->prepare($query);
$sth->bindParam(':novel', $novel);
$sth->execute();
$novelData = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

if ($novelData) {
?>
<h2>Publication Information:</h2>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Publisher:</th><th>Stock Number:</th><th>ISBN:</th><th>Year:</th><th>Price:</th><th>Cover:</th><th>Amazon.com:</th></tr>
<?php
	for ($i = 0; $i < count($novelData); $i++) {
		echo "<tr valign=\"top\"><td>";
		$val = $novelData[$i]['publisher'];
		print_sp($val);
		echo "</td>";
		
		echo "<td>";
		$val = $novelData[$i]['stock_id'];
		print_sp($val);
		echo "</td>";
		
		echo "<td>";
		$isbn = $novelData[$i]['isbn'];
		$asin = preg_replace("/-/", "", $isbn);
		print_sp($isbn);
		echo "</td>";

		echo "<td>";
		$val = $novelData[$i]['print_year'];
		print_sp($val);
		echo "</td>";

		echo "<td>$";
		$val = $novelData[$i]['price'];
		print_sp($val);
		echo "</td>";

		echo "<td align=\"center\">";
		$imageFile = $ISA_DOCROOTDIR . "/images/" . $isbn . "-med.jpg";
		if (file_exists($imageFile)) {
?>
<a href="./images/<?php echo $isbn; ?>.jpg"><img src="./images/<?php echo $isbn; ?>-med.jpg" alt="" height="140"></a><br />
<?php
		}
		echo "</td>";

		echo "<td>";
		$availability = $novelData[$i]['availability'];
		include("$ISA_LIBDIR/amazon-link.php");
		echo "</td></tr>\n";
	}
?>
</table>
<?php
}
?>
