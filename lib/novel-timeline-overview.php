<?php

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "browselist";
$whichfield = array_key_exists("whichfield", $_REQUEST) ? $_REQUEST["whichfield"] : "novel_id";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "5";
$searchvalue = '%' . trim($searchvalue) . '%';

$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$sortString = "NT.chapter_date, N.novel_id, NT.chapter_name";
$sort = array_key_exists("sort", $_REQUEST) ? $_REQUEST["sort"] : "X";
if (isset($sort)) {
	if ($sort == "title") {
		$sortString = "N.title, N.start_date, NT.chapter_date";
	} else {
		$sortString = "NT.chapter_date, N.novel_id, NT.chapter_name";
	}
}

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : "X";
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$query = "SELECT
		COUNT(*) AS found
		FROM novel_timeline 
		WHERE
		($whichfield LIKE :searchvalue)
		";
	} else {
		$query = "SELECT 
		COUNT(*) AS found
		FROM
		novel_timeline
		";
	}
	$sth = $dbh->prepare($query);
	if ($func == "search") {
		$sth->bindParam(':searchvalue', $searchvalue);
	}
	$sth->execute();
	$novelData = $sth->fetch(PDO::FETCH_ASSOC);
	$sth = null;

	$found = $novelData['found'] - 1;
}

if ($limit == 0) { $limit = $found; }

if (isset($func) && $func == "search") {
	$query = "SELECT
	N.novel_id,
	N.title,
	NT.chapter_name,
	NT.chapter_date
	FROM
	novel N,
	novel_timeline NT
	WHERE
	(N.novel_id = NT.novel_id) AND
	($whichfield LIKE :searchvalue)
	ORDER BY " . $sortString . "
	LIMIT :start, :limit";
} else {
	$query = "SELECT
	N.novel_id,
	N.title,
	NT.chapter_name,
	NT.chapter_date
	FROM
	novel N,
	novel_timeline NT
	WHERE
	(N.novel_id = NT.novel_id) 
	ORDER BY " . $sortString . "
	LIMIT :start, :limit";
}
$sth = $dbh->prepare($query);
if ($func == "search") {
	$sth->bindParam(':searchvalue', $searchvalue);
}
$sth->bindParam(':start', $start, PDO::PARAM_INT);
$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
$sth->execute();
$timeline = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

include("$ISA_LIBDIR/next_prev.php"); 
