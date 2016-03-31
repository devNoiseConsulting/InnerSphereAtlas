<?php

$fileName = $ISA_LIBDIR . "/hash-fragments.ser";
if (file_exists($fileName)) {
	$eTagData = unserialize(file_get_contents($fileName));
} else {
	$eTagData = array();
}


if (array_key_exists($_SERVER['PHP_SELF'], $eTagData["fileAge"])) {
	$lastModifiedTime = $hashFragments["fileAge"][$_SERVER['PHP_SELF']];
} else {
	$lastModifiedTime = filemtime($_SERVER['SCRIPT_FILENAME']);
}
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModifiedTime)." GMT");


if (array_key_exists($_SERVER['PHP_SELF'], $eTagData["fingerPrint"])) {
	$hashFragment = $hashFragments["fingerPrint"][$_SERVER['PHP_SELF']];
} else {
	$hashFragment = hash('whirlpool', $_SERVER['PHP_SELF']);
}

$etag = hash('whirlpool',
	$_SERVER['PHP_SELF'] . ":" .
	serialize($_REQUEST) . ":" .
	$hashFragment . ":" .
	$_SERVER['HTTP_USER_AGENT']
);
header("Etag: $etag");


// If client sent an If-None-Match header with the correct ETag, do not download again
if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim(trim($_SERVER['HTTP_IF_NONE_MATCH']), '\'"') === $etag) {
	header('HTTP/1.1 304 Not Modified');
	exit();
}

// If client sent an If-Modified-Since header with a recent modification date, do not download again
if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) > $lastModifiedTime) {
	header('HTTP/1.1 304 Not Modified');
	exit();
}
