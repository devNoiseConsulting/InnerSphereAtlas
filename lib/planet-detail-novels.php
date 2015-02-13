<?php
// Planet's Novels
$query = "SELECT
NT.novel_id,
N.title,
COUNT(NT.chapter_name) AS chapters,
P.isbn,
P.availability
FROM
novel N,
novel_timeline NT,
publisher P
WHERE
N.novel_id=NT.novel_id AND
NT.planet_id=:planet AND
N.novel_id = P.novel_id AND
P.publisher_id = (SELECT
				  MAX(publisher_id)
				  FROM
				  publisher P
				  WHERE
				  P.novel_id = N.novel_id)
GROUP BY
NT.novel_id
ORDER BY
chapters DESC,
N.title
";
//echo "$query <p>\n";

$sth = $dbh->prepare($query);
$sth->execute(array(':planet' => $planet));
$novels = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

foreach ($novels as $key => $novel) {
	$novels[$key]['asin'] = preg_replace("/-/", "", $novel['isbn']);
}