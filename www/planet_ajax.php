<?php
include("./isatlas-config.php");
include("$ISA_LIBDIR/connect.php");

$planet = mysql_real_escape_string($_REQUEST["searchvalue"]);

$query = "SELECT DISTINCT P.planet_id, P.name, P.x_coord, P.y_coord FROM planet P
	WHERE P.name LIKE '%" . $planet . "%' ORDER BY P.name";

echo "<ul>\n";
$result = mysql_query($query) or die (mysql_error () . "<li>The query was:" . $query . "</li>");
$num = mysql_numrows($result);

if ($num > 0) {
	if ($num > 15) { $num = 15; }
	for ($i=0; $i < $num; $i++) {
		$name = mysql_result($result, $i, "name");
		$x = mysql_result($result, $i, "x_coord");
		$y = mysql_result($result, $i, "y_coord");
	
		echo "<li>" . $name . "<br/><span class=\"informal\"> (" . $x . ", " . $y . ")<br/></span></li>\n";
	}
	mysql_free_result($result);
	
}
echo "</ul>\n";
	
?>