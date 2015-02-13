<?php
$query = "SELECT DISTINCT
*
FROM
product PC, product_type PT
WHERE
PC.factory_id=:factory AND
PC.product_type_id=PT.product_type_id
ORDER BY
PT.product_type_id, PT.product_type, PC.product_name";

$sth = $dbh->prepare($query);
$sth->execute(array(':factory' => $factory));
$components = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;
