<?php

$func = array_key_exists("func", $_REQUEST) ? $_REQUEST["func"] : "search";
$searchvalue = $productType;
$start = array_key_exists("start", $_REQUEST) ? $_REQUEST["start"] : "0";
if (!is_numeric($start)) { $start = 0; }
$start = (int) $start;
$limit = array_key_exists("limit", $_REQUEST) ? $_REQUEST["limit"] : "25";
if (!is_numeric($limit)) { $limit = 25; }
$limit = (int) $limit;

$query = "SELECT
COUNT(PT.product_type_id) AS found,
PT.component_type,
PT.product_type,
PT.slug
FROM
product PC,
product_type PT
WHERE
(PT.product_type_id = :searchvalue) AND
PC.product_type_id=PT.product_type_id
GROUP BY
PT.product_type_id
";
//echo "$query<P>\n";

$sth = $dbh->prepare($query);
$sth->bindParam(':searchvalue', $searchvalue);
$sth->execute();
$product = $sth->fetch(PDO::FETCH_ASSOC);
$sth = null;

$found = $product['found'] - 1;

$query = "SELECT DISTINCT
PC.product_name,
F.factory_id,
F.name AS factory_name,
F.slug AS factory_slug,
P.planet_id,
P.name AS planet_name,
P.slug AS planet_slug
FROM
product PC,
product_type PT,
factory F,
planet P
WHERE
PT.product_type_id = :searchvalue AND
PC.product_type_id = PT.product_type_id AND
PC.factory_id = F.factory_id AND
F.planet_id = P.planet_id
ORDER BY
PC.product_name,
F.name, P.name
LIMIT :start, :limit
";
//echo "$query <p>\n";

$sth = $dbh->prepare($query);
$sth->bindParam(':searchvalue', $searchvalue);
$sth->bindParam(':start', $start, PDO::PARAM_INT);
$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
$sth->execute();
$products = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;

include("$ISA_LIBDIR/next_prev.php");
