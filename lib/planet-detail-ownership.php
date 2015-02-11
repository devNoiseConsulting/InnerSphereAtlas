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

	$eras = array('E2575', 'E2750', 'E3025', 'E3030', 'E3040', 'E3052', 'E3057', 'E3062');
	
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
