<?php
if ($found >= $limit) {
	echo "<p>";
	
	if ($func == "browsebyletter") {
		$letter = $searchvalue{0};
		$letterNav = "";
		for ($i = 65; $i <= 90; $i++) {
			if (ord($letter) != $i) {
				$letterNav .= "<a href=\"$_SERVER[PHP_SELF]?func=$func&amp;searchvalue=" . chr($i) . "\">";
				$letterNav .= chr($i) . "</a> | \n";
			} else {
				$letterNav .= "$letter | \n";
			}
		}
		$letterNav = rtrim($letterNav, " |\n");
		echo "$letterNav<br />\n";
	}
	
	$trimmedsearchvalue = preg_replace("/(.*)%$/", "\$1", $searchvalue);
	
	if (empty($start)) $start=0;
	
	if (isset($start) && ((($start+$limit) < $found))) { 
		echo "<a href=\"$_SERVER[PHP_SELF]?func=$func";
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			echo "&amp;searchvalue=",urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) echo "&amp;sort=$sort";
		echo "&amp;found=$found&amp;start=",$start+$limit,"\">Next</a> /\n";
	}
	
	if (isset($start) && ($start>0)) { 
		echo "<a href=\"$_SERVER[PHP_SELF]?func=$func";
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			echo "&amp;searchvalue=",urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) echo "&amp;sort=$sort";
		echo "&amp;found=$found&amp;start=", max($start - $limit, 0), "\">Previous</a> /\n";
	}
	
	$lowerbound = ($start / $limit) - 5;
	if ($lowerbound <= 0) {
		$lowerbound = 0;
	} else {
		echo("<a href=\"$_SERVER[PHP_SELF]?func=$func");
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			echo "&amp;searchvalue=",urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) echo "&amp;sort=$sort";
		echo "&amp;found=$found&amp;start=0\">1</a>\n...\n";		
	}
	
	$upperbound = $start + (6 * $limit);
	if ($upperbound < $found) {
		$upperbound /= $limit;
	} else {
		$upperbound = $found / $limit;
	}
	
	if ($found > $limit) {
		for ($i = $lowerbound; $i < $upperbound; $i++) {
			if (($i * $limit) != $start) {
				echo("<a href=\"$_SERVER[PHP_SELF]?func=$func");
				if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
					echo "&amp;searchvalue=",urlencode($trimmedsearchvalue);
				}
				if (isset($sort)) echo "&amp;sort=$sort";
				echo "&amp;found=$found&amp;start=", ($i * $limit), "\">", ($i + 1), "</a>\n";
			} else {
				echo ($i + 1), "\n" ;
			}
		}
	}
	if (($start + (6 * $limit)) <= $found) {
		echo("...\n<a href=\"$_SERVER[PHP_SELF]?func=$func");
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			echo "&amp;searchvalue=",urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) echo "&amp;sort=$sort";
		echo "&amp;found=$found&amp;start=", round(($found / $limit) - 0.5) * $limit, "\">", round(($found / $limit) - 0.5) + 1, "</a> \n";		
	}
	
	echo("</p>\n");
}	
?>
