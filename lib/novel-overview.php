<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "browselist";
$whichfield = array_key_exists("whichfield", $_REQUEST) ? $_REQUEST["whichfield"] : "title";
$searchvalue = array_key_exists("searchvalue", $_REQUEST) ? $_REQUEST["searchvalue"] : "Heir to the Dragon";
$searchvalue = '%' . trim($searchvalue) . '%';

$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$sortString = "N.end_date, N.start_date, N.title";
$sort = array_key_exists("sort", $_REQUEST) ? $_REQUEST["sort"] : "end";
if (isset($sort)) {
	if ($sort == "author") {
		$sortString = "N.author, N.end_date, N.start_date, N.title";
	} else if ($sort == "title") {
		$sortString = "N.title, N.end_date, N.start_date";
	} else if ($sort == "start") {
		$sortString = "N.start_date, N.end_date, N.title";
	} else if ($sort == "end") {
		$sortString = "N.end_date, N.start_date, N.title";
	}
}

$found = array_key_exists("found", $_REQUEST) ? $_REQUEST["found"] : null;
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$query = "SELECT
		COUNT(*) AS found
		FROM
		novel
		WHERE
		($whichfield LIKE :searchvalue)
		";
	} else {
		$query = "SELECT
		COUNT(*) AS found
		FROM
		novel
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

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

if (isset($func) && $func == "search") {
	$query = "SELECT
	N.novel_id,
	N.title,
	N.author,
	N.prologue_date,
	N.start_date,
	N.end_date,
	N.epilogue_date,
	N.notes
	FROM
	novel N
	WHERE
	($whichfield LIKE :searchvalue)
	ORDER BY " . $sortString . "
	LIMIT :start, :limit";
} else {
	$query = "SELECT
	N.novel_id,
	N.title,
	N.author,
	N.prologue_date,
	N.start_date,
	N.end_date,
	N.epilogue_date,
	N.notes
	FROM
	novel N
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
$novelData = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th><a href="./novel.php?sort=title">Title:</a></th><th><a href="./novel.php?sort=author">Author:</a></th><th><a href="./novel.php?sort=start">Start Date:</a></th><th><a href="./novel.php?sort=end">End Date:</a></th></tr>
<?php
/* Loop through each item */
for ($i =0 ;$i < count($novelData); $i++) {
	echo "<tr><td><a href=\"./novel-detail.php?novel=",urlencode($novelData[$i]['novel_id']),"\">";

	$val = $novelData[$i]['title'];
	print_sp($val);
	echo "</a></td>";

	echo "<td align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?func=search&amp;whichfield=author&amp;searchvalue=";
	$val = $novelData[$i]['author'];
	print_sp(urlencode($val));
	echo "\">";
	print_sp($val);
	echo "</a></td>";

	echo "<td align=\"right\">";
	$val = $novelData[$i]['start_date'];
	print_sp($val);
	echo "</td>";

	echo "<td align=\"right\">";
	$val = $novelData[$i]['end_date'];
	print_sp($val);
	echo "</td>";

	echo "</tr>\n";
}

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
