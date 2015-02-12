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
$publisherData = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

foreach ($publisherData as $key => $novelPrinting) {
	$publisherData[$key]['asin'] = preg_replace("/-/", "", $novelPrinting['isbn']);
	$imageFile = "/images/" . $novelPrinting['isbn'] . "-med.jpg";
	if (file_exists($ISA_DOCROOTDIR . $imageFile)) {
		$publisherData[$key]['thumbnail'] = $imageFile; 
		$publisherData[$key]['imageLink'] = "/images/" . $novelPrinting['isbn'] . ".jpg";
	}
}