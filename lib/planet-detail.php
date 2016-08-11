<?php

Function print_sp($val) {
	$val = chop($val);
	if($val != "")
		print $val;
	else
		print "&nbsp;";
}

$query = "SELECT * FROM planet WHERE planet_id=:planet";
$sth = $dbh->prepare($query);
$sth->execute(array(':planet' => $planet));
$planetData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;

if (array_key_exists("slug", $planetData)) {
	$canonicalLink = $seoLink . "/" . $planetData["slug"];
}
