<?php
if ($found >= $limit) {
	
	$letterNav = array();;
	if ($func == "browsebyletter") {
		$letter = $searchvalue{0};
		for ($i = 65; $i <= 90; $i++) {
			if (ord($letter) != $i) {
				$letterNav[] = "<a href=\"".$_SERVER['PHP_SELF']."?func=$func&amp;searchvalue=" . chr($i) . "\">" . chr($i) . "</a>";
			} else {
				$letterNav[] = $letter;
			}
			$letterNav[] = " | ";
		}
		array_pop($letterNav);
	}
	
	$trimmedsearchvalue = preg_replace("/^%?(.*)%$/", "\$1", $searchvalue);
	
	if (empty($start)) $start=0;

	$nextLink ="";
	if (isset($start) && ((($start+$limit) < $found))) { 
		$nextLink = "<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			$nextLink .= "&amp;searchvalue=" . urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) { 
			$nextLink .= "&amp;sort=$sort"; 
		}
		$nextLink .= "&amp;found=$found&amp;start=" . $start+$limit . "\">Next</a> /\n";
	}

	$previousLink = "";
	if (isset($start) && ($start>0)) { 
		$previousLink .= "<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			$previousLink .= "&amp;searchvalue=" . urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) { 
			$previousLink .= "&amp;sort=$sort"; 
		}
		$previousLink .= "&amp;found=$found&amp;start=" .  max($start - $limit, 0) . "\">Previous</a> /\n";
	}

	$pageLinks = array();
	$lowerbound = ($start / $limit) - 5;
	if ($lowerbound <= 0) {
		$lowerbound = 0;
	} else {
		$pageLink = "<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			$pageLink .= "&amp;searchvalue=" . urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) { 
			$pageLink .= "&amp;sort=$sort"; 
		}
		$pageLink .= "&amp;found=$found&amp;start=0\">1</a>\n...\n";
		$pageLinks[] = $pageLink;
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
				$pageLink = "<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
				if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
					$pageLink .=  "&amp;searchvalue=" . urlencode($trimmedsearchvalue);
				}
				if (isset($sort)) { 
					$pageLink .=  "&amp;sort=$sort"; 
				}
				$pageLink .=  "&amp;found=$found&amp;start=" .  ($i * $limit) . "\">" .  ($i + 1) . "</a>\n";
			} else {
				$pageLink =  ($i + 1) . "\n" ;
			}
			$pageLinks[] = $pageLink;
		}
	}

	if (($start + (6 * $limit)) <= $found) {
		$pageLink = "...\n<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
		if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
			$pageLink .=  "&amp;searchvalue=" . urlencode($trimmedsearchvalue);
		}
		if (isset($sort)) { 
			$pageLink .=  "&amp;sort=$sort"; 
		}
		$pageLink .=  "&amp;found=" . $found . "&amp;start=" .  (round(($found / $limit) - 0.5) * $limit) . "\">" . (round(($found / $limit) - 0.5) + 1) . "</a> \n";
		$pageLinks[] = $pageLink;
	}
	
}	
?>
