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
if (empty($whichfield)) { $whichfield = "novel_id"; }
$searchvalue = $_REQUEST["searchvalue"];
if (empty($searchvalue)) { $searchvalue = "5"; }
$start = $_REQUEST["start"];
if (empty($start) || !is_numeric($start)) { $start = 0; }
$limit = $_REQUEST["limit"];
if (empty($limit) || !is_numeric($limit)) { $limit = 25; }
$sortString = "NT.chapter_date, N.novel_id, NT.chapter_name";
$sort = $_REQUEST["sort"];
if (isset($sort)) {
	if ($sort == "title") {
		$sortString = "N.title, N.start_date, NT.chapter_date";
	} else {
		$sortString = "NT.chapter_date, N.novel_id, NT.chapter_name";
	}
}

$found = $_REQUEST["found"];
if (empty($found) || !is_numeric($found)) {
	if (isset($func) && $func == "search") {
		$result = mysql_query("SELECT COUNT(*) FROM novel_timelin WHERE ($whichfield LIKE '%" . $searchvalue . "%') ORDER BY $whichfield");
	} else {
		$result = mysql_query("SELECT COUNT(*) FROM novel_timeline");
	}
	$found = mysql_result($result,0,0) - 1;
}

include("$ISA_LIBDIR/next_prev.php"); 

if ($limit == 0) { $limit = $found; }

if (isset($func) && $func == "search") {
	$query = "SELECT
	N.novel_id, N.title, NT.chapter_name, NT.chapter_date
	FROM
	novel N, novel_timeline NT
	WHERE (N.novel_id = NT.novel_id) 
	AND ($whichfield LIKE '%" . $searchvalue . "%')
	ORDER BY " . $sortString . "
	LIMIT $start,$limit";
} else {
	$query = "SELECT
	N.novel_id, N.title, NT.chapter_name, NT.chapter_date
	FROM
	novel N, novel_timeline NT
	WHERE (N.novel_id = NT.novel_id) 
	ORDER BY " . $sortString . "
	LIMIT $start,$limit";
}

$result = mysql_query($query);
$num = mysql_numrows($result);
?>
<table border="1" cellspacing="0" cellpadding="5">
<tr>
<th><a href="./novel-timeline.php?sort=date">Date:</a></th>
<th><a href="./novel-timeline.php?sort=title">Title:</a></th>
<th>Chapter:</th>
</tr>
<?php
/* Loop through each item */
for ($i =0 ;$i < $num; $i++) {
	echo "<tr><td>";
	$val = mysql_result($result, $i, "NT.chapter_date");
	print_sp($val);
	echo "</td>";

	echo "<td><a href=\"./novel-detail.php?novel=",urlencode(mysql_result($result,$i,"N.novel_id")),"\">";
	$val = mysql_result($result, $i, "N.title");
	print_sp($val);
	echo "</a></td>";

	echo "<td>";
	$val = mysql_result($result, $i, "NT.chapter_name");
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
