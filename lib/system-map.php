<?php

$query = "SELECT
P.name,
P.x_coord,
P.y_coord,
P.slug
FROM
planet P
where
P.planet_id = :planet
";

$sth = $dbh->prepare($query);
$sth->bindParam(':planet', $planet);
$sth->execute();
$planetData = $sth->fetch(PDO::FETCH_ASSOC);

if (!$planetData) {
	$planetData['name'] = "Terra";
	$planetData['x_coord'] = 0;
	$planetData['y_coord'] = 0;
	$planet = 2266787;
}

$eras = array('E2575', 'E2750', 'E3025', 'E3030', 'E3040', 'E3052', 'E3057', 'E3062');

$svg_url = "/system-map-svg.php?planet=" . urlencode($planet) . "&era=" . $era;
