/**
 * TravianZ Progressive Web App - Service Worker
 * 
 * This service worker implements a hybrid caching strategy:
 * - Cache-first: For static assets (CSS, JS, images, icons)
 * - Network-first: For PHP pages (dynamic content)
 * - Offline fallback: For network failures
 * 
 * NO backend logic is modified. This only optimizes frontend delivery.
 */

const CACHE_VERSION = 'travianz-v1';
const STATIC_CACHE = CACHE_VERSION + '-static';
const DYNAMIC_CACHE = CACHE_VERSION + '-dynamic';
const OFFLINE_PAGE = '/offline.html';

// Assets to pre-cache on service worker install
const ESSENTIAL_ASSETS = [
  '/',
  '/dorf1.php',
  '/dorf2.php',
  '/karte.php',
  '/login.php',
  '/offline.html',
  '/manifest.json'
];

// Static file extensions to cache (CSS, JS, images, fonts)
const STATIC_EXTENSIONS = [
  '.css',
  '.js',
  '.png',
  '.jpg',
  '.jpeg',
  '.gif',
  '.svg',
  '.woff',
  '.woff2',
  '.ttf',
  '.eot'
];

/**
 * INSTALL EVENT
 * Runs when the service worker is first installed
 * Pre-caches essential assets
 */
self.addEventListener('install', event => {
  console.log('[SW] Installing service worker...');
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then(cache => {
        console.log('[SW] Pre-caching essential assets');
        return cache.addAll(ESSENTIAL_ASSETS);
      })
      .then(() => self.skipWaiting())
      .catch(err => console.error('[SW] Install failed:', err))
  );
});

/**
 * ACTIVATE EVENT
 * Runs after service worker is installed and old versions are cleared
 * Removes old caches to save storage space
 */
self.addEventListener('activate', event => {
  console.log('[SW] Activating service worker...');
  event.waitUntil(
    caches.keys()
      .then(cacheNames => {
        return Promise.all(
          cacheNames.map(cacheName => {
            // Delete old cache versions
            if (!cacheName.startsWith(CACHE_VERSION)) {
              console.log('[SW] Deleting old cache:', cacheName);
              return caches.delete(cacheName);
            }
          })
        );
      })
      .then(() => self.clients.claim())
  );
});

/**
 * FETCH EVENT
 * Intercepts all network requests and applies caching strategies
 */
self.addEventListener('fetch', event => {
  const { request } = event;
  const url = new URL(request.url);

  // Skip cross-origin requests
  if (url.origin !== location.origin) {
    return;
  }

  // Skip WebSocket and data: URLs
  if (url.protocol !== 'http:' && url.protocol !== 'https:') {
    return;
  }

  // Determine if this is a static asset or dynamic page
  const isStaticAsset = isStaticFile(url.pathname);

  if (isStaticAsset) {
    // CACHE-FIRST STRATEGY for static assets
    // Use cached version if available, fall back to network
    event.respondWith(cacheFirst(request));
  } else {
    // NETWORK-FIRST STRATEGY for PHP pages
    // Try network first, fall back to cache, then offline page
    event.respondWith(networkFirst(request));
  }
});

/**
 * CACHE-FIRST STRATEGY
 * Returns cached version if available, otherwise fetches from network
 * Best for: CSS, JS, images, fonts (assets that change infrequently)
 */
function cacheFirst(request) {
  return caches.match(request)
    .then(response => {
      // Return cached response if found
      if (response) {
        console.log('[SW] Cache hit:', request.url);
        return response;
      }

      // Fetch from network if not cached
      console.log('[SW] Cache miss, fetching from network:', request.url);
      return fetch(request)
        .then(response => {
          // Don't cache unsuccessful responses
          if (!response || response.status !== 200 || response.type === 'error') {
            return response;
          }

          // Cache successful responses for static assets
          const responseToCache = response.clone();
          caches.open(STATIC_CACHE)
            .then(cache => {
              cache.put(request, responseToCache);
            });
          return response;
        })
        .catch(error => {
          console.error('[SW] Fetch failed:', request.url, error);
          // Return offline page for failed requests
          return caches.match(OFFLINE_PAGE)
            .then(response => response || new Response('Offline - Page not available', {
              status: 503,
              statusText: 'Service Unavailable'
            }));
        });
    });
}

/**
 * NETWORK-FIRST STRATEGY
 * Tries network first, falls back to cache, then offline page
 * Best for: PHP pages with dynamic content that need fresh data
 */
function networkFirst(request) {
  return fetch(request)
    .then(response => {
      // Don't cache error responses
      if (!response || response.status !== 200) {
        return response;
      }

      // Cache successful dynamic responses
      const responseToCache = response.clone();
      caches.open(DYNAMIC_CACHE)
        .then(cache => {
          cache.put(request, responseToCache);
        });
      return response;
    })
    .catch(error => {
      console.error('[SW] Network request failed:', request.url, error);
      
      // Try to return cached version
      return caches.match(request)
        .then(response => {
          if (response) {
            console.log('[SW] Returning cached dynamic response:', request.url);
            return response;
          }

          // Return offline page as final fallback
          console.log('[SW] Returning offline fallback page');
          return caches.match(OFFLINE_PAGE)
            .then(response => response || new Response('Offline - Page not available', {
              status: 503,
              statusText: 'Service Unavailable'
            }));
        });
    });
}

/**
 * Determines if a URL is a static asset
 * @param {string} pathname - The URL pathname
 * @returns {boolean} - True if the file appears to be a static asset
 */
function isStaticFile(pathname) {
  // Check file extension
  for (let ext of STATIC_EXTENSIONS) {
    if (pathname.endsWith(ext)) {
      return true;
    }
  }

  // Some paths always considered static
  const staticPaths = ['/img/', '/css/', '/gpack/', '/fonts/', '/icons/'];
  for (let path of staticPaths) {
    if (pathname.startsWith(path)) {
      return true;
    }
  }

  return false;
}

/**
 * BACKGROUND SYNC (Optional) 
 * Can be added to queue game actions while offline and sync when back online
 */
self.addEventListener('sync', event => {
  if (event.tag === 'travianz-sync') {
    event.waitUntil(
      // Queue sync logic here if needed in the future
      Promise.resolve()
    );
  }
});

/**
 * PUSH NOTIFICATIONS (Optional)
 * Can send notifications about game events
 */
self.addEventListener('push', event => {
  if (event.data) {
    const data = event.data.json();
    const options = {
      body: data.body || 'TravianZ Update',
      icon: '/img/icons/icon-192.png',
      badge: '/img/icons/icon-192.png',
      tag: 'travianz-notification'
    };
    event.waitUntil(self.registration.showNotification(data.title || 'TravianZ', options));
  }
});

console.log('[SW] Service Worker loaded and ready');
