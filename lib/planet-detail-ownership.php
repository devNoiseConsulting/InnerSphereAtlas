<h2>System Owner / Occupation:</h2>
<?php
	// Planet's Ownership
	$query = "SELECT
	E2575.faction AS E2575,
	E2750.faction AS E2750,
	E3025.faction AS E3025,
	E3030.faction AS E3030,
	E3040.faction AS E3040,
	E3052.faction AS E3052,
	E3057.faction AS E3057,
	E3062.faction AS E3062
	FROM
	planet P, era_2575 E2575, era_2750 E2750, era_3025 E3025, era_3030
	E3030, era_3040 E3040, era_3052 E3052, era_3057 E3057, era_3062
	E3062
	WHERE
	P.planet_id = :planet AND
	P.planet_id = E2575.planet_id AND
	P.planet_id = E2750.planet_id AND
	P.planet_id = E3025.planet_id AND
	P.planet_id = E3030.planet_id AND
	P.planet_id = E3040.planet_id AND
	P.planet_id = E3052.planet_id AND
	P.planet_id = E3057.planet_id AND
	P.planet_id = E3062.planet_id";
	//echo "$query <p>\n";

	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$eraOwnership = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	if ($eraOwnership) {
?>
<table>
<tr><th>Era:</th><th>Faction:</th></tr>

<?php
	$eras = array(2575, 2750, 3025, 3030, 3040, 3052, 3057, 3062);
	for ($i = 0; $i < 8; $i++) {
		echo "<tr><td>$eras[$i]</td><td>";
		$val = $eraOwnership['E'.$eras[$i]];
		print_sp($val);
		echo "</td></tr>";
	}
?>
</table><br />
<?php
	}
	
	
	// Planet's Ownership Dates
	$query = "SELECT
	*
	FROM
	faction F, owner_date O
	WHERE
	O.planet_id = :planet AND
	F.faction_id = O.faction_id
	ORDER BY O.occupation_date";
	//echo "$query <p>\n";
	
	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$ownerDates = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;

	if ($ownerDates) {
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Occupation Date:</th><th>Faction:</th></tr>
<?php
	for ($i = 0; $i < count($ownerDates); $i++) {
		echo "<tr><td>";
		$val = $ownerDates[$i]['occupation_date'];
		print_sp($val);
		echo "</td>";
		
		echo "<td>";
		$val = $ownerDates[$i]['name'];
		print_sp($val);
		echo "</td></tr>\n";
		
	}
?>
</table><br />
<?php
	}
?>