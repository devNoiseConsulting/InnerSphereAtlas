<?php
	// Planet's Novels
	$query = "SELECT NT.novel_id, N.title, COUNT(NT.chapter_name) AS chapters
		FROM novel N, novel_timeline NT
		WHERE N.novel_id=NT.novel_id AND NT.planet_id=$planet
		GROUP BY NT.novel_id
		ORDER BY chapters DESC, N.title";
	//echo "$query <p>\n";
	$result_pn = mysql_query($query);
	$num_pn = mysql_numrows($result_pn);

	if ($num_pn != 0) {
?>
<h2>Used as a location in the following Novels:</h2>
<table>
<tr><th>Novel:</th><th># of Chapters:</th><th>Amazon.com:</th></tr>
<?php
		for ($i = 0; $i < $num_pn; $i++) {
			$novel_id = mysql_result($result_pn, $i, "novel_id");
			echo "<tr><td><a href=\"./novel-detail.php?novel=",urlencode($novel_id),"\">";
			$val = mysql_result($result_pn, $i, "title");
			print_sp($val);
			echo "</a></td>";
			
			echo "<td>";
			$val = mysql_result($result_pn, $i, "chapters");
			print_sp($val);

			$query = "SELECT isbn, availability
				FROM publisher
				WHERE novel_id=$novel_id
				ORDER BY print_year DESC
				LIMIT 1";
			$result_pa = mysql_query($query);
			$num_pa = mysql_numrows($result_pa);
		
			if ($num_pa != 0) {
				echo "</td><td>";
				$val = mysql_result($result_pa, 0, "isbn");
				
				$asin = preg_replace("/-/", "", $val);
				$availability = mysql_result($result_pa, 0, "availability");
				include("$ISA_LIBDIR/amazon-link.php");
			}
			echo "</td></tr>\n";
		}
?>
</table><br />
<?php
	}
	mysql_free_result($result_pn);
?>