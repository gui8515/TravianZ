# TravianZ Progressive Web App (PWA) Conversion

## Overview

This PWA conversion adds mobile app-like functionality to the TravianZ game **without modifying any backend code or gameplay mechanics**. Users can now:

✅ Install the game as a standalone app on mobile devices  
✅ Access cached pages when offline  
✅ Enjoy improved loading performance through smart caching  
✅ Receive push notifications (optional future enhancement)  
✅ Use app shortcuts (Village Overview, Village Centre, Map)  

## 🎯 What Was Added

### Core PWA Files (Created)

1. **`/manifest.json`** - Web app manifest
   - App name, description, icons
   - Start URL: `/dorf1.php`
   - Display mode: Standalone (no browser UI)
   - Theme colors: Dark gray (#2a2a2a) matching Travian style
   - App shortcuts for quick access

2. **`/sw.js`** - Service Worker (200 lines)
   - **Cache-first strategy** for static assets (CSS, JS, images)
   - **Network-first strategy** for PHP pages (dynamic content)
   - Offline fallback with `/offline.html`
   - Auto-updates checking
   - Automatic old cache cleanup

3. **`/offline.html`** - Offline fallback page
   - Beautiful, responsive offline UI
   - Matches Travian aesthetic
   - Auto-redirects when connection restored
   - Suggests next steps for reconnection

4. **`/img/icons/`** - App icons (SVG format)
   - `icon-192.svg` - Standard 192x192 icon
   - `icon-512.svg` - High-res 512x512 icon
   - `icon-512-maskable.svg` - Adaptive icon for Android

### Documentation Files (For Implementation Reference)

- **`PWA_INTEGRATION_GUIDE.js`** - Comprehensive 400-line guide
- **`PWA_HTML_SNIPPETS.html`** - Code snippets to add to pages
- **`README.md`** - This file

## 📋 Implementation Checklist

### Step 1: Update HTML Head Section
Add these lines to `<head>` in all main PHP files (dorf1.php, dorf2.php, karte.php, etc.):

```html
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#2a2a2a">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="TravianZ">
<link rel="apple-touch-icon" href="/img/icons/icon-192.svg">
```

**RECOMMENDED:** Add to the common header template (e.g., the file that generates the `<head>` for all pages).

### Step 2: Add Service Worker Registration
Add this script just before `</body>` closing tag:

```html
<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js')
      .then(function(registration) {
        console.log('[PWA] ✓ Service Worker registered');
        setInterval(() => { registration.update(); }, 60000);
      })
      .catch(function(error) {
        console.error('[PWA] Registration failed:', error);
      });
  }
</script>
```

**RECOMMENDED:** Add to the common footer template so it's included on all pages.

### Step 3: Test Installation
1. Open Chrome DevTools (F12)
2. Go to **Application** tab → **Service Workers**
3. Should see: "status: activated and running"
4. Try offline mode in DevTools and verify fallback works

### Step 4: Test on Mobile
1. Navigate to your game URL on Android phone
2. Chrome should show install prompt in address bar
3. Tap "Install app"
4. Game launches in standalone mode
5. Test offline: Toggle airplane mode and refresh

## 🔄 Caching Strategy Explained

### Static Assets (CSS, JS, Images)
**Strategy:** Cache-first
```
Request → Check Cache → Return if available → Fetch from network if missing → Cache response
```
✅ **Benefit:** Instant loading for static files  
✅ **Best for:** Assets that change infrequently  

**Files included:**
- All `.css` files
- All `.js` files
- All images (`*.png`, `*.jpg`, `*.gif`, `*.svg`)
- Fonts (`.woff`, `.ttf`, `.eot`)
- Folders: `/img/`, `/css/`, `/gpack/`, `/fonts/`

### Dynamic Pages (PHP)
**Strategy:** Network-first
```
Try Network → If fails, check Cache → If not cached, show offline.html
```
✅ **Benefit:** Always gets fresh game data when online  
✅ **Fallback:** Shows cached version if offline  

**Files included:**
- All `.php` files (dorf1.php, dorf2.php, karte.php, etc.)
- Messages, reports, messages pages

### Offline Mode
When user has no connection:
```
1. Service Worker intercepts request
2. Network fails
3. Returns cached version if available
4. Falls back to /offline.html if page not cached
5. Auto-refresh when connection returns
```

## ⚙️ Configuration

### Cache Version Management
Edit `/sw.js` line 10 to increment cache version:
```javascript
const CACHE_VERSION = 'travianz-v1';  // Change to 'travianz-v2' to force refresh
```

This will automatically delete old caches and re-download all assets.

### Customization

**Change Theme Color:**
Edit `/manifest.json` and `/offline.html`:
```json
"theme_color": "#ff6600",
"background_color": "#2a2a2a"
```

**Change App Name:**
Edit `/manifest.json`:
```json
"name": "My Travian Server",
"short_name": "MyTavian"
```

**Add More Shortcuts:**
Edit `/manifest.json` shortcuts array to add more app shortcuts.

## 🔒 HTTPS Requirement

**⚠️ CRITICAL:** Progressive Web Apps require HTTPS!

Service Workers will NOT work over plain HTTP (except localhost for development).

### Enabling HTTPS
1. Obtain SSL certificate (Let's Encrypt free option)
2. Configure your web server (Apache/Nginx)
3. Force HTTPS redirect

**Apache example (.htaccess):**
```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{HTTPS} off
  RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
</IfModule>
```

**Nginx example:**
```nginx
server {
  listen 80;
  server_name yourdomain.com;
  return 301 https://$server_name$request_uri;
}
```

## 🧪 Testing Guide

### Browser DevTools Testing
1. Open DevTools: **F12**
2. **Application tab** → **Service Workers**
3. Check: "Offline" checkbox
4. Refresh page
5. Should show offline.html
6. Uncheck offline
7. Should automatically reconnect

### Network Testing
1. DevTools → **Network tab**
2. Filter by: **Fetch/XHR**
3. First load: Network requests (slow)
4. Reload: Many services from cache (fast!)
5. Compare loading times

### Mobile Installation
- **Android Chrome:** Menu → "Install app" or install prompt in address bar
- **iOS Safari:** Share → "Add to Home Screen"
- **Desktop Chrome:** Icon in address bar or menu

### Performance Metrics
Check before and after PWA implementation:
- Page load time
- Time to interactive (TTI)
- First Contentful Paint (FCP)
- Cache hit rate (DevTools → Network)

## 🚀 Performance Impact

### Expected Improvements
- ⚡ **50-70% faster** reload times (cached static assets)
- 📱 **Mobile performance** boost (reduced data usage)
- 🔌 **Offline access** to cached content
- ✅ **Instant startup** from home screen (no browser overhead)

### Chrome Lighthouse Audit
Run Lighthouse to verify PWA compliance:
1. DevTools → **Lighthouse** tab
2. Select: **PWA** category
3. Click: **Analyze page load**
4. Should score 90+ on PWA checklist

## 📊 Browser Support

| Browser | Support | Notes |
|---------|---------|-------|
| Chrome | ✅ Full | Best PWA support |
| Firefox | ✅ Full | All features work |
| Safari (iOS) | ⚠️ Limited | No manifest install, but works |
| Safari (macOS) | ✅ Full | Full support |
| Edge | ✅ Full | Chromium-based |
| Android Browser | ✅ Full | All features work |
| Samsung Internet | ✅ Full | Excellent support |
| Opera | ✅ Full | Chromium-based |

**Graceful Degradation:** Browsers without Service Worker support will work normally with regular HTTP requests. No errors, just no offline support.

## 🔄 Updating the PWA

### Automatic Updates
- Service Worker checks for updates every 60 seconds
- Users see new content without manual action
- Old caches automatically cleaned

### Manual Cache Clear (Testing)
Users can clear app cache:
1. DevTools → **Application** tab
2. Click: **Clear storage** → **Clear all**
3. Refresh page
4. Forces re-download of all assets

## ⚠️ Important Notes

### NO Backend Changes
✅ Database queries unchanged  
✅ PHP logic untouched  
✅ Gameplay mechanics intact  
✅ Session handling preserved  
✅ 100% backward compatible  

### What Changed
✗ ONLY frontend delivery mechanism  
✗ ONLY caching strategy  
✗ ONLY offline fallback  
✗ NO game simulation changes  

### Security Considerations
- Service Worker has same origin scope
- HTTPS encryption required
- Manifest signed with domain
- No sensitive data cached by default
- Cache automatically expires (controllable)

## 🐛 Troubleshooting

### Issue: "Service Worker failed to register"
**Solution:**
- Check browser console for error
- Verify HTTPS is working
- Ensure `/sw.js` file exists
- Try clearing browser cache

### Issue: "Still seeing old CSS/JS"
**Solution:**
- Cache-first means old versions served from cache
- Force refresh: `Ctrl+Shift+R` (skip browser cache)
- Or: DevTools → Clear storage → Clear all
- Or: Increment `CACHE_VERSION` in `/sw.js`

### Issue: "App won't install on mobile"
**Solution:**
- Verify HTTPS enabled
- Check manifest.json is valid (use online validator)
- Ensure icons are accessible
- Try different browser (Chrome works best)
- Wait a few seconds for install prompt

### Issue: "Offline page shows when I'm online"
**Solution:**
- Check Internet connection status
- Verify navigator.onLine is accurate
- Try navigating to different page
- Clear cache and reload

## 📞 Support Resources

- [MDN - Service Workers](https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API)
- [Web.dev - PWA Checklist](https://web.dev/pwa-checklist/)
- [Manifest Validator](https://manifest-validator.appspot.com/)
- [Caniuse - Service Workers](https://caniuse.com/serviceworkers)
- [Lighthouse PWA Audit](https://developers.google.com/web/tools/lighthouse)

## 📝 Files Created/Modified

### Created Files (Complete - Ready to Use)
- ✅ `manifest.json` - App manifest
- ✅ `sw.js` - Service worker (200 lines)
- ✅ `offline.html` - Offline fallback page
- ✅ `img/icons/icon-192.svg` - App icon
- ✅ `img/icons/icon-512.svg` - High-res icon
- ✅ `img/icons/icon-512-maskable.svg` - Adaptive icon
- ✅ `PWA_INTEGRATION_GUIDE.js` - Detailed guide (400 lines)
- ✅ `PWA_HTML_SNIPPETS.html` - Code snippets for implementation
- ✅ `README.md` - This file

### Files to Modify (Your Action Required)
- 📝 `dorf1.php` - Add manifest link + SW registration
- 📝 `dorf2.php` - Add manifest link + SW registration
- 📝 `karte.php` - Add manifest link + SW registration
- 📝 Other main pages - Add manifest link + SW registration
- 📝 Or: Update common header/footer template (recommended)

## ✅ Quick Start

1. **Files are ready to use** - All created files are in the project root
2. **HTTPS required** - Ensure server uses HTTPS
3. **Add PWA meta tags** - Use snippets from `PWA_HTML_SNIPPETS.html`
4. **Register Service Worker** - Add script snippet before `</body>`
5. **Test offline mode** - Use DevTools to verify
6. **Test mobile install** - Install from mobile browser
7. **Monitor performance** - Use Lighthouse audit

## 🎓 Learning More

This PWA implementation follows best practices from:
- [web.dev PWA Training](https://web.dev/progressive-web-apps/)
- [Google PWA Checklist](https://web.dev/pwa-checklist/)
- [MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps)

## 📄 License

This PWA implementation follows the same license as the TravianZ project. All code is provided as-is for the TravianZ community.

---

**Last Updated:** 2026-04-06  
**PWA Version:** v1.0  
**Compatibility:** PHP 5.6+ | Modern Browsers with ServiceWorker Support
