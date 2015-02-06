<h2>Inhabited System(s) within thirty light-years:</h2>
<?php
	// Planet's Neighbors
	$query = "SELECT DISTINCT
	P.planet_id, P.name AS planet_name, P.x_coord, P.y_coord, P.factory, P.fluff, JP.distance
	FROM jump_points JP, planet P
	WHERE
	JP.planet_id=:planet AND
	JP.jump_id = P.planet_id
	ORDER BY P.name";
	//echo "$query <p>\n";

	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$neighbors = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;

	if ($neighbors) {
?>
<table>
<tr><th>Planet:</th><th>X Coord:</th><th>Y Coord:</th><th>Distance:</th></tr>
<?php
		for ($i = 0; $i < count($neighbors); $i++) {
			echo "<tr><td><a href=\"./planet-detail.php?planet=",urlencode($neighbors[$i]['planet_id']),"\">";
			$val = $neighbors[$i]['planet_name'];
			print_sp($val);
			echo "</a></td>";
			
			echo "<td align=\"right\">";
			$val = $neighbors[$i]['x_coord'];
			print_sp($val);
			echo "</td>";
			
			echo "<td align=\"right\">";
			$val = $neighbors[$i]['y_coord'];
			print_sp($val);
			echo "</td>";
			
			echo "<td align=\"right\">";
			$val = $neighbors[$i]['distance'];
			print_sp($val);
			echo "</td>";
	
			$factory = $neighbors[$i]['factory'];
			$fluff = $neighbors[$i]['fluff'];
			if ($factory || $fluff) {
				echo "<td align=\"center\"><a href=\"./planet-detail.php?planet=",urlencode(mysql_result($result_pn,$i,"planet_id")),"\">";
		
				if ($factory && $fluff) {
					echo "<img src=\"./images/fluff.gif\" alt=\"Description\" width=\"16\" 	height=\"16\" border=\"0\" /><img src=\"./images/factory.gif\" alt=\"Factory\" 	width=\"16\" height=\"16\" border=\"0\" />";
		
				} else if ($factory) {
					echo "<img src=\"./images/factory.gif\" alt=\"Factory\" width=\"16\" 	height=\"16\" border=\"0\" />";
				} else if ($fluff) {
					echo "<img src=\"./images/fluff.gif\" alt=\"Description\" width=\"16\" 	height=\"16\" border=\"0\" />";
				}
				echo "</a></td>";
			}
	
			echo "</tr>\n";
		}
?>
</table><br />
<?php
	} else {
?>
<p>There are no inhabited systems within thirty light-years of this planet.</p>
<?php
	}

include("$ISA_DOCROOTDIR/legend.php");
?>