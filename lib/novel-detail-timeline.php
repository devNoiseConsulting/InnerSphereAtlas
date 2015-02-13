<?php

$query = "SELECT
NT.chapter_name,
NT.chapter_date,
P.planet_id,
P.name,
P.x_coord,
P.y_coord,
P.fluff,
P.factory
FROM
novel_timeline NT,
planet P
WHERE
NT.novel_id = :novel AND
NT.planet_id = P.planet_id
ORDER BY
NT.sort_order,
P.name
";

$sth = $dbh->prepare($query);
$sth->bindParam(':novel', $novel);
$sth->execute();
$timeline = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;
