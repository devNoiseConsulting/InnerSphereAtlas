<?php
	// Planet's Novels
	$query = "SELECT NT.novel_id, N.title, COUNT(NT.chapter_name) AS chapters
		FROM novel N, novel_timeline NT
		WHERE N.novel_id=NT.novel_id AND NT.planet_id=$planet
		GROUP BY NT.novel_id
		ORDER BY chapters DESC, N.title";
	//echo "$query <p>\n";
	$sth = $dbh->prepare($query);
	$sth->execute(array(':planet' => $planet));
	$novels = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sth = null;

	if ($novels) {
?>
<h2>Used as a location in the following Novels:</h2>
<table>
<tr><th>Novel:</th><th># of Chapters:</th><th>Amazon.com:</th></tr>
<?php
		for ($i = 0; $i < count($novels); $i++) {
			$novel_id = $novels[$i]['novel_id'];
			echo "<tr><td><a href=\"./novel-detail.php?novel=",urlencode($novel_id),"\">";
			$val = $novels[$i]['title'];
			print_sp($val);
			echo "</a></td>";
			
			echo "<td>";
			$val = $novels[$i]['chapters'];
			print_sp($val);

			$query = "SELECT isbn, availability
				FROM publisher
				WHERE novel_id=:novel_id
				ORDER BY print_year DESC
				LIMIT 1";
			$sth = $dbh->prepare($query);
			$sth->execute(array(':novel_id' => $novel_id));
			$publishedNovel = $sth->fetchAll(PDO::FETCH_ASSOC);
			$sth = null;
		
			if ($publishedNovel) {
				echo "</td><td>";
				$val = $publishedNovel[0]['isbn'];
				
				$asin = preg_replace("/-/", "", $val);
				$availability = $publishedNovel[0]['availability'];
				include("$ISA_LIBDIR/amazon-link.php");
			}
			echo "</td></tr>\n";
		}
?>
</table><br />
<?php
	}
?>