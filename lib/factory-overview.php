<?php

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "browselist";
$whichfield = array_key_exists("whichfield", $_REQUEST) ? $_REQUEST["whichfield"] : "F.name";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "Majesty";
$searchvalue = '%' . trim($searchvalue) . '%';

$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : null;
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$query = "SELECT 
		COUNT(*) AS found
		FROM 
		planet P, 
		factory F 
		WHERE 
		F.name LIKE :searchvalue AND 
		P.planet_id = F.planet_id
		";
	} else {
		$query = "SELECT 
		COUNT(*) AS found
		FROM 
		planet P, 
		factory F 
		WHERE 
		P.planet_id = F.planet_id
		";
	}
	$sth = $dbh->prepare($query);
	if ($func == "search") {
		$sth->bindParam(':searchvalue', $searchvalue);
	}
	$sth->execute();
	$factoryData = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	$found = $factoryData['found'] - 1;
}


if ($limit == 0) { $limit = $found; }

if ($func == "search") {
	$query = "SELECT
	F.factory_id,
	F.name,
	P.planet_id,
	P.name AS planet_name,
	P.x_coord,
	P.y_coord
	FROM
	planet P,
	factory F
	WHERE
	F.name LIKE :searchvalue AND 
	P.planet_id = F.planet_id
	ORDER BY F.name
	LIMIT :start, :limit
	";
} else {
	$query = "SELECT
	F.factory_id,
	F.name,
	P.planet_id,
	P.name AS planet_name,
	P.x_coord,
	P.y_coord
	FROM
	planet P,
	factory F
	WHERE
	P.planet_id = F.planet_id
	ORDER BY F.name
	LIMIT :start, :limit
	";
}

$sth = $dbh->prepare($query);
if ($func == "search") {
	$sth->bindParam(':searchvalue', $searchvalue);
}
$sth->bindParam(':start', $start, PDO::PARAM_INT);
$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
$sth->execute();
$factories = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

include("$ISA_LIBDIR/next_prev.php"); 
