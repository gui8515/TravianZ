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