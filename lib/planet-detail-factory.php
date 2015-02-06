<h2>Factories:</h2>
<?php

	// Planet's Factory Info
	$query = "SELECT DISTINCT
	F.factory_id, F.name, P.name AS planet_name
	FROM factory F, planet P
	WHERE
	P.planet_id=$planet AND
	F.planet_id = P.planet_id";
	//echo "$query <p>\n";
	$result_f = mysql_query($query);
	$num_f = mysql_numrows($result_f);

	if ($num_f != 0) {
?>
<ul>
<?php
		for ($i = 0; $i < $num_f; $i++) {
			echo "<li><a href=\"./factory-detail.php?factory=",urlencode(mysql_result($result_f,$i,"factory_id")),"\">";
			$val = mysql_result($result_f, $i, "name");
			print_sp($val);
			echo "</a></li>\n";
		}
?>
</ul>
<?php
	} else {
?>
There are no functional factories located on this planet.
<?php
	}
	mysql_free_result($result_f);
?>
	

