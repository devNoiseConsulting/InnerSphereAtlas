<?php

	$User     = "username";
	$Password = "password";
	$Host     = "localhost";
	$Database = "database";

	mysql_connect($Host,$User,$Password) or die("Unable to connect to SQL server");
	mysql_select_db($Database) or die("Unable to select database: ".$Database);

?>
