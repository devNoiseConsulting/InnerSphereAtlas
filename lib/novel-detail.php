<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$novel = array_key_exists("novel", $_REQUEST) ? $_REQUEST["novel"] : "9";

$query = "SELECT
*
FROM
novel
WHERE
novel_id = :novel
";
//echo "$query <p>\n";

$sth = $dbh->prepare($query);
$sth->bindParam(':novel', $novel);
$sth->execute();
$novelData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;

if ($novelData) {

	echo "<div style=\"float: left; width: 30%; margin: 0 10px 0 0; padding: 5px; background-image: url(./images/gray_transparency.png); \">\n";

	echo "<b>Title: </b>";
	$val = $novelData['title'];
	print_sp($val);
	echo "<br />\n";

	echo "<b>Author:</b> ";
	$val = $novelData['author'];
	print_sp($val);
	echo "<br />\n";

	echo "<b>Series:</b> ";
	$val = $novelData['series'];
	print_sp($val);
	echo "<br />\n";

	$val = $novelData['prologue_date'];
	if ($val && $val != "0000-00-00") {
		echo "<b>Prologue Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = $novelData['start_date'];
	if ($val) {
		echo "<b>Start Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = $novelData['end_date'];
	if ($val) {
		echo "<b>End Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = $novelData['epilogue_date'];
	if ($val && $val != "0000-00-00") {
		echo "<b>Epilogue Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	echo "</div>\n";

	$val = $novelData['notes'];
	if ($val) {
		echo "<h2>Description:</h2><blockquote>";
		print_sp($val);
		echo "</blockquote><br />\n";
	}
}
?>
