<?php
$canonicalLink = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' .
	$_SERVER['SERVER_NAME'] .
	$_SERVER['REQUEST_URI'];
#$canonicalLink = htmlspecialchars($canonicalLink, ENT_QUOTES, 'UTF-8');

