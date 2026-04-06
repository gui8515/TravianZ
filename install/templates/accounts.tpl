<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       multihunter.tpl                                             ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ##
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################

if(isset($_GET['err']) && $_GET['err'] == 1) {
	echo "<br /><hr /><br /><div class=\"headline\"><span class=\"f10 c5\">".install_h('acc_err_required_passwords', 'At least Multihunter and Support passwords are required in this form.')."</span></div><br /><br />";
}

if(isset($_GET['err']) && $_GET['err'] == 2) {
    echo "<br /><hr /><br /><div class=\"headline\"><span class=\"f10 c5\">".install_h('acc_err_natars_reserved', 'Natars is a reserved username for an in-game NPC tribe. Please choose a different admin username.')."</span></div><br /><br />";
}

?>

<form action="include/accounts.php" method="post" id="dataform">

<p>
    <span class="f10 c"><?php echo install_h('acc_section_mh', 'Multihunter account'); ?></span>
		<table>
            <tr><td><?php echo install_h('acc_name', 'Name:'); ?></td><td><input type="text" name="mhuser" id="mhuser" value="Multihunter" disabled="disabled"></td></tr>
            <tr><td><?php echo install_h('acc_password', 'Password:'); ?></td><td><input type="password" name="mhpw" id="mhpw" value=""></td></tr>
            <tr><td><?php echo install_h('acc_note_remember', 'Note: Remember this password. You need it for Admin access.'); ?></td><td></td></tr>
		</table>
</p>

<p>
    <span class="f10 c"><?php echo install_h('acc_section_support', 'Support account'); ?></span>
		<table>
            <tr><td><?php echo install_h('acc_name', 'Name:'); ?></td><td><input type="text" name="suser" id="suser" value="Support" disabled="disabled"></td></tr>
            <tr><td><?php echo install_h('acc_password', 'Password:'); ?></td><td><input type="password" name="spw" id="spw" value=""></td></tr>
            <tr><td><?php echo install_h('acc_note_remember', 'Note: Remember this password. You need it for Admin access.'); ?></td><td></td></tr>
		</table>
</p>

	<p>
        <span class="f10 c"><?php echo install_h('acc_section_admin', 'Admin account'); ?></span>
    <table>
        <tr>
            <td><span class="f9 c6"><?php echo install_h('acc_admin_name', 'Admin name:'); ?></span></td>
            <td><input type="text" name="aname" id="aname" value=""></td>
        </tr>
        <tr>
            <td><span class="f9 c6"><?php echo install_h('acc_admin_email', 'Admin email:'); ?></span></td>
            <td><input type="text" name="aemail" id="aemail" value=""></td>
        </tr>
        <tr>
            <td><span class="f9 c6"><?php echo install_h('acc_admin_password', 'Admin password:'); ?></span></td>
            <td><input type="password" name="apass" id="apass" value=""></td>
        </tr>
        <tr>
            <td><span class="f9 c6"><?php echo install_h('acc_admin_tribe', 'Admin tribe:'); ?></span></td>
            <td>
				<select name="atribe" id="atribe">
                    <option value="1" selected="selected"><?php echo install_h('tribe_romans', 'Romans'); ?></option>
                    <option value="2"><?php echo install_h('tribe_teutons', 'Teutons'); ?></option>
                    <option value="3"><?php echo install_h('tribe_gauls', 'Gauls'); ?></option>
				</select>
			</td>
        </tr>
		<tr>
        <td><span class="f9 c6"><?php echo install_h('acc_show_admin_stats', 'Show admin in stats:'); ?></span></td>
        <td>
            <select name="admin_rank">
                <option value="true">true</option>
                <option value="false" selected="selected">false</option>
            </select>
        </td>
        </tr>
		<tr>
        <td><span class="f9 c6"><?php echo install_h('acc_support_messages_admin_mailbox', 'Include Support messages in Admin mailbox:'); ?></span></td>
        <td>
            <select name="admin_support_msgs">
                <option value="true" selected="selected">true</option>
                <option value="false">false</option>
            </select>
        </td>
        </tr>
        <tr>
        <td><span class="f9 c6"><?php echo install_h('acc_admin_raidable', 'Allow administrative accounts to be raided and attacked:'); ?></span></td>
        <td>
            <select name="admin_raidable">
                <option value="true" selected="selected">true</option>
                <option value="false">false</option>
            </select>
        </td>
        </tr>
        <tr><td colspan="2"><?php echo install_h('acc_note_create_first_admin', 'Note: this will add a first user and set them up as an Admin.'); ?></td><td></td></tr>
        <tr><td colspan="2"><?php echo install_h('acc_note_optional_admin', 'Note: you can leave this section empty if you want.'); ?></td><td></td></tr>
    </table>
    </p>

	<center>
    	<input type="submit" name="Submit" id="Submit" value="<?php echo install_h('common_submit', 'Submit'); ?>"></center>
</form>

</div>
