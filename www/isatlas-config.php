<?php
	date_default_timezone_set('UTC');

	# Constants for Canonical Links
	$ISA_CANONICAL_PROTOCOL = "HTTP";

	# Constants for Filepaths
	$ISA_LIBDIR = "<path_to>/lib";
	$ISA_CACHEDIR = "<path_to>/cache";
	$ISA_DOCROOTDIR = "<path_to>/www";
	$ISA_TEMPLATEDIR = "<path_to>/templates";
	$ISA_WEBDIR = "";

	# Constants for SVG Maps
	$ISA_MAP_SIZE = 840;
	$ISA_MAP_RADIUS = 60;
	$ISA_MAP_OFFSET = $ISA_MAP_SIZE / 2;
	$ISA_MAP_SCALE = $ISA_MAP_SIZE / $ISA_MAP_RADIUS / 2;
	$ISA_MAP_PLANET_DIAMETER = 7;
	$ISA_MAP_PLANET_RADIUS = $ISA_MAP_PLANET_DIAMETER / 2;
	$ISA_MAP_TITLE_OFFSET = floor(($ISA_MAP_PLANET_DIAMETER + 1) / 2);
?>
