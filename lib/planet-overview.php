<?php

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "all";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "%";
$searchvalue = trim($searchvalue);
if (strlen($searchvalue) == 1) {
	$searchvalue = $searchvalue . "%";
} else if ((strlen($searchvalue) > 1) && ($searchvalue{1} <> "%")) {
	$searchvalue = "%" . $searchvalue . "%";
}

$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : null;
if (empty($found) || !is_numeric($found)) {
	$query = "SELECT
	COUNT(*) AS found
	FROM
	planet P
	WHERE (P.name LIKE :searchvalue)
	";

	$sth = $dbh->prepare($query);
	$sth->bindParam(':searchvalue', $searchvalue);
	$sth->execute();
	$productData = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	$found = $productData['found'] - 1;
}

if ($limit == 0) { $limit = $found; }

$query = "SELECT
P.planet_id,
P.name,
P.x_coord,
P.y_coord,
P.factory,
P.fluff
FROM
planet P
WHERE
(P.name LIKE :searchvalue)
ORDER BY P.name
LIMIT :start, :limit";

$sth = $dbh->prepare($query);
$sth->bindParam(':searchvalue', $searchvalue);
$sth->bindParam(':start', $start, PDO::PARAM_INT);
$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
$sth->execute();
$planets = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

include("$ISA_LIBDIR/next_prev.php");
