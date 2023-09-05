importScripts("https://js.pusher.com/beams/service-worker.js");
var CACHE_NAME = "cache-up-v2";

self.addEventListener("install", function (evt) {
    evt.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll([
                "offline.html",
                "assets/app/css/app.css",
                "logo/logo.png",
                "logo/favicon.ico",
                "assets/app/js/app.js",
            ]);
        })
    );
    self.skipWaiting();
});

self.addEventListener("activate", function (evt) {
    evt.waitUntil(
        caches.keys().then(function (keyList) {
            return Promise.all(
                keyList.map(function (key) {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

self.addEventListener("fetch", function (evt) {
    if (evt.request.mode !== "navigate") {
        return;
    }
    evt.respondWith(
        fetch(evt.request).catch(function () {
            return caches.open(CACHE_NAME).then(function (cache) {
                return cache.match("/offline.html");
            });
        })
    );
});
