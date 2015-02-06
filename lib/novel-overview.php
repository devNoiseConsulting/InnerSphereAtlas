<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$func = $_REQUEST["func"];
if (empty($func)) { $func = "browselist"; }
$whichfield = $_REQUEST["whichfield"];
if (empty($whichfield)) { $whichfield = "title"; }
$searchvalue = $_REQUEST["searchvalue"];
if (empty($searchvalue)) { $searchvalue = "Heir to the Dragon"; }
$start = $_REQUEST["start"];
if (empty($start) || !is_numeric($start)) { $start = 0; }
$limit = $_REQUEST["limit"];
if (empty($limit) || !is_numeric($limit)) { $limit = 25; }
$sortString = "N.end_date, N.start_date, N.title";
$sort = $_REQUEST["sort"];
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

$found = $_REQUEST["found"];
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$result = mysql_query("SELECT COUNT(*) FROM novel WHERE ($whichfield LIKE '%" . $searchvalue . "%') ORDER BY $whichfield");
	} else {
		$result = mysql_query("SELECT COUNT(*) FROM novel");
	}
	$found = mysql_result($result,0,0) - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

if (isset($func) && $func == "search") {
	$query = "SELECT
	N.novel_id, N.title, N.author, N.prologue_date, N.start_date, N.end_date, N.epilogue_date, N.notes
	FROM
	novel N
	WHERE ($whichfield LIKE '%" . $searchvalue . "%')
	ORDER BY " . $sortString . "
	LIMIT $start,$limit";
} else {
	$query = "SELECT
	N.novel_id, N.title, N.author, N.prologue_date, N.start_date, N.end_date, N.epilogue_date, N.notes
	FROM
	novel N
	ORDER BY " . $sortString . "
	LIMIT $start,$limit";
}

$result = mysql_query($query);
$num = mysql_numrows($result);
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th><a href="./novel.php?sort=title">Title:</a></th><th><a href="./novel.php?sort=author">Author:</a></th><th><a href="./novel.php?sort=start">Start Date:</a></th><th><a href="./novel.php?sort=end">End Date:</a></th></tr>
<?php
/* Loop through each item */
for ($i =0 ;$i < $num; $i++) {
	echo "<tr><td><a href=\"./novel-detail.php?novel=",urlencode(mysql_result($result,$i,"novel_id")),"\">";

	$val = mysql_result($result, $i, "title");
	print_sp($val);
	echo "</a></td>";

	echo "<td align=\"left\"><a href=\"",$_SERVER[PHP_SELF],"?func=search&amp;whichfield=author&amp;searchvalue=";
	$val = mysql_result($result, $i, "author");
	print_sp(urlencode($val));
	echo "\">";
	print_sp($val);
	echo "</a></td>";

	echo "<td align=\"right\">";
	$val = mysql_result($result, $i, "start_date");
	print_sp($val);
	echo "</td>";

	echo "<td align=\"right\">";
	$val = mysql_result($result, $i, "end_date");
	print_sp($val);
	echo "</td>";

	echo "</tr>\n";
}
mysql_free_result($result);

?>
</table>
<?php

include("$ISA_LIBDIR/next_prev.php"); 

?>
