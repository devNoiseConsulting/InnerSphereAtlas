module.exports = {
  "globDirectory": "www/",
  "globPatterns": [
    "**/*.{shtml,html,ico,gif,js,json,css}",
    "**/images/ISAtlas*.png",
    "**/images/icon/*.png"
  ],
  importWorkboxFrom: 'disabled',
  importScripts: ['javascript/workbox-v3.0.1'],
  "swDest": "www/sw.js"
};
