<h2>System Owner / Occupation:</h2>
<?php
	// Planet's Ownership
	$query = "SELECT
	*
	FROM
	planet P, era_2575 E2575, era_2750 E2750, era_3025 E3025, era_3030
	E3030, era_3040 E3040, era_3052 E3052, era_3057 E3057, era_3062
	E3062
	WHERE
	P.planet_id = $planet AND
	P.planet_id = E2575.planet_id AND
	P.planet_id = E2750.planet_id AND
	P.planet_id = E3025.planet_id AND
	P.planet_id = E3030.planet_id AND
	P.planet_id = E3040.planet_id AND
	P.planet_id = E3052.planet_id AND
	P.planet_id = E3057.planet_id AND
	P.planet_id = E3062.planet_id";
	//echo "$query <p>\n";
	$result_po = mysql_query($query);
	$num_po = mysql_numrows($result_po);
	if ($num_po != 0) {
?>
<table>
<tr><th>Era:</th><th>Faction:</th></tr>

<?php
	$eras = array(2575, 2750, 3025, 3030, 3040, 3052, 3057, 3062);
	for ($i = 0; $i < 8; $i++) {
		echo "<tr><td>$eras[$i]</td><td>";
		$val = mysql_result($result_po, 0, "E$eras[$i].faction");
		print_sp($val);
		echo "</td></tr>";
	}
?>
</table><br />
<?php
	}
	mysql_free_result($result_po);
	
	
	// Planet's Ownership Dates
	$query = "SELECT
	*
	FROM
	faction F, owner_date O
	WHERE
	O.planet_id = $planet AND
	F.faction_id = O.faction_id
	ORDER BY O.occupation_date";
	//echo "$query <p>\n";
	$result_pod = mysql_query($query);
	$num_pod = mysql_numrows($result_pod);
	
	if ($num_pod != 0) {
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>Occupation Date:</th><th>Faction:</th></tr>
<?php
	}
	for ($i = 0; $i < $num_pod; $i++) {
		echo "<tr><td>";
		$val = mysql_result($result_pod, $i, "O.occupation_date");
		print_sp($val);
		echo "</td>";
		
		echo "<td>";
		$val = mysql_result($result_pod, $i, "F.name");
		print_sp($val);
		echo "</td></tr>\n";
		
	}
	if ($num_pod != 0) {
?>
</table><br />
<?php
	}
	mysql_free_result($result_pod);	
?>