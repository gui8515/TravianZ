<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       dataform.tpl                                                ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################
include_once('../GameEngine/config.php');

if(isset($_GET['c']) && $_GET['c'] == 1) {
	echo "<div class=\"headline\"><span class=\"f10 c5\">".install_h('dataform_err_import_db', 'Error importing database. Check configuration.')."</span></div><br>";
}

if(isset($_GET['err']) && $_GET['err'] == 1) {
	echo "<br /><hr /><br /><div class=\"headline\"><span class=\"f10 c5\">".install_h('dataform_err_existing_structure_a', 'Existing structure was found in the database. Please remove old game tables with prefix')." <i>".TB_PREFIX."</i> " . install_h('dataform_err_existing_structure_b', 'from database') . " '<strong>".SQL_DB."</strong>' " . install_h('dataform_err_existing_structure_c', 'before continuing.') . "</span></div><br /><br />";
}
?>
<form action="process.php" method="post" id="dataform">
	<input type="hidden" name="substruc" value="1">

	<p>
	    <span class="f10 c"><?php echo install_h('dataform_title', 'Create Database Structure'); ?></span>
	
		<table>
			<tr>
				<td>
					<b><?php echo install_h('common_warning', 'Warning'); ?></b>: <?php echo install_h('dataform_warning_text', 'This can take some time. Please wait until the next page has loaded. Click Create to proceed...'); ?>
					<br>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<input type="submit" name="Submit" id="Submit" value="<?php echo install_h('common_create', 'Create...'); ?>" onClick="return proceed()">
						<br>
						<br>
					</center>

					<div id="dbProgressBox" style="display:none; margin:10px auto; max-width:500px; text-align:left;">
						<div style="font-weight:bold; margin-bottom:6px;"><?php echo install_h('dataform_live_progress', 'Database creation progress'); ?></div>
						<div style="background:#ddd; border-radius:8px; overflow:hidden; height:20px;">
							<div id="dbPbar" style="background:#f6a21a; height:100%; width:0%; transition:width .2s;"></div>
						</div>
						<div id="dbPinfo" style="margin-top:6px; font-size:13px; color:#333;"><?php echo install_h('dataform_waiting', 'Waiting to start...'); ?></div>
						<pre id="dbPlog" style="margin-top:10px; background:#f9f9f9; border:1px solid #ddd; border-radius:8px; padding:8px; font-size:12px; max-height:220px; overflow:auto;"></pre>
						<div id="dbNext" style="display:none; margin-top:10px; color:#222;"><?php echo install_h('dataform_proceed_next_in', 'Proceeding to next step in'); ?> <b id="dbCd">2</b>...</div>
					</div>
				</td>
			</tr>
		</table>
	</p>
</form>

<script type="text/javascript">
(function () {
	var form = document.getElementById('dataform');
	var submitBtn = document.getElementById('Submit');
	var progressBox = document.getElementById('dbProgressBox');
	var pbar = document.getElementById('dbPbar');
	var pinfo = document.getElementById('dbPinfo');
	var plog = document.getElementById('dbPlog');
	var nextBox = document.getElementById('dbNext');
	var nextCd = document.getElementById('dbCd');

	var I18N = {
		creating: <?php echo json_encode(install_t('dataform_js_creating', 'Creating...')); ?>,
		liveNotSupported: <?php echo json_encode(install_t('dataform_js_live_not_supported', 'Your browser does not support live progress.')); ?>,
		reconnected: <?php echo json_encode(install_t('dataform_js_reconnected', 'Reconnected to server.')); ?>,
		success: <?php echo json_encode(install_t('dataform_js_success', 'Database structure created successfully.')); ?>,
		serverError: <?php echo json_encode(install_t('dataform_js_server_error', 'Server error while creating database structure.')); ?>,
		connectionHiccup: <?php echo json_encode(install_t('dataform_js_connection_hiccup', 'Connection hiccup')); ?>,
		retrying: <?php echo json_encode(install_t('dataform_js_retrying', 'retrying...')); ?>,
		tooManyFailures: <?php echo json_encode(install_t('dataform_js_too_many_failures', 'Too many connection failures. Please retry.')); ?>
	};

	function appendLog(msg) {
		if (!msg) {
			return;
		}
		plog.textContent += msg + "\n";
		plog.scrollTop = plog.scrollHeight;
	}

	function startCountdown(nextUrl) {
		var left = 2;
		nextBox.style.display = 'block';
		nextCd.textContent = String(left);
		var timer = setInterval(function () {
			left--;
			nextCd.textContent = String(left);
			if (left <= 0) {
				clearInterval(timer);
				window.location.href = nextUrl || 'index.php?s=3';
			}
		}, 1000);
	}

	function setRunningUi() {
		submitBtn.disabled = true;
		submitBtn.value = I18N.creating;
		progressBox.style.display = 'block';
		pbar.style.width = '0%';
		pinfo.textContent = '0%';
		nextBox.style.display = 'none';
		plog.textContent = '';
	}

	function setIdleUi() {
		submitBtn.disabled = false;
		submitBtn.value = <?php echo json_encode(install_t('common_create', 'Create...')); ?>;
	}

	form.addEventListener('submit', function (ev) {
		if (!('EventSource' in window)) {
			appendLog(I18N.liveNotSupported);
			return;
		}

		ev.preventDefault();
		setRunningUi();

		var retries = 0;
		var maxRetries = 3;
		var finished = false;
		var es = new EventSource('ajax_structure.php');

		es.onopen = function () {
			if (!finished && retries > 0) {
				appendLog(I18N.reconnected);
			}
		};

		es.onmessage = function (e) {
			if (!e.data || e.data.charCodeAt(0) !== 123) {
				return;
			}

			var d;
			try {
				d = JSON.parse(e.data);
			} catch (err) {
				return;
			}

			if (finished) {
				return;
			}

			retries = 0;
			var pct = (d.pct || 0) | 0;
			pbar.style.width = pct + '%';
			if (d.total && d.total > 0) {
				pinfo.textContent = (d.done || 0) + ' / ' + d.total + ' (' + pct + '%)';
			} else {
				pinfo.textContent = pct + '%';
			}

			appendLog(d.msg || '');

			if (d.error) {
				finished = true;
				es.close();
				appendLog(I18N.serverError);
				setIdleUi();
				return;
			}

			if (d.ok || pct >= 100) {
				finished = true;
				es.close();
				appendLog(I18N.success);
				startCountdown(d.next || 'index.php?s=3');
			}
		};

		es.onerror = function () {
			if (finished) {
				return;
			}

			retries++;
			appendLog(I18N.connectionHiccup + ' (' + retries + '/' + maxRetries + '), ' + I18N.retrying);

			if (retries >= maxRetries) {
				finished = true;
				es.close();
				appendLog(I18N.tooManyFailures);
				setIdleUi();
			}
		};
	});
})();
</script>
</div>
