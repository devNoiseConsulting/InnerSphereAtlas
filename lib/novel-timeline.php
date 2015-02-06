<?php

$query = "SELECT
NT.chapter_name,
NT.chapter_date,
P.planet_id,
P.name,
P.x_coord,
P.y_coord,
P.fluff,
P.factory
FROM
novel_timeline NT,
planet P
WHERE
NT.novel_id = :novel AND
NT.planet_id = P.planet_id
ORDER BY
NT.sort_order,
P.name
";

$sth = $dbh->prepare($query);
$sth->bindParam(':novel', $novel);
$sth->execute();
$timeline = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

if ($timeline) {
?>
<h2>Chapter Information:</h2>
<table border="1" cellspacing="0" cellpadding="5">
<tr>
<th>Chapter:</th>
<th>Date:</th>
<th>Planet:</th>
<th>X Coord:</th>
<th>Y Coord:</th>
</tr>
<?php
	/* Loop through each item */
	for ($i = 0 ;$i < count($timeline); $i++) {
		echo "<tr><td>";
		$val = $timeline[$i]['chapter_name'];
		print_sp($val);
		echo "</td>";
	
		echo "<td>";
		$val = $timeline[$i]['chapter_date'];
		print_sp($val);
		echo "</td>";
	
		echo "<td><a href=\"./planet-detail.php?planet=",urlencode($timeline[$i]['planet_id']),"\">";
		$val = $timeline[$i]['name'];
		print_sp($val);
		echo "</a></td>";
	
		echo "<td align=\"right\">";
		$val = $timeline[$i]['x_coord'];
		print_sp($val);
		echo "</td>";
	
		echo "<td align=\"right\">";
		$val = $timeline[$i]['y_coord'];
		print_sp($val);
		echo "</td>";
	
		$factory = $timeline[$i]['factory'];
		$fluff = $timeline[$i]['fluff'];
		if ($factory || $fluff) {
			echo "<td align=\"center\"><a href=\"./planet-detail.php?planet=",urlencode($timeline[$i]['planet_id']),"\">";
	
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
?>
</table><br />
<?php
	include("$ISA_DOCROOTDIR/legend.php");
}

?>
