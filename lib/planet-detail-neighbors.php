<h2>Inhabited System(s) within thirty light-years:</h2>
<?php
	// Planet's Neighbors
	$query = "SELECT DISTINCT
	P.planet_id, P.name AS planet_name, P.x_coord, P.y_coord, P.factory, P.fluff, JP.distance
	FROM jump_points JP, planet P
	WHERE
	JP.planet_id=:planet AND
	JP.jump_id = P.planet_id
	ORDER BY P.name";
	//echo "$query <p>\n";

	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$neighbors = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;
