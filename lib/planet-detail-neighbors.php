<?php
	// Planet's Neighbors
	$query = "(SELECT DISTINCT
P.planet_id, P.name AS planet_name, P.x_coord, P.y_coord, P.factory, P.fluff, 1 AS jumps
FROM jump_points JP, planet P
WHERE
JP.planet_id=:planet AND
JP.jump_id = P.planet_id)
UNION
(SELECT DISTINCT P.planet_id, P.name AS planet_name, P.x_coord, P.y_coord, P.factory, P.fluff, 2 AS jumps
FROM jump_points JP1, jump_points JP2, planet P
WHERE JP1.planet_id=:planet
AND JP2.planet_id = JP1.jump_id
AND JP2.jump_id = P.planet_id
AND P.planet_id NOT IN (SELECT JP.jump_id
FROM jump_points JP
WHERE
JP.planet_id=:planet)
AND P.planet_id <> :planet)
ORDER BY planet_name";
	//echo "$query <p>\n";

	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$neighbors = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;
