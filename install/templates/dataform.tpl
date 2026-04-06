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
				</td>
			</tr>
		</table>
	</p>
</form>
</div>
