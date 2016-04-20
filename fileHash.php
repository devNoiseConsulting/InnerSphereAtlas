<?php

require_once("./www/isatlas-config.php");

$files = array (
  "index.php" => array (
  "$ISA_DOCROOTDIR/index.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_TEMPLATEDIR/index.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "factory.php" => array (
  "$ISA_DOCROOTDIR/factory.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/factory-overview.php",
  "$ISA_LIBDIR/next_prev.php",
  "$ISA_TEMPLATEDIR/factory.html",
  "$ISA_TEMPLATEDIR/factory-overview.html",
  "$ISA_TEMPLATEDIR/next_prev.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "factory-detail.php" => array (
  "$ISA_DOCROOTDIR/factory-detail.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/factory-detail.php",
  "$ISA_LIBDIR/product_component.php",
  "$ISA_TEMPLATEDIR/factory-detail.html",
  "$ISA_TEMPLATEDIR/factory-detail-detail.html",
  "$ISA_TEMPLATEDIR/product_component.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "novel.php" => array (
  "$ISA_DOCROOTDIR/novel.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/novel-overview.php",
  "$ISA_LIBDIR/next_prev.php",
  "$ISA_TEMPLATEDIR/novel.html",
  "$ISA_TEMPLATEDIR/next_prev.html",
  "$ISA_TEMPLATEDIR/novel-overview.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "novel-timeline.php" => array (
  "$ISA_DOCROOTDIR/novel-timeline.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/novel-timeline-overview.php",
  "$ISA_LIBDIR/next_prev.php",
  "$ISA_TEMPLATEDIR/novel-timeline.html",
  "$ISA_TEMPLATEDIR/next_prev.html",
  "$ISA_TEMPLATEDIR/novel-timeline-overview.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "novel-detail.php" => array (
  "$ISA_DOCROOTDIR/novel-detail.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/novel-detail.php",
  "$ISA_LIBDIR/novel-detail-publications.php",
  "$ISA_LIBDIR/novel-detail-timeline.php",
  "$ISA_TEMPLATEDIR/novel-detail.html",
  "$ISA_TEMPLATEDIR/novel-detail-detail.html",
  "$ISA_TEMPLATEDIR/novel-detail-publications.html",
  "$ISA_TEMPLATEDIR/amazon-link.html",
  "$ISA_TEMPLATEDIR/novel-detail-timeline.html",
  "$ISA_TEMPLATEDIR/legend.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "planet.php" => array (
  "$ISA_DOCROOTDIR/planet.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/planet-overview.php",
  "$ISA_LIBDIR/next_prev.php",
  "$ISA_TEMPLATEDIR/planet.html",
  "$ISA_TEMPLATEDIR/next_prev.html",
  "$ISA_TEMPLATEDIR/planet-overview.html",
  "$ISA_TEMPLATEDIR/legend.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "planet-detail.php" => array (
  "$ISA_DOCROOTDIR/planet-detail.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/planet-detail.php",
  "$ISA_LIBDIR/planet-detail-ownership.php",
  "$ISA_LIBDIR/planet-detail-factory.php",
  "$ISA_LIBDIR/planet-detail-neighbors.php",
  "$ISA_LIBDIR/planet-detail-novels.php",
  "$ISA_TEMPLATEDIR/planet-detail.html",
  "$ISA_TEMPLATEDIR/planet-detail-factory.html",
  "$ISA_TEMPLATEDIR/planet-detail-neighbors.html",
  "$ISA_TEMPLATEDIR/legend.html",
  "$ISA_TEMPLATEDIR/planet-detail-novels.html",
  "$ISA_TEMPLATEDIR/amazon-link.html",
  "$ISA_TEMPLATEDIR/planet-detail-ownership.html",
  "$ISA_TEMPLATEDIR/planet-detail-data.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "product-type.php" => array (
  "$ISA_DOCROOTDIR/product-type.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/product-type-overview.php",
  "$ISA_LIBDIR/next_prev.php",
  "$ISA_TEMPLATEDIR/product-type.html",
  "$ISA_TEMPLATEDIR/next_prev.html",
  "$ISA_TEMPLATEDIR/product-type-overview.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "product-type-detail.php" => array (
  "$ISA_DOCROOTDIR/product-type-detail.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_LIBDIR/product-type-detail.php",
  "$ISA_LIBDIR/next_prev.php",
  "$ISA_TEMPLATEDIR/product-type-detail.html",
  "$ISA_TEMPLATEDIR/next_prev.html",
  "$ISA_TEMPLATEDIR/product-type-detail-detail.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "sitemap.php" => array (
  "$ISA_DOCROOTDIR/sitemap.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_TEMPLATEDIR/sitemap.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "system-map.php" => array (
  "$ISA_DOCROOTDIR/system-map.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  "$ISA_TEMPLATEDIR/system-map.html",
  "$ISA_TEMPLATEDIR/footer.html",
  "$ISA_TEMPLATEDIR/cya.html",
  ),
  "system-map-svg.php" => array (
  "$ISA_DOCROOTDIR/system-map-svg.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  ),
  "system-map-svg-double.php" => array (
  "$ISA_DOCROOTDIR/system-map-svg-double.php",
  "$ISA_DOCROOTDIR/isatlas-config.php",
  "$ISA_LIBDIR/connect.php",
  "$ISA_LIBDIR/canonical-link.php",
  )
);

$eTagData = array(
  "fingerPrint" => array(),
  "fileAge" => array()
);
foreach ($files as $key => $value) {
  $fingerPrint = "";
  $newestFileTime = 0;
  foreach ($value as $file) {
    $fileTime = filemtime($file);
    $fingerPrint .= $file . "-" . $fileTime . ":";
    if ($newestFileTime < $fileTime) {
      $newestFileTime = $fileTime;
    }
  }
  $eTagData["fingerPrint"][$key] = hash('whirlpool', $fingerPrint);
  $eTagData["fileAge"][$key] = $fileTime;

  print $key . " - " . $eTagData["fileAge"][$key] . " - " . $eTagData["fingerPrint"][$key] ."\n";
}

$fileName =  "$ISA_LIBDIR/hash-fragments.ser";
file_put_contents($fileName, serialize($eTagData));
