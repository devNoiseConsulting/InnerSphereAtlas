<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/canonical-link.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('sitemap.html');

$planets = array(
  [ "id" => 2075223, "name" => "A Place", "slug" => "2075223/a-place" ],
  [ "id" => 2562740, "name" => "Alnasi", "slug" => "2562740/alnasi" ],
  [ "id" => 2765560, "name" => "Apollo", "slug" => "2765560/apollo" ],
  [ "id" => 2737000, "name" => "Ares", "slug" => "2737000/ares" ],
  [ "id" => 2873870, "name" => "Atreus", "slug" => "2873870/atreus" ],
  [ "id" => 3437660, "name" => "Dieron", "slug" => "3437660/dieron" ],
  [ "id" => 3774567, "name" => "Epsilon Eridani", "slug" => "3774567/epsilon-eridani" ],
  [ "id" => 4252832, "name" => "Galatea", "slug" => "4252832/galatea" ],
  [ "id" => 4377378, "name" => "Hesperus II", "slug" => "4377378/hesperus-ii" ],
  [ "id" => 4868370, "name" => "Hunter's Paradise", "slug" => "4868370/hunters-paradise" ],
  [ "id" => 5860000, "name" => "Lum", "slug" => "5860000/lum" ],
  [ "id" => 5884436, "name" => "Luthien", "slug" => "5884436/luthien" ],
  [ "id" => 6390282, "name" => "New Avalon", "slug" => "6390282/new-avalon" ],
  [ "id" => 6390327, "name" => "New Earth", "slug" => "6390327/new-earth" ],
  [ "id" => 6390596, "name" => "New Kyoto", "slug" => "6390596/new-kyoto" ],
  [ "id" => 6390726, "name" => "New Samarkand", "slug" => "6390726/new-samarkand" ],
  [ "id" => 6887322, "name" => "Outreach", "slug" => "6887322/outreach" ],
  [ "id" => 7652747, "name" => "Solaris VII", "slug" => "7652747/solaris-vii" ],
  [ "id" => 7800483, "name" => "St. Ives", "slug" => "7800483/st-ives" ],
  [ "id" => 7872620, "name" => "Strana Mechty", "slug" => "7872620/strana-mechty" ],
  [ "id" => 8262700, "name" => "Tamar", "slug" => "8262700/tamar" ],
  [ "id" => 8377200, "name" => "Terra", "slug" => "8377200/terra" ],
  [ "id" => 8427523, "name" => "Tharkad", "slug" => "8427523/tharkad" ],
  [ "id" => 8482260, "name" => "Thuban", "slug" => "8482260/thuban" ],
  [ "id" => 8456668, "name" => "Tikonov", "slug" => "8456668/tikonov" ],
  [ "id" => 8992767, "name" => "Twycross", "slug" => "8992767/twycross" ],
  [ "id" => 9376530, "name" => "Wernke/Talon", "slug" => "9376530/wernke/talon" ],
  [ "id" => 9674400, "name" => "Yorii", "slug" => "9674400/yorii" ]
);

$factories = array(
  [ "id" => 2243762, "name" => "Achernar BattleMechs", "slug" => "2243762/achernar-battlemechs" ],
  [ "id" => 2534706, "name" => "Aldis Industries", "slug" => "2534706/aldis-industries" ],
  [ "id" => 2534704, "name" => "Aldis Industries", "slug" => "2534704/aldis-industries" ],
  [ "id" => 2554263, "name" => "Alliance Mining and Geology", "slug" => "2554263/alliance-mining-and-geology" ],
  [ "id" => 2522593, "name" => "Blackwell Heavy Industries - Blackwell Corporation", "slug" => "2522593/blackwell-heavy-industries-blackwell-corporation" ],
  [ "id" => 2373710, "name" => "Ceres Metals Industries", "slug" => "2373710/ceres-metals-industries" ],
  [ "id" => 2373706, "name" => "Ceres Metals Industries", "slug" => "2373706/ceres-metals-industries" ],
  [ "id" => 2683687, "name" => "Coventry Metal Works", "slug" => "2683687/coventry-metal-works" ],
  [ "id" => 3334263, "name" => "Defiance Industries", "slug" => "3334263/defiance-industries" ],
  [ "id" => 3387649, "name" => "Detroit Consolidated MechWorks", "slug" => "3387649/detroit-consolidated-mechworks" ],
  [ "id" => 3278498, "name" => "Earthwerks Incorporated", "slug" => "3278498/earthwerks-incorporated" ],
  [ "id" => 4258670, "name" => "Galtor Naval Yards", "slug" => "4258670/galtor-naval-yards" ],
  [ "id" => 4363725, "name" => "General Motors", "slug" => "4363725/general-motors" ],
  [ "id" => 4272687, "name" => "Harcourt Industries", "slug" => "4272687/harcourt-industries" ],
  [ "id" => 4633736, "name" => "Independence Weaponry", "slug" => "4633736/independence-weaponry" ],
  [ "id" => 5252782, "name" => "Jalastar Aerospace", "slug" => "5252782/jalastar-aerospace" ],
  [ "id" => 5646786, "name" => "Johnston Industries", "slug" => "5646786/johnston-industries" ],
  [ "id" => 5254093, "name" => "Kali Yama Weapons Industries Incorporated", "slug" => "5254093/kali-yama-weapons-industries-incorporated" ],
  [ "id" => 5255665, "name" => "Kallon Industries", "slug" => "5255665/kallon-industries" ],
  [ "id" => 5737759, "name" => "Kressly Warworks", "slug" => "5737759/kressly-warworks" ],
  [ "id" => 5874820, "name" => "Kurita Combine Munitions Corporation", "slug" => "5874820/kurita-combine-munitions-corporation" ],
  [ "id" => 5884436, "name" => "Luthien Armor Works", "slug" => "5884436/luthien-armor-works" ],
  [ "id" => 7827270, "name" => "StarCorps Industries", "slug" => "7827270/starcorps-industries" ],
  [ "id" => 7835527, "name" => "Stellar Trek", "slug" => "7835527/stellar-trek" ],
  [ "id" => 8287873, "name" => "Taurus Territorial Industries", "slug" => "8287873/taurus-territorial-industries" ],
  [ "id" => 8364603, "name" => "Tengo Aerospace", "slug" => "8364603/tengo-aerospace" ],
  [ "id" => 8427438, "name" => "TharHes Industries", "slug" => "8427438/tharhes-industries" ]
);

$productTypes = array(
  [ "id" => 12000, "name" => "Aerospace (Dropship)", "slug" => "12000/aerospace-dropship" ],
  [ "id" => 13000, "name" => "Aerospace (Jumpship)", "slug" => "13000/aerospace-jumpship" ],
  [ "id" => 10000, "name" => "Aerospace (Light Fighter)", "slug" => "10000/aerospace-light-fighter" ],
  [ "id" => 10100, "name" => "Aerospace (Medium Fighter)", "slug" => "10100/aerospace-medium-fighter" ],
  [ "id" => 23000, "name" => "BattleMech (Assault BattleMech)", "slug" => "23000/battlemech-assault-battlemech" ],
  [ "id" => 27000, "name" => "BattleMech (Assault OmniMech)", "slug" => "27000/battlemech-assault-omnimech" ],
  [ "id" => 22000, "name" => "BattleMech (Heavy BattleMech)", "slug" => "22000/battlemech-heavy-battlemech" ],
  [ "id" => 20000, "name" => "BattleMech (Light BattleMech)", "slug" => "20000/battlemech-light-battlemech" ],
  [ "id" => 21000, "name" => "BattleMech (Medium BattleMech)", "slug" => "21000/battlemech-medium-battlemech" ],
  [ "id" => 40270, "name" => "Component (Communications System)", "slug" => "40270/component-communications-system" ],
  [ "id" => 40220, "name" => "Component (Targeting and Tracking System)", "slug" => "40220/component-targeting-and-tracking-system" ],
  [ "id" => 47003, "name" => "Component - Armament (Autocannon/20)", "slug" => "47003/component-armament-autocannon/20" ],
  [ "id" => 51000, "name" => "Component - Armament (Gauss Rifle)", "slug" => "51000/component-armament-gauss-rifle" ],
  [ "id" => 49003, "name" => "Component - Armament (Ultra Autocannon/20)", "slug" => "49003/component-armament-ultra-autocannon/20" ],
  [ "id" => 60100, "name" => "Component - Armor - Ferro-Fibrous (BattleMechs & Vehicles)", "slug" => "60100/component-armor-ferro-fibrous-battlemechs-vehicles" ],
  [ "id" => 60000, "name" => "Component - Armor - Standard (BattleMechs & Vehicles)", "slug" => "60000/component-armor-standard-battlemechs-vehicles" ],
  [ "id" => 61100, "name" => "Component - Chasiss - Endo Steel (BattleMechs)", "slug" => "61100/component-chasiss-endo-steel-battlemechs" ],
  [ "id" => 61000, "name" => "Component - Chasiss - Standard (BattleMechs)", "slug" => "61000/component-chasiss-standard-battlemechs" ],
  [ "id" => 64100, "name" => "Power Plant (Extra-Light Fusion Engine)", "slug" => "64100/power-plant-extra-light-fusion-engine" ],
  [ "id" => 64000, "name" => "Power Plant (Fusion Engine)", "slug" => "64000/power-plant-fusion-engine" ],
  [ "id" => 62000, "name" => "Power Plant - Jump Engine (Kearny-Fuchida Drive System)", "slug" => "62000/power-plant-jump-engine-kearny-fuchida-drive-system" ],
  [ "id" => 31000, "name" => "Vehicle (Hovercraft)", "slug" => "31000/vehicle-hovercraft" ],
  [ "id" => 32000, "name" => "Vehicle (Tracked Vehicle)", "slug" => "32000/vehicle-tracked-vehicle" ],
  [ "id" => 34000, "name" => "Vehicle (Wheeled Vehicle)", "slug" => "34000/vehicle-wheeled-vehicle" ]
);

$novels = array(
  [ "id" => 11, "name" => "Blood Legacy", "slug" => "11/blood-legacy" ],
  [ "id" => 74, "name" => "Blood of the Isle", "slug" => "74/blood-of-the-isle" ],
  [ "id" => 14, "name" => "Bloodname", "slug" => "14/bloodname" ],
  [ "id" => 63, "name" => "Endgame", "slug" => "63/endgame" ],
  [ "id" => 10, "name" => "Lethal Heritage", "slug" => "10/lethal-heritage" ],
  [ "id" => 56, "name" => "Patriots and Tyrants", "slug" => "56/patriots-and-tyrants" ],
  [ "id" => 78, "name" => "Target Of Opportunity", "slug" => "78/target-of-opportunity" ],
  [ "id" => 75, "name" => "The Scorpion Jar", "slug" => "75/the-scorpion-jar" ],
  [ "id" => 5, "name" => "Warrior: En Garde", "slug" => "5/warrior-en-garde" ],
  [ "id" => 8, "name" => "Wolves on the Border", "slug" => "8/wolves-on-the-border" ]
);

echo $template->render(array(
  'canonicalLink' => $canonicalLink,
  'planets' => $planets,
  'factories' => $factories,
  'productTypes' => $productTypes,
  'novels' => $novels,
  'copyrightYear' => date('Y')
));
