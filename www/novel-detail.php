<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");
require_once("$ISA_LIBDIR/http-header-response.php");
require_once("$ISA_LIBDIR/connect.php");
require_once("$ISA_LIBDIR/canonical-link.php");

if ((count($slug) > 2) && (is_numeric($slug[2]))) {
	$novel = $slug[2];
} else {
	$novel = array_key_exists("$novel", $_GET) ? $_GET["$novel"] : 9;
}
if (empty($novel) || !is_numeric($novel)) { $novel = 9; }

$amp = "";
if ((count($slug) > 4) && ($slug[4] == "amp")) {
	$mobile = true;
} else {
	$mobile = array_key_exists("mobile", $_GET) ? $_GET["mobile"] : false;
}
if ($mobile) {
	$mobile = true;
	$amp = "/amp";
}

include("$ISA_LIBDIR/novel-detail.php");
include("$ISA_LIBDIR/novel-detail-publications.php");
include("$ISA_LIBDIR/novel-detail-timeline.php");

if (array_key_exists("slug", $novelData)) {
	$canonicalLink = $seoLink . "/" . $novelData["slug"];
}

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('novel-detail.html');

echo $template->render(array(
	'canonicalLink' => $canonicalLink,
	'novelData' => $novelData,
	'publisherData' => $publisherData,
	'timeline' => $timeline,
	'copyrightYear' => date('Y')
	));
