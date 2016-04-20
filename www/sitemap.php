<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/canonical-link.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('sitemap.html');

$planets = array(
  2075223 => "A Place",
  2562740 => "Alnasi",
  2765560 => "Apollo",
  2737000 => "Ares",
  2873870 => "Atreus",
  3437660 => "Dieron",
  3774567 => "Epsilon Eridani",
  4252832 => "Galatea",
  4377378 => "Hesperus II",
  4868370 => "Hunter's Paradise",
  5860000 => "Lum",
  5884436 => "Luthien",
  6390282 => "New Avalon",
  6390327 => "New Earth",
  6390596 => "New Kyoto",
  6390726 => "New Samarkand",
  6887322 => "Outreach",
  7652747 => "Solaris VII",
  7800483 => "St. Ives",
  7872620 => "Strana Mechty",
  8262700 => "Tamar",
  8377200 => "Terra",
  8427523 => "Tharkad",
  8482260 => "Thuban",
  8456668 => "Tikonov",
  8992767 => "Twycross",
  9376530 => "Wernke/Talon",
  9674400 => "Yorii"
);

$factories = array(
  2243762 => "Achernar BattleMechs",
  2534706 => "Aldis Industries",
  2534704 => "Aldis Industries",
  2554263 => "Alliance Mining and Geology",
  2522593 => "Blackwell Heavy Industries - Blackwell Corporation",
  2373710 => "Ceres Metals Industries",
  2373706 => "Ceres Metals Industries",
  2683687 => "Coventry Metal Works",
  3334263 => "Defiance Industries",
  3387649 => "Detroit Consolidated MechWorks",
  3278498 => "Earthwerks Incorporated",
  4258670 => "Galtor Naval Yards",
  4363725 => "General Motors",
  4272687 => "Harcourt Industries",
  4633736 => "Independence Weaponry",
  5252782 => "Jalastar Aerospace",
  5646786 => "Johnston Industries",
  5254093 => "Kali Yama Weapons Industries Incorporated",
  5255665 => "Kallon Industries",
  5737759 => "Kressly Warworks",
  5874820 => "Kurita Combine Munitions Corporation",
  5884436 => "Luthien Armor Works",
  7827270 => "StarCorps Industries",
  7835527 => "Stellar Trek",
  8287873 => "Taurus Territorial Industries",
  8364603 => "Tengo Aerospace",
  8427438 => "TharHes Industries"
);

$productTypes = array(
  12000 => "Aerospace (Dropship)",
  13000 => "Aerospace (Jumpship)",
  10000 => "Aerospace (Light Fighter)",
  10100 => "Aerospace (Medium Fighter)",
  23000 => "BattleMech (Assault BattleMech)",
  27000 => "BattleMech (Assault OmniMech)",
  22000 => "BattleMech (Heavy BattleMech)",
  20000 => "BattleMech (Light BattleMech)",
  21000 => "BattleMech (Medium BattleMech)",
  40270 => "Component (Communications System)",
  40220 => "Component (Targeting and Tracking System)",
  47003 => "Component - Armament (Autocannon/20)",
  51000 => "Component - Armament (Gauss Rifle)",
  49003 => "Component - Armament (Ultra Autocannon/20)",
  60100 => "Component - Armor - Ferro-Fibrous (BattleMechs & Vehicles)",
  60000 => "Component - Armor - Standard (BattleMechs & Vehicles)",
  61100 => "Component - Chasiss - Endo Steel (BattleMechs)",
  61000 => "Component - Chasiss - Standard (BattleMechs)",
  64100 => "Power Plant (Extra-Light Fusion Engine)",
  64000 => "Power Plant (Fusion Engine)",
  62000 => "Power Plant - Jump Engine (Kearny-Fuchida Drive System)",
  31000 => "Vehicle (Hovercraft)",
  32000 => "Vehicle (Tracked Vehicle)",
  34000 => "Vehicle (Wheeled Vehicle)"
);

$novels = array(
  11 => "Blood Legacy",
  74 => "Blood of the Isle",
  14 => "Bloodname",
  63 => "Endgame",
  10 => "Lethal Heritage",
  56 => "Patriots and Tyrants",
  78 => "Target Of Opportunity",
  75 => "The Scorpion Jar",
  5 => "Warrior: En Garde",
  8 => "Wolves on the Border"
);

echo $template->render(array(
  'canonicalLink' => $canonicalLink,
  'planets' => $planets,
  'factories' => $factories,
  'productTypes' => $productTypes,
  'novels' => $novels,
  'copyrightYear' => date('Y')
));
