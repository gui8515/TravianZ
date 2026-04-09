<?php


#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                        		       	               ##
##  Version:       06.03.2014 						                           ##
##  Filename       footer.tpl                                                  ##
##  Developed by:  Advocaite , Shadow , ronix                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				                   ##
##  Source code:   http://github.com/Shadowss/TravianZ/	                       ##
##                                                                             ##
#################################################################################

?>

<?php
$hour = date('Hi');
$day_night_img = ($hour > 1759 || $hour < 500) ? 'night_image' : 'day_image';
$show_plus_info = isset($_SESSION['id_user']) && (int)$_SESSION['id_user'] !== 1;
$plus_active = false;
$plus_until = 0;
if ($show_plus_info && isset($session) && isset($session->plus) && isset($session->userinfo['plus'])) {
	$plus_until = (int)$session->userinfo['plus'];
	$plus_active = ((int)$session->plus === 1 && time() <= $plus_until);
}
?>

<div id="footer">
<div id="mfoot">
<div class="footer-menu">
<center><br />
<div class="copyright">&copy; 2010 - <?php echo date('Y') . ' ' . (defined('SERVER_NAME') ? SERVER_NAME : 'TravianZ');?> All rights reserved</div>
<div class="copyright">▶ Server running on <a href="version.php" style="color: #FF5555; text-decoration: none; font-weight: bold;transition: 0.3s;" onmouseover="this.style.color='#FFAA00'" onmouseout="this.style.color='#FF5555'">v.8.4.α ⚡ Quantum Build 42β
</a>
</div>

<div id="footer_status">
	<div class="status_item" title="Day/Night">
		<img src="img/x.gif" class="<?php echo $day_night_img; ?>" alt="Day/Night" />
	</div>
	<div class="status_item">
		<span>Server time:</span>
		<strong id="footer_server_time"><?php echo date('H:i:s'); ?></strong>
	</div>
	<?php if ($show_plus_info) { ?>
	<div class="status_item">
		<span>Plus:</span>
		<a href="plus.php" class="<?php echo $plus_active ? 'plus_status_active' : 'plus_status_inactive'; ?>">
			<?php echo $plus_active ? 'Active' : 'Inactive'; ?>
		</a>
		<?php if ($plus_active && $plus_until > 0) { ?>
			<span>(until <?php echo date('Y-m-d H:i', $plus_until); ?>)</span>
		<?php } ?>
	</div>
	<?php } ?>
</div>

</div>
</div></center>
<div id="cfoot">
</div>
</div>

<script type="text/javascript">
(function() {
	if (!document.querySelector('link[rel="manifest"]')) {
		var manifest = document.createElement('link');
		manifest.rel = 'manifest';
		manifest.href = '/manifest.json';
		document.head.appendChild(manifest);
	}

	if (!document.querySelector('meta[name="theme-color"]')) {
		var themeColor = document.createElement('meta');
		themeColor.name = 'theme-color';
		themeColor.content = '#2a2a2a';
		document.head.appendChild(themeColor);
	}

	if ('serviceWorker' in navigator) {
		window.addEventListener('load', function() {
			navigator.serviceWorker.register('/sw.js', { scope: '/' }).catch(function() {
				// Keep silent to avoid noisy logs in production.
			});
		});
	}

	function pad2(num) {
		return num < 10 ? '0' + num : '' + num;
	}

	var serverNowTs = <?php echo time(); ?>;
	var serverUtcOffset = <?php echo (int)date('Z'); ?>;
	var clientStartMs = Date.now();

	function updateServerClock() {
		var elapsedSeconds = Math.floor((Date.now() - clientStartMs) / 1000);
		var serverDate = new Date((serverNowTs + serverUtcOffset + elapsedSeconds) * 1000);
		var text = pad2(serverDate.getUTCHours()) + ':' + pad2(serverDate.getUTCMinutes()) + ':' + pad2(serverDate.getUTCSeconds());
		var footerClock = document.getElementById('footer_server_time');
		if (footerClock) {
			footerClock.textContent = text;
		}

		var legacyClock = document.getElementById('tp1');
		if (legacyClock) {
			legacyClock.textContent = text;
		}
	}

	updateServerClock();
	setInterval(updateServerClock, 1000);
})();
</script>
