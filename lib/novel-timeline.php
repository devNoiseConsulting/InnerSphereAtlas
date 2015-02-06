<?php

$query = "SELECT
NT.chapter_name, NT.chapter_date,
P.planet_id, P.name, P.x_coord, P.y_coord, P.fluff, P.factory
FROM
novel_timeline NT, planet P
WHERE NT.novel_id = " . $novel . "
AND NT.planet_id = P.planet_id
ORDER BY NT.sort_order, P.name";

$result = mysql_query($query);
$num = mysql_numrows($result);

if ($num != 0) {
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
	for ($i = 0 ;$i < $num; $i++) {
		echo "<tr><td>";
		$val = mysql_result($result, $i, "NT.chapter_name");
		print_sp($val);
		echo "</td>";
	
		echo "<td>";
		$val = mysql_result($result, $i, "NT.chapter_date");
		print_sp($val);
		echo "</td>";
	
		echo "<td><a href=\"./planet-detail.php?planet=",urlencode(mysql_result($result,$i,"planet_id")),"\">";
		$val = mysql_result($result, $i, "P.name");
		print_sp($val);
		echo "</a></td>";
	
		echo "<td align=\"right\">";
		$val = mysql_result($result, $i, "P.x_coord");
		print_sp($val);
		echo "</td>";
	
		echo "<td align=\"right\">";
		$val = mysql_result($result, $i, "P.y_coord");
		print_sp($val);
		echo "</td>";
	
		$factory = mysql_result($result, $i, "P.factory");
		$fluff = mysql_result($result, $i, "P.fluff");
		if ($factory || $fluff) {
			echo "<td align=\"center\"><a href=\"./planet-detail.php?planet=",urlencode(mysql_result($result,$i,"planet_id")),"\">";
	
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
mysql_free_result($result);

?>
