<?php

$pageNav = array(
	'func' => $func,
	'trimmedsearchvalue' => null,
	'letterNav' => null,
	'firstPage' => false,
	'lastPage' => false,
	'nextLink' => null,
	'previousLink' => null,
	'pageLinks' => null,
	'php_self' => $_SERVER['PHP_SELF']
);

if ($found >= $limit) {
	
	$pageNav['letterNav'] = array();
	if ($func == "browsebyletter") {
		$letter = $searchvalue{0};
		for ($i = 65; $i <= 90; $i++) {
			$pageNav['letterNav'][] = chr($i);
		}
	}
	
	$pageNav['trimmedsearchvalue'] = preg_replace("/^%?(.*)%$/", "\$1", $searchvalue);
	
	if (empty($start)) $start=0;
	
	$pageNav['pageNum'] = ($start / $limit) + 1;
	if ($pageNav['pageNum'] == 1) {
		$pageNav['firstPage'] = true;
	}

	$pageNav['nextLink'] = "<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
	if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
		$pageNav['nextLink'] .= "&amp;searchvalue=" . urlencode($pageNav['trimmedsearchvalue']);
	}
	if (isset($sort)) { 
		$pageNav['nextLink'] .= "&amp;sort=$sort"; 
	}
	$pageNav['nextLink'] .= "&amp;found=$found&amp;start=" . ($start + $limit) . "\">&#9654;</a>";

	$pageNav['previousLink'] .= "<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
	if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
		$pageNav['previousLink'] .= "&amp;searchvalue=" . urlencode($pageNav['trimmedsearchvalue']);
	}
	if (isset($sort)) { 
		$pageNav['previousLink'] .= "&amp;sort=$sort"; 
	}
	$pageNav['previousLink'] .= "&amp;found=$found&amp;start=" .  max($start - $limit, 0) . "\">&#9664;</a>";

	$pageNav['pageNumbers'] = array();
	$pageNav['pageLinks'] = array();
	$lowerbound = ($start / $limit) - 5;
	if ($lowerbound <= 0) {
		$lowerbound = 0;
	}

	$upperbound = $start + (6 * $limit);
	if ($upperbound < $found) {
		$upperbound /= $limit;
	} else {
		$upperbound = floor($found / $limit);
	}

	if (($upperbound + 1) == $pageNav['pageNum']) {
		$pageNav['lastPage'] = true;
	}

	if ($found > $limit) {
		for ($i = $lowerbound; $i <= $upperbound; $i++) {
			$pageNav['pageNumbers'][] = $i + 1;
			$pageLink = "<a href=\"".$_SERVER['PHP_SELF']."?func=$func";
			if (isset($func) && ($func == "search" || $func == "browsebyletter")) {
				$pageLink .=  "&amp;searchvalue=" . urlencode($pageNav['trimmedsearchvalue']);
			}
			if (isset($sort)) { 
				$pageLink .=  "&amp;sort=$sort"; 
			}
			$pageLink .=  "&amp;found=$found&amp;start=" .  ($i * $limit) . "\">" .  ($i + 1) . "</a>";
			$pageNav['pageLinks'][$i + 1] = $pageLink;
		}
	}
}
