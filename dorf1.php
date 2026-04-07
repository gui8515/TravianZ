<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       dorf1.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
use App\Utils\AccessLogger;

include_once("GameEngine/Village.php");
AccessLogger::logRequest();

if(isset($_GET['ok'])){
	$database->updateUserField($session->uid,'ok', 0, 1);
	$_SESSION['ok'] = '0';
}

if(isset($_GET['newdid'])) {
    $_SESSION['wid'] = $_GET['newdid'];
    $database->query("UPDATE ".TB_PREFIX."users SET village_select=".$database->escape((int) $_GET['newdid'])." WHERE id=".$session->uid);  
	header("Location: ".$_SERVER['PHP_SELF']);
	exit;
} 
else $building->procBuild($_GET);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME . ' - Village overview &raquo; ' . $village->vname; ?></title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<link rel="manifest" href="/manifest.json" />
	<meta name="theme-color" content="#2a2a2a" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7i" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css" />
	<?php
	if($session->gpack == null || GP_ENABLE == false) {
	echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	} else {
	echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	}
	?>
	<script type="text/javascript">
	window.addEvent('domready', start);
	</script>
</head>

/**
 * Detect mobile browsers by inspecting the User-Agent string.
 *
 * @return bool True when the request appears to come from a mobile device.
 */
function isMobile() {
    return isset($_SERVER['HTTP_USER_AGENT'])
        && preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);
}

if (isMobile()) {
    include "templates/mobile/dorf1.php";
} else {
    include "templates/desktop/dorf1.php";
}