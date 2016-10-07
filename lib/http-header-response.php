<?php

$fileName = $ISA_LIBDIR . "/hash-fragments.ser";
if (file_exists($fileName)) {
	$eTagData = unserialize(file_get_contents($fileName));
} else {
	$eTagData = array();
}


if (array_key_exists($_SERVER['SCRIPT_NAME'], $eTagData["fileAge"])) {
	$lastModifiedTime = $hashFragments["fileAge"][$_SERVER['SCRIPT_NAME']];
} else {
	$lastModifiedTime = filemtime($_SERVER['SCRIPT_FILENAME']);
}
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModifiedTime)." GMT");


if (array_key_exists($_SERVER['SCRIPT_NAME'], $eTagData["fingerPrint"])) {
	$hashFragment = $hashFragments["fingerPrint"][$_SERVER['SCRIPT_NAME']];
} else {
	$hashFragment = hash('tiger192,3', $_SERVER['SCRIPT_NAME']);
}

$etag = hash('tiger192,3',
	$_SERVER['SCRIPT_NAME'] . ":" .
	serialize($_REQUEST) . ":" .
	$hashFragment . ":" .
	$_SERVER['HTTP_USER_AGENT']
);
header("ETag: " . $etag);


// If client sent an If-None-Match header with the correct ETag, do not download again
if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim(trim($_SERVER['HTTP_IF_NONE_MATCH']), '\'"') === $etag) {
	// 304 Not Modified
	http_response_code(304);
	exit();
}

// If client sent an If-Modified-Since header with a recent modification date, do not download again
if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) > $lastModifiedTime) {
	// 304 Not Modified
	http_response_code(304);
	exit();
}
