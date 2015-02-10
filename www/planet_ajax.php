<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");

$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "A";
$searchvalue = trim($searchvalue);
if (strlen($searchvalue) == 1) {
	$searchvalue = $searchvalue . "%";
} else if ($searchvalue{1} <> "%") {
	$searchvalue = "%" . $searchvalue . "%";
}

$query = "SELECT DISTINCT
P.planet_id,
P.name,
P.x_coord,
P.y_coord
FROM
planet P
WHERE
P.name LIKE :searchvalue
ORDER BY
P.name
";

echo "<ul>\n";
$sth = $dbh->prepare($query);
$sth->bindParam(':searchvalue', $searchvalue);
$sth->execute();
$planetList = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

$num = count($planetList);
if ($num > 0) {
	if ($num > 15) { $num = 15; }
	for ($i=0; $i < $num; $i++) {
		$name = $planetList[$i]['name'];
		$x = $planetList[$i]['x_coord'];
		$y = $planetList[$i]['y_coord'];
	
		echo "<li>" . $name . "<br/><span class=\"informal\"> (" . $x . ", " . $y . ")<br/></span></li>\n";
	}
	
}
echo "</ul>\n";
	
?>