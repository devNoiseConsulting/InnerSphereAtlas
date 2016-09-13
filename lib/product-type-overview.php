<?php

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "browselist";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "Dropships";
$searchvalue = '%' . trim($searchvalue) . '%';

$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : null;
if (empty($found) || !is_numeric($found)) {
	if ($func == "search") {
		$query = "SELECT
		COUNT(DISTINCT PT.product_type) AS found
		FROM
		product_type PT,
		product PC
		WHERE
		(PT.product_type LIKE :searchvalue OR
		PT.component_type LIKE :searchvalue) AND
		PT.product_type_id=PC.product_type_id
		";
		//echo "$query<P>\n";
	} else {
		$query = "SELECT
		COUNT(DISTINCT PT.product_type) AS found
		FROM
		product_type PT,
		product PC
		WHERE
		PT.product_type_id=PC.product_type_id
		";
		//echo "$query<p>\n";
	}
	$sth = $dbh->prepare($query);
	if ($func == "search") {
		$sth->bindParam(':searchvalue', $searchvalue);
	}
	$sth->execute();
	$productData = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	$found = $productData['found'] - 1;
}

if ($limit == 0) { $limit = $found; }

if ($func == "search") {
	$query = "SELECT DISTINCT
	PT.product_type_id,
	PT.component_type,
	PT.product_type,
	PT.slug
	FROM
	product_type PT,
	product PC
	WHERE
	(PT.product_type LIKE :searchvalue OR
	PT.component_type LIKE :searchvalue) AND
	PT.product_type_id=PC.product_type_id
	ORDER BY
	PT.product_type_id,
	PT.product_type
	LIMIT :start, :limit";
} else {
	$query = "SELECT DISTINCT
	PT.product_type_id,
	PT.component_type,
	PT.product_type,
	PT.slug
	FROM
	product_type PT,
	product PC
	WHERE
	PT.product_type_id=PC.product_type_id
	ORDER BY
	PT.product_type_id,
	PT.product_type
	LIMIT :start, :limit";
}

$sth = $dbh->prepare($query);
if ($func == "search") {
	$sth->bindParam(':searchvalue', $searchvalue);
}
$sth->bindParam(':start', $start, PDO::PARAM_INT);
$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
$sth->execute();
$products = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

include("$ISA_LIBDIR/next_prev.php");
