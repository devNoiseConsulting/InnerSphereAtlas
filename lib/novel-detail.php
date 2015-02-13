<?php

$novel = array_key_exists("novel", $_REQUEST) ? $_REQUEST["novel"] : "9";

$query = "SELECT
*
FROM
novel
WHERE
novel_id = :novel
";
//echo "$query <p>\n";

$sth = $dbh->prepare($query);
$sth->bindParam(':novel', $novel);
$sth->execute();
$novelData = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;
