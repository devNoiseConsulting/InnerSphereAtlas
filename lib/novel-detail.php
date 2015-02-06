<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "") 
		print $val;
	else
		print "&nbsp;";
}

$novel = $_REQUEST["novel"];
if (empty($novel) || !is_numeric($novel)) { $novel = 9; }

$query = "SELECT * FROM novel WHERE novel_id=$novel";
//echo "$query <p>\n";
$result_p = mysql_query($query);
$num_p = mysql_numrows($result_p);

if ($num_p != 0) {

	echo "<div style=\"float: left; width: 30%; margin: 0 10px 0 0; padding: 5px; background-image: url(./images/gray_transparency.png); \">\n";

	echo "<b>Title: </b>";
	$val = mysql_result($result_p, $i, "title");
	print_sp($val);
	echo "<br />\n";

	echo "<b>Author:</b> ";
	$val = mysql_result($result_p, $i, "author");
	print_sp($val);
	echo "<br />\n";

	echo "<b>Series:</b> ";
	$val = mysql_result($result_p, $i, "series");
	print_sp($val);
	echo "<br />\n";

	$val = mysql_result($result_p, $i, "prologue_date");
	if ($val && $val != "0000-00-00") {
		echo "<b>Prologue Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "start_date");
	if ($val) {
		echo "<b>Start Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "end_date");
	if ($val) {
		echo "<b>End Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	$val = mysql_result($result_p, $i, "epilogue_date");
	if ($val && $val != "0000-00-00") {
		echo "<b>Epilogue Date:</b> ";
		print_sp($val);
		echo "<br />\n";
	}

	echo "</div>\n";

	$val = mysql_result($result_p, $i, "notes");
	if ($val) {
		echo "<h2>Description:</h2><blockquote>";
		print_sp($val);
		echo "</blockquote><br />\n";
	}
}
mysql_free_result($result_p);
?>
