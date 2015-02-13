<?php

$factory = array_key_exists("factory", $_REQUEST) ? $_REQUEST["factory"] : "6253789";
if (!is_numeric($factory)) { $factory = 6253789; }

$query = "SELECT DISTINCT
F.factory_id,
F.name,
P.planet_id,
P.name AS planet_name,
P.x_coord,
P.y_coord
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

include("$ISA_LIBDIR/product_component.php");
