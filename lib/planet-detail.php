<?php

$query = "SELECT
*
FROM
planet
WHERE
planet_id=:planet";

$sth = $dbh->prepare($query);
$sth->execute(array(':planet' => $planet));
$planetData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;
