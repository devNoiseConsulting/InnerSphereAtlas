<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/canonical-link.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('index.html');

$searchLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

$planets = array(
  2075223 => "A Place",
  2334257 => "Addicks",
  2737000 => "Ares",
  2873870 => "Atreus",
  3363837 => "Demeter",
  4252832 => "Galatea",
  4377378 => "Hesperus II",
  4627270 => "Inarcs",
  5667826 => "Konstance",
  5884436 => "Luthien",
  6390282 => "New Avalon",
  7426000 => "Sian",
  7652747 => "Solaris VII",
  7800483 => "St. Ives",
  8377200 => "Terra",
  8427523 => "Tharkad",
  8456668 => "Tikonov",
  8992767 => "Twycross"
);

$factories = array(
  2243762 => "Achernar BattleMechs",
  2534704 => "Aldis Industries",
  2554263 => "Alliance Mining and Geology",
  2373706 => "Ceres Metals Industries",
  3334263 => "Defiance Industries",
  3278498 => "Earthwerks Incorporated",
  4363725 => "General Motors",
  5737759 => "Kressly Warworks",
  7827270 => "StarCorps Industries",
  8364603 => "Tengo Aerospace"
);

$productTypes = array(
  13000 => "Aerospace (Jumpship)",
  20000 => "BattleMech (Light BattleMech)",
  21000 => "BattleMech (Medium BattleMech)",
  22000 => "BattleMech (Heavy BattleMech)",
  23000 => "BattleMech (Assault BattleMech)",
  51000 => "Component - Armament (Gauss Rifle)",
  62000 => "Power Plant - Jump Engine (Kearny-Fuchida Drive System)",
  32000 => "Vehicle (Tracked Vehicle)"
);

echo $template->render(array(
  'canonicalLink' => $canonicalLink,
  'searchLetters' => $searchLetters,
  'planets' => $planets,
  'factories' => $factories,
  'productTypes' => $productTypes,
  'copyrightYear' => date('Y')
));
