<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/canonical-link.php");

$searchLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

$planets = array(
  [ "id" => 2075223, "name" => "A Place", "slug" => "2075223/a-place" ],
  [ "id" => 2334257, "name" => "Addicks", "slug" => "2334257/addicks" ],
  [ "id" => 2737000, "name" => "Ares", "slug" => "2737000/ares" ],
  [ "id" => 2873870, "name" => "Atreus", "slug" => "2873870/atreus" ],
  [ "id" => 3363837, "name" => "Demeter", "slug" => "3363837/demeter" ],
  [ "id" => 4252832, "name" => "Galatea", "slug" => "4252832/galatea" ],
  [ "id" => 4377378, "name" => "Hesperus II", "slug" => "4377378/hesperus-ii" ],
  [ "id" => 4627270, "name" => "Inarcs", "slug" => "4627270/inarcs" ],
  [ "id" => 5667826, "name" => "Konstance", "slug" => "5667826/konstance" ],
  [ "id" => 5884436, "name" => "Luthien", "slug" => "5884436/luthien" ],
  [ "id" => 6390282, "name" => "New Avalon", "slug" => "6390282/new-avalon" ],
  [ "id" => 7426000, "name" => "Sian", "slug" => "7426000/sian" ],
  [ "id" => 7652747, "name" => "Solaris VII", "slug" => "7652747/solaris-vii" ],
  [ "id" => 7800483, "name" => "St. Ives", "slug" => "7800483/st-ives" ],
  [ "id" => 8377200, "name" => "Terra", "slug" => "8377200/terra" ],
  [ "id" => 8427523, "name" => "Tharkad", "slug" => "8427523/tharkad" ],
  [ "id" => 8456668, "name" => "Tikonov", "slug" => "8456668/tikonov" ],
  [ "id" => 8992767, "name" => "Twycross", "slug" => "8992767/twycross" ]
);

$factories = array(
  [ "id" => 2243762, "name" => "Achernar BattleMechs", "slug" => "2243762/achernar-battlemechs" ],
  [ "id" => 2534704, "name" => "Aldis Industries", "slug" => "2534704/aldis-industries" ],
  [ "id" => 2554263, "name" => "Alliance Mining and Geology", "slug" => "2554263/alliance-mining-and-geology" ],
  [ "id" => 2373706, "name" => "Ceres Metals Industries", "slug" => "2373706/ceres-metals-industries" ],
  [ "id" => 3334263, "name" => "Defiance Industries", "slug" => "3334263/defiance-industries" ],
  [ "id" => 3278498, "name" => "Earthwerks Incorporated", "slug" => "3278498/earthwerks-incorporated" ],
  [ "id" => 4363725, "name" => "General Motors", "slug" => "4363725/general-motors" ],
  [ "id" => 5737759, "name" => "Kressly Warworks", "slug" => "5737759/kressly-warworks" ],
  [ "id" => 7827270, "name" => "StarCorps Industries", "slug" => "7827270/starcorps-industries" ],
  [ "id" => 8364603, "name" => "Tengo Aerospace", "slug" => "8364603/tengo-aerospace" ]
);

$productTypes = array(
  [ "id" => 13000, "name" => "Aerospace (Jumpship)", "slug" => "13000/aerospace-jumpship" ],
  [ "id" => 23000, "name" => "BattleMech (Assault BattleMech)", "slug" => "23000/battlemech-assault-battlemech" ],
  [ "id" => 22000, "name" => "BattleMech (Heavy BattleMech)", "slug" => "22000/battlemech-heavy-battlemech" ],
  [ "id" => 20000, "name" => "BattleMech (Light BattleMech)", "slug" => "20000/battlemech-light-battlemech" ],
  [ "id" => 21000, "name" => "BattleMech (Medium BattleMech)", "slug" => "21000/battlemech-medium-battlemech" ],
  [ "id" => 51000, "name" => "Component - Armament (Gauss Rifle)", "slug" => "51000/component-armament-gauss-rifle" ],
  [ "id" => 62000, "name" => "Power Plant - Jump Engine (Kearny-Fuchida Drive System)", "slug" => "62000/power-plant-jump-engine-kearny-fuchida-drive-system" ],
  [ "id" => 32000, "name" => "Vehicle (Tracked Vehicle)", "slug" => "32000/vehicle-tracked-vehicle" ]
);

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('index.html');

echo $template->render(array(
  'canonicalLink' => $canonicalLink,
  'searchLetters' => $searchLetters,
  'planets' => $planets,
  'factories' => $factories,
  'productTypes' => $productTypes,
  'copyrightYear' => date('Y')
));
