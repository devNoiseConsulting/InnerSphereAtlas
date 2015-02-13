<?php

require_once('../vendor/autoload.php');

require_once("./isatlas-config.php");

$loader = new Twig_Loader_Filesystem($ISA_TEMPLATEDIR);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('index.html');

echo $template->render();
