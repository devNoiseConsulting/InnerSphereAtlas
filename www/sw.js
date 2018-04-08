/**
 * Welcome to your Workbox-powered service worker!
 *
 * You'll need to register this file in your web app and you should
 * disable HTTP caching for this file too.
 * See https://goo.gl/nhQhGp
 *
 * The rest of the code is auto-generated. Please don't update this file
 * directly; instead, make changes to your Workbox build configuration
 * and re-run your build process.
 * See https://goo.gl/2aRDsh
 */

importScripts(
  "javascript/workbox-v3.0.1"
);

/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [
  {
    "url": "400.shtml",
    "revision": "2d31a54f1f2763f4b2ae55f94191a10d"
  },
  {
    "url": "401.shtml",
    "revision": "deeb922f721a6a0678fecbe97ae6e264"
  },
  {
    "url": "403.shtml",
    "revision": "d745443ce630301e7b8648150cfb83af"
  },
  {
    "url": "404.shtml",
    "revision": "7e4225ee1793c3484f039b1191ab4956"
  },
  {
    "url": "500.shtml",
    "revision": "4f7a7648d9c703ddc200ee29caf115f6"
  },
  {
    "url": "errors.html",
    "revision": "9986330388a26ebb14962064cd896ed2"
  },
  {
    "url": "favicon.ico",
    "revision": "9e725e8757f79d01e966365a4a2ef5ba"
  },
  {
    "url": "images/factory.gif",
    "revision": "0ca03c3674f0623975c0dd46b2ec319a"
  },
  {
    "url": "images/fluff.gif",
    "revision": "c7a444dac62c0f5f5d23419bba4e6c81"
  },
  {
    "url": "javascript/bootstrap.min.js",
    "revision": "046ba2b5f4cff7d2eaaa1af55caa9fd8"
  },
  {
    "url": "javascript/isatlas.js",
    "revision": "cad31ac33ea866e44c2070bf6579f64c"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-background-sync.dev.js",
    "revision": "36533f650dbb06e4d479e3543e324be8"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-background-sync.prod.js",
    "revision": "d78e2364e41d7fce06419042c1c595c1"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-broadcast-cache-update.dev.js",
    "revision": "776bc201b74b14f8637ab428df9b63cf"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-broadcast-cache-update.prod.js",
    "revision": "934891f61b11e9c051906f53324d159a"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-cache-expiration.dev.js",
    "revision": "1d94eca0a0c20d5c02521cf752545d9d"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-cache-expiration.prod.js",
    "revision": "33750d9ba165fe23f9dea02272db4eda"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-cacheable-response.dev.js",
    "revision": "8b7d6e583bdbc2aba21c560e90beb986"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-cacheable-response.prod.js",
    "revision": "82e09431bd4f19afddee2ade24911529"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-core.dev.js",
    "revision": "1d245db4168ad653c8f5f5d6e63ad2ca"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-core.prod.js",
    "revision": "d63d487fd91e4223a1f5bf87f994cd8d"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-google-analytics.dev.js",
    "revision": "f8633eb9a13ae40486537890fd6db049"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-google-analytics.prod.js",
    "revision": "d246feb57451b67393ef0775cc2362fb"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-precaching.dev.js",
    "revision": "e5aeb8620f27d3c775b1708e25dd2188"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-precaching.prod.js",
    "revision": "047b5fda9a8c02de8c16a7dd13b5b829"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-routing.dev.js",
    "revision": "5a3a5b3ec0d8cb345b90cc31ffeed751"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-routing.prod.js",
    "revision": "129f5adfcbedb0a93121814e68164439"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-strategies.dev.js",
    "revision": "9775b2b9f0af5db8252d614f2807a124"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-strategies.prod.js",
    "revision": "5c404cfe1333803c885a50af87fb90c4"
  },
  {
    "url": "javascript/workbox-v3.0.1/workbox-sw.js",
    "revision": "060adeb4aef35c5028563db0c51afa34"
  },
  {
    "url": "manifest.json",
    "revision": "7d493a2f8bc27e9ab24d8b851c353485"
  },
  {
    "url": "offline.html",
    "revision": "d44875e9b990fe536c4559227d2361e3"
  },
  {
    "url": "pwabuider-sw.js",
    "revision": "af1fcc254647ba2d9e1b57955edbf2be"
  },
  {
    "url": "style/isatlas.css",
    "revision": "f8686a15c67827af68832ce236256ae6"
  },
  {
    "url": "images/ISAtlas_696x512.png",
    "revision": "e979fa60f7afc60fa4cb46e663b99773"
  },
  {
    "url": "images/ISAtlasPublisher_600x60.png",
    "revision": "35f5bc87ff4bfb810e8219e087fb8830"
  },
  {
    "url": "images/ISAtlasTwitterCard.png",
    "revision": "2f56731d90b221a9ccfec3c16d422670"
  },
  {
    "url": "images/ISAtlasTwitterFactory.png",
    "revision": "1d68b714fed0eedc232185f24d06fc1e"
  },
  {
    "url": "images/ISAtlasTwitterMap.png",
    "revision": "1210931595b445caf717ff851d48f4c8"
  },
  {
    "url": "images/ISAtlasTwitterNovel.png",
    "revision": "8ca3e7c5dda1a4b8a2392f438185e9d3"
  },
  {
    "url": "images/ISAtlasTwitterProduct.png",
    "revision": "e4d539fbe4dc7422c69234e4f2bc50d9"
  },
  {
    "url": "images/icon/isatlas-1024x1024.png",
    "revision": "a536e0849dc2cc938a4dd7edcb217edc"
  },
  {
    "url": "images/icon/isatlas-114x114.png",
    "revision": "a7df7dcb083b3a62d1ae1f58069dd420"
  },
  {
    "url": "images/icon/isatlas-120x120.png",
    "revision": "df77ec18ab765720443dee6fc56391d0"
  },
  {
    "url": "images/icon/isatlas-1240x600.png",
    "revision": "dbd4c5a1d50ae5a99720e3559635c104"
  },
  {
    "url": "images/icon/isatlas-144x144.png",
    "revision": "66e43dd17da4a2df84dab4685f05dc3b"
  },
  {
    "url": "images/icon/isatlas-150x150.png",
    "revision": "e59d39b77dcc781601ccc149b95c76d5"
  },
  {
    "url": "images/icon/isatlas-152x152.png",
    "revision": "1c50b638eaf4f552bf1aee4a64e71dbf"
  },
  {
    "url": "images/icon/isatlas-180x180.png",
    "revision": "9b042541d185795496e324b3a85ccff3"
  },
  {
    "url": "images/icon/isatlas-192x192.png",
    "revision": "4a5873ebf33623e981391f055f30beeb"
  },
  {
    "url": "images/icon/isatlas-24x24.png",
    "revision": "7e6a66521f13209895d1ab284e714ec4"
  },
  {
    "url": "images/icon/isatlas-300x300.png",
    "revision": "2ff907962b7adea5d947ac97eb9c2b4b"
  },
  {
    "url": "images/icon/isatlas-36x36.png",
    "revision": "7a47b7d8e4eed4ad5dd19c1e27faf7e0"
  },
  {
    "url": "images/icon/isatlas-48x48.png",
    "revision": "7fed1fa2fef906220612668e3d2c69c6"
  },
  {
    "url": "images/icon/isatlas-50x50.png",
    "revision": "660237279730e28a86466152c08de97c"
  },
  {
    "url": "images/icon/isatlas-512x512.png",
    "revision": "2b48a1c3ed85965cf93e205b7ad41187"
  },
  {
    "url": "images/icon/isatlas-57x57.png",
    "revision": "fc23d629237df3ee478afa7a11222987"
  },
  {
    "url": "images/icon/isatlas-620x300.png",
    "revision": "b32e44333cf6aa2362e738636e17e3dc"
  },
  {
    "url": "images/icon/isatlas-72x72.png",
    "revision": "98d8f9351ab19680c6d996f07b107681"
  },
  {
    "url": "images/icon/isatlas-76x76.png",
    "revision": "a46ffbb8acacd6c41b07f675bfa9134d"
  },
  {
    "url": "images/icon/isatlas-88x88.png",
    "revision": "ccaad8a032c689a6e3226b46267a69e8"
  },
  {
    "url": "images/icon/isatlas-96x96.png",
    "revision": "239238f811cd3083d49c63ec9342d353"
  }
].concat(self.__precacheManifest || []);
workbox.precaching.suppressWarnings();
workbox.precaching.precacheAndRoute(self.__precacheManifest, {});
