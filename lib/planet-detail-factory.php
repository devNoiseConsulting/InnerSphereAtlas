<h2>Factories:</h2>
<?php

	// Planet's Factory Info
	$query = "SELECT DISTINCT
	F.factory_id, F.name, P.name AS planet_name
	FROM factory F, planet P
	WHERE
	P.planet_id=:planet AND
	F.planet_id = P.planet_id";
	//echo "$query <p>\n";

	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$factories = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;

	if ($factories) {
?>
<ul>
<?php
		for ($i = 0; $i < count($factories); $i++) {
			echo "<li><a href=\"./factory-detail.php?factory=",urlencode($factories[$i]['factory_id']),"\">";
			$val = $factories[$i]['name'];
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
?>
	

