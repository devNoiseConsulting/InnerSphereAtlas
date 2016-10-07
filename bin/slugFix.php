<?php

require_once('../vendor/autoload.php');

require_once("../www/isatlas-config.php");
require_once("$ISA_LIBDIR/connect.php");

use Cocur\Slugify\Slugify;

class SlugFix
{
	private $data;
	private $fixedData;

	private $dbh;
	private $selectQuery;
	private $updateQuery;

	public function __construct($dbConnection, $select, $update)
	{
		$this->fixedData = array();

		$this->dbh = $dbConnection;
		$this->selectQuery = $select;
		$this->updateQuery = $update;
	}

	public function fetchSlugs() {
		$sth = $this->dbh->prepare($this->selectQuery);
		$sth->execute();
		$this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
		$sth = null;
	}

	public function checkSlugs() {
		$seo = new Slugify();

		for ($i = 0; $i < count($this->data); $i++) {
			$slug = $this->data[$i];
			$newSlug = $slug{'id'} . "/" . $seo->slugify(str_replace("'", "", $slug{'name'}));

			if (strcmp($newSlug, $slug{'slug'}) !== 0) {
				$slug{'slug'} = $newSlug;
				$this->fixedData[] = $slug;
			}
		}
	}

	public function updateSlugs() {
		for ($i = 0; $i < count($this->fixedData); $i++) {
			$slug = $this->fixedData[$i];
			$sth = $this->dbh->prepare($this->updateQuery);
			$sth->bindParam(':new_slug', $slug{'slug'}, PDO::PARAM_STR);
			$sth->bindParam(':id', $slug{'id'}, PDO::PARAM_INT);
			$sth->execute();
		}
	}

	public function changeCount() {
		return count($this->fixedData);
	}

	public function fix() {
		$this->fetchSlugs();
		$this->checkSlugs();
		$this->updateSlugs();
	}
}


/*
Original SQL to do the initial slug creation:
UPDATE planet P1, planet P2
SET P1.slug = CONCAT_WS('/', P2.planet_id, REPLACE(LOWER(P2.name),' ','-'))
WHERE P2.planet_id = P1.planet_id
*/

$planetSelectQuery = "SELECT
P.planet_id AS id,
P.name,
P.slug
FROM
planet P
";
$planetUpdateQuery = "UPDATE planet
SET slug = :new_slug
WHERE planet_id = :id
";

$planetFix = new SlugFix($dbh, $planetSelectQuery, $planetUpdateQuery);
$planetFix->fix();
echo "Planets fixed = " . $planetFix->changeCount() . "\n";

/*
Original SQL to do the initial slug creation:
UPDATE factory F1, factory F2
SET F1.slug = CONCAT_WS('/', F2.factory_id, REPLACE(LOWER(F2.name),' ','-'))
WHERE F2.factory_id = F1.factory_id
*/

$factorySelectQuery = "SELECT
F.factory_id AS id,
F.name,
F.slug
FROM
factory F
";
$factoryUpdateQuery = "UPDATE factory
SET slug = :new_slug
WHERE factory_id = :id
";

$factoryFix = new SlugFix($dbh, $factorySelectQuery, $factoryUpdateQuery);
$factoryFix->fix();
echo "Factories fixed = " . $factoryFix->changeCount() . "\n";


/*
Original SQL to do the initial slug creation:
UPDATE novel F1, novel F2
SET F1.slug = CONCAT_WS('/', F2.novel_id, REPLACE(LOWER(F2.title),' ','-'))
WHERE F2.novel_id = F1.novel_id
*/

$novelSelectQuery = "SELECT
N.novel_id AS id,
N.name,
N.slug
FROM
novel N
";
$novelUpdateQuery = "UPDATE novel
SET slug = :new_slug
WHERE novel_id = :id
";

$novelFix = new SlugFix($dbh, $novelSelectQuery, $novelUpdateQuery);
$novelFix->fix();
echo "Novels fixed = " . $novelFix->changeCount() . "\n";


/*
Original SQL to do the initial slug creation:
UPDATE product_type P1, product_type P2
SET P1.slug = CONCAT_WS('/', P2.product_type_id, REPLACE(LOWER(CONCAT_WS('-', P2.component_type, P2.product_type)),' ','-'))
WHERE P2.product_type_id = P1.product_type_id
*/

$productSelectQuery = "SELECT
PT.product_type_id AS id,
CONCAT_WS(' ', PT.component_type, PT.product_type) AS name,
PT.slug
FROM
product_type PT
";
$productUpdateQuery = "UPDATE product_type
SET slug = :new_slug
WHERE product_type_id = :id
";

$productFix = new SlugFix($dbh, $productSelectQuery, $productUpdateQuery);
$productFix->fix();
echo "Products fixed = " . $productFix->changeCount() . "\n";
