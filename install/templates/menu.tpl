<div class="menu">
<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       menu.tpl                                                    ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################

	switch($_GET['s']) {
		case 0:
		echo "<li class=\"c2 f9\">".htmlspecialchars(install_t('menu_intro', 'Intro'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_configuration', 'Configuration'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_database', 'Database'), ENT_QUOTES, 'UTF-8')."</li><li class= \"c1 f9\">".htmlspecialchars(install_t('menu_world_data', 'World Data'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_accounts', 'Accounts'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_end', 'End'), ENT_QUOTES, 'UTF-8')."</li>";
		break;
		case 1:
		echo "<li class=\"c3 f9\">".htmlspecialchars(install_t('menu_intro', 'Intro'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c2 f9\">".htmlspecialchars(install_t('menu_configuration', 'Configuration'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_database', 'Database'), ENT_QUOTES, 'UTF-8')."</li><li class= \"c1 f9\">".htmlspecialchars(install_t('menu_world_data', 'World Data'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_accounts', 'Accounts'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_end', 'End'), ENT_QUOTES, 'UTF-8')."</li>";
		break;
		case 2:
		echo "<li class=\"c3 f9\">".htmlspecialchars(install_t('menu_intro', 'Intro'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_configuration', 'Configuration'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c2 f9\">".htmlspecialchars(install_t('menu_database', 'Database'), ENT_QUOTES, 'UTF-8')."</li><li class= \"c1 f9\">".htmlspecialchars(install_t('menu_world_data', 'World Data'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_accounts', 'Accounts'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_end', 'End'), ENT_QUOTES, 'UTF-8')."</li>";
		break;
		case 3:
		echo "<li class=\"c3 f9\">".htmlspecialchars(install_t('menu_intro', 'Intro'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_configuration', 'Configuration'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_database', 'Database'), ENT_QUOTES, 'UTF-8')."</li><li class= \"c2 f9\">".htmlspecialchars(install_t('menu_world_data', 'World Data'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_accounts', 'Accounts'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_end', 'End'), ENT_QUOTES, 'UTF-8')."</li>";
		break;
		case 4:
		echo "<li class=\"c3 f9\">".htmlspecialchars(install_t('menu_intro', 'Intro'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_configuration', 'Configuration'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_database', 'Database'), ENT_QUOTES, 'UTF-8')."</li><li class= \"c3 f9\">".htmlspecialchars(install_t('menu_world_data', 'World Data'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c2 f9\">".htmlspecialchars(install_t('menu_accounts', 'Accounts'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c1 f9\">".htmlspecialchars(install_t('menu_end', 'End'), ENT_QUOTES, 'UTF-8')."</li>";
		break;
		case 5:
		echo "<li class=\"c3 f9\">".htmlspecialchars(install_t('menu_intro', 'Intro'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_configuration', 'Configuration'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_database', 'Database'), ENT_QUOTES, 'UTF-8')."</li><li class= \"c3 f9\">".htmlspecialchars(install_t('menu_world_data', 'World Data'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c3 f9\">".htmlspecialchars(install_t('menu_accounts', 'Accounts'), ENT_QUOTES, 'UTF-8')."</li><li class=\"c2 f9\">".htmlspecialchars(install_t('menu_end', 'End'), ENT_QUOTES, 'UTF-8')."</li>";
		break;
	}

?></div>
