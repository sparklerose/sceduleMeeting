const staticCacheName = 'site-static-v2'; // Increment the version to ensure the browser fetches the updated assets
const dynamicCacheName = 'site-dynamic-v1'; // Cache for dynamic content
const assets = [
    '/', // Root of your site
    '/index.php', // Main entry point
    'fallback.html', // Fallback page (optional)
    'student/student.php', // Student-related pages
    'student/schedule.php',
    'student/profile.php',
    "https://cdn.jsdelivr.net/npm/chart.js", // External libraries
    "https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap", // External fonts
    // Add more assets as needed
];

// Function to trim the cache size by deleting old caches
const limitCacheSize = (cacheName, size) => {
    caches.open(cacheName).then(cache => {
        cache.keys().then(keys => {
            if (keys.length > size) {
                cache.delete(keys[0]).then(limitCacheSize(cacheName, size)); // Recursively call until the cache size is within limit
            }
        });
    });
};

// Install service worker
self.addEventListener('install', evt => {
    // Cache static assets
    evt.waitUntil(
        caches.open(staticCacheName).then(cache => {
            console.log('Caching shell assets');
            return cache.addAll(assets);
        })
    );
});

// Activate service worker
self.addEventListener('activate', evt => {
    // Clean up old caches
    evt.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== staticCacheName && key !== dynamicCacheName)
                .map(key => caches.delete(key))
            );
        })
    );
});

// Fetch event to intercept network requests
self.addEventListener('fetch', evt => {
    // Handle fetch requests
    evt.respondWith(
        caches.match(evt.request).then(cacheRes => {
            // Return cached response if found
            return cacheRes || fetch(evt.request).then(fetchRes => {
                // Cache dynamic responses
                return caches.open(dynamicCacheName).then(cache => {
                    cache.put(evt.request.url, fetchRes.clone());
                    // Check cached items size and limit it
                    limitCacheSize(dynamicCacheName, 15);
                    return fetchRes;
                });
            });
        }).catch(() => {
            // Return fallback page if offline
            return caches.match('/fallback.html');
        })
    );
});

// Listen for push notifications from server indicating updates
self.addEventListener('message', event => {
    if (event.data.action === 'skipWaiting') {
        self.skipWaiting();
    }
});

// Check for updates periodically and refresh the cache
setInterval(() => {
    fetch('/load.php') // Endpoint to check for updates, modify as needed
    .then(response => response.json())
    .then(data => {
        // Compare data from the server with the cached data
        // If there are differences, update the cache accordingly
        // For example:
        // 1. Check for new items and add them to the cache
        // 2. Check for deleted items and remove them from the cache
        // 3. Update existing items in the cache
        // Finally, trigger a page reload to reflect the changes
        self.clients.matchAll().then(clients => {
            clients.forEach(client => {
                client.postMessage('reload');
            });
        });
    })
    .catch(error => {
        console.error('Error checking for updates:', error);
    });
}, 60000); // Interval for checking updates (e.g., every minute)
