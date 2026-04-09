<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       header.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>

<div id="header">
  <div id="mtop">
    <div class="top-nav">
      <a href="<?php echo ($_SESSION['id_user'] != 1 ? 'dorf1.php' : '#'); ?>" id="n1" accesskey="1"><img src="img/x.gif" title="Village overview" alt="Village overview" /></a>
      <a href="<?php echo ($_SESSION['id_user'] != 1 ? 'dorf2.php' : '#'); ?>" id="n2" accesskey="2"><img src="img/x.gif" title="Village centre" alt="Village centre" /></a>
      <a href="karte.php" id="n3" accesskey="3"><img src="img/x.gif" title="Map" alt="Map" /></a>
      <a href="statistiken.php" id="n4" accesskey="4"><img src="img/x.gif" title="Statistics" alt="Statistics" /></a>
    <?php
    if ($message->unread && !$message->nunread) {
      $class = "i2";
    } else if (!$message->unread && $message->nunread) {
      $class = "i3";
    } else if ($message->unread && $message->nunread) {
      $class = "i1";
    } else {
      $class = "i4";
    }
    ?>
    <div id="n5" class="<?php echo $class ?>">
      <a href="<?php echo ($_SESSION['id_user'] != 1 ? 'berichte.php' : '#'); ?>" accesskey="5"><img src="img/x.gif" class="l" title="Reports" alt="Reports" /></a>
      <a href="nachrichten.php" accesskey="6"><img src="img/x.gif" class="r" title="Messages" alt="Messages" /></a>
    </div>
    </div>
    <div class="clear"></div>
  </div>
</div>