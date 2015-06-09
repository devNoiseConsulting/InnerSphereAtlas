<?php

	$User     = "isatlas";
	$Password = "isatlas";
	$Host     = "localhost";
	$Database = "isatlas";

/*
	mysql_connect($Host,$User,$Password) or die("Unable to connect to SQL server");
	mysql_select_db($Database) or die("Unable to select database: ".$Database);
*/

	try {
		$dbh = new PDO(
			'mysql:host='.$Host.';dbname='.$Database.';charset=utf8',
			$User,
			$Password);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
