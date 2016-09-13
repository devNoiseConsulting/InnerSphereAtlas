<?php

$query = "SELECT DISTINCT
F.factory_id,
F.name,
F.slug,
P.planet_id,
P.name AS planet_name,
P.x_coord,
P.y_coord,
P.slug AS planet_slug
FROM
factory F,
planet P
WHERE
F.factory_id=:factory AND
F.planet_id = P.planet_id";
//echo "$query <P>\n";

$sth = $dbh->prepare($query);
$sth->execute(array(':factory' => $factory));
$factoryData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;
