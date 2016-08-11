<?php

	// Planet's Factory Info
	$query = "SELECT DISTINCT
	F.factory_id, F.name, P.name AS planet_name, F.slug
	FROM factory F, planet P
	WHERE
	P.planet_id=:planet AND
	F.planet_id = P.planet_id";
	//echo "$query <p>\n";

	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$factories = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;
