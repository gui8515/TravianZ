<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       anmelden.php                                                 ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

use App\Utils\AccessLogger;

if(!file_exists('var/installed') && @opendir('install')) {
    header("Location: install/");
    exit;
}

include('GameEngine/Account.php');
AccessLogger::logRequest();

$invited=(isset($_GET['uid'])) ? filter_var($_GET['uid'], FILTER_SANITIZE_NUMBER_INT):$form->getError('invt');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title><?php echo SERVER_NAME; ?> - Registration</title>
		<link rel="shortcut icon" href="favicon.ico"/>
	<meta name="content-language" content="en" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-core.js?0faab" type="text/javascript"></script>
	<script src="mt-more.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE ?>travian.css?f4b7d" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE ?>lang/en/lang.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		#tribeQuickInfo {
			margin: 12px 0;
			padding: 10px 12px;
			border: 1px solid #c9b37b;
			background: #f8f1dc;
		}
		#tribeQuickInfo h4 {
			margin: 0 0 6px;
			font-size: 14px;
		}
		#tribeQuickInfo p {
			margin: 3px 0;
			line-height: 1.3;
		}
	</style>
	   </head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
<div id="dynamic_header">
</div>
<div id="header"></div>
<div id="mid">
<?php include("Templates/menu.tpl");
if(REG_OPEN == true){ ?>
<div id="content"  class="signup">

<h1><img src="img/x.gif" class="anmelden" alt="register for the game" /></h1>
<h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5>

<p><?php echo BEFORE_REGISTER; ?></p>

<form name="snd" method="post" action="anmelden.php">
<input type="hidden" name="invited" value="<?php echo $invited; ?>" />
<input type="hidden" name="ft" value="a1" />
<?php if(!AUTH_EMAIL) { ?><input type="hidden" name="email" value="" /><?php } ?>

<table cellpadding="1" cellspacing="1" id="sign_input">
	<tbody>
		<tr class="top">
			<th><?php echo NICKNAME; ?></th>
			<td><input class="text" type="text" name="name" value="<?php echo $form->getValue('name'); ?>" maxlength="30" />
			<span class="error"><?php echo $form->getError('name'); ?></span>
			</td>
		</tr>
		<?php if(AUTH_EMAIL) { ?>
		<tr>
			<th><?php echo EMAIL; ?></th>
			<td>
				<input class="text" type="text" name="email" value="<?php echo stripslashes($form->getValue('email')); ?>" />
				<span class="error"><?php echo $form->getError('email'); ?></span>
				</td>
			</tr>
			<?php } ?>
		<tr>
			<th><?php echo PASSWORD; ?></th>
			<td>
				<input class="text" type="password" name="pw" value="<?php echo stripslashes($form->getValue('pw')); ?>" maxlength="100" />
				<span class="error"><?php echo $form->getError('pw'); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<table cellpadding="1" cellspacing="1" id="sign_select">
	<tbody>
		<tr class="top">
			<th><img src="img/x.gif" class="img_u06" alt="choose tribe" /></th>
			<th colspan="2"><img src="img/x.gif" class="img_u07" alt="starting position" /></th>
		</tr>
		<tr>
			<td class="nat"><label><input class="radio" type="radio" name="vid" value="0" <?php echo $form->getRadio('vid',0); ?> <?php if($form->getValue('vid') == '') { echo 'checked="checked"'; } ?> />&nbsp;<?php echo RANDOM; ?></label></td>
			<td class="pos1"><label><input class="radio" type="radio" name="kid" value="0" checked="checked" />&nbsp;<?php echo RANDOM; ?></label></td>
			<td class="pos2">&nbsp;</td>
		</tr>
		<tr>
			<td class="nat"><label><input class="radio" type="radio" name="vid" value="1" <?php echo $form->getRadio('vid',1); ?> />&nbsp;<?php echo TRIBE1; /* Romans */ ?></label></td>
			<td class="pos1">&nbsp;</td>
			<td class="pos2">&nbsp;</td>
		</tr>
		<tr>
			<td><label><input class="radio" type="radio" name="vid" value="2" <?php echo $form->getRadio('vid',2); ?> />&nbsp;<?php echo TRIBE2; /* Teutons */ ?></label></td>
			<td><label><input class="radio" type="radio" name="kid" value="1" <?php echo $form->getRadio('kid',1); ?> />&nbsp;<?php echo NW; ?> <b>(-|+)</b>&nbsp;</label></td>
			<td><label><input class="radio" type="radio" name="kid" value="2" <?php echo $form->getRadio('kid',2); ?> />&nbsp;<?php echo NE; ?> <b>(+|+)</b></label></td>
		</tr>
		<tr class="btm">
			<td><label><input class="radio" type="radio" name="vid" value="3" <?php echo $form->getRadio('vid',3); ?> />&nbsp;<?php echo TRIBE3; /* Gauls */ ?></label></td>
			<td><label><input class="radio" type="radio" name="kid" value="3" <?php echo $form->getRadio('kid',3); ?> />&nbsp;<?php echo SW; ?> <b>(-|-)</b></label></td>
			<td><label><input class="radio" type="radio" name="kid" value="4" <?php echo $form->getRadio('kid',4); ?> />&nbsp;<?php echo SE; ?> <b>(+|-)</b></label></td>
		</tr>
	</tbody>
</table>

<div id="tribeQuickInfo">
	<h4 id="tribeQuickTitle"><?php echo RANDOM; ?></h4>
	<p id="tribeQuickPros"></p>
	<p id="tribeQuickCons"></p>
	<p id="tribeQuickStyle"></p>
</div>

<ul class="important">
<?php
echo $form->getError('tribe');
echo $form->getError('agree');
?>
		</ul>

<p>
		<input class="check" type="checkbox" name="agb" value="1" <?php echo $form->getRadio('agb',1); ?>/><?php echo ACCEPT_RULES; ?></p>

<p class="btn">
	<button value="anmelden" name="s1" id="btn_signup" class="trav_buttons" alt="register button"/> Register </button> 
</p>
</form>

<p class="info"><?php echo ONE_PER_SERVER; ?></p>
</div>
<?php }else{ ?>
<div id="content"  class="signup">

<h1><img src="img/x.gif" class="anmelden" alt="register for the game" /></h1>
<h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5>

<p><?php echo REGISTER_CLOSED; ?></p>
</div>
<?php } ?>
<div id="side_info" class="outgame">
<?php
if(NEWSBOX1) { include("Templates/News/newsbox1.tpl"); }
if(NEWSBOX2) { include("Templates/News/newsbox2.tpl"); }
if(NEWSBOX3) { include("Templates/News/newsbox3.tpl"); }
?>
			</div>

<div class="clear"></div>
			</div>

			<div class="footer-stopper outgame"></div>
			<div class="clear"></div>

<?php include("Templates/footer.tpl"); ?>
<div id="ce"></div>
<script type="text/javascript">
window.addEvent('domready', function() {
	var tribeInfo = {
		'0': {
			title: '<?php echo addslashes(RANDOM); ?>',
			pros: 'Vantagem: sorteia automaticamente entre Romanos, Teutoes e Gauleses.',
			cons: 'Desvantagem: voce nao escolhe seu estilo inicial.',
			style: 'Ideal para: quem quer comecar rapido sem decidir tribo.'
		},
		'1': {
			title: '<?php echo addslashes(TRIBE1); ?>',
			pros: 'Vantagem: boa economia e evolucao de aldeia consistente.',
			cons: 'Desvantagem: tropas com custo maior no inicio.',
			style: 'Ideal para: crescimento equilibrado e progressao estavel.'
		},
		'2': {
			title: '<?php echo addslashes(TRIBE2); ?>',
			pros: 'Vantagem: ataque forte e excelente para saque.',
			cons: 'Desvantagem: defesa inicial mais fragil.',
			style: 'Ideal para: jogadores agressivos e ativos.'
		},
		'3': {
			title: '<?php echo addslashes(TRIBE3); ?>',
			pros: 'Vantagem: boa defesa e mobilidade de tropas.',
			cons: 'Desvantagem: pressao ofensiva inicial menor.',
			style: 'Ideal para: jogo tatico, defensivo e suporte a alianca.'
		}
	};

	var setTribeInfo = function(value) {
		if(!tribeInfo[value]) {
			return;
		}

		$('tribeQuickTitle').set('text', tribeInfo[value].title);
		$('tribeQuickPros').set('text', tribeInfo[value].pros);
		$('tribeQuickCons').set('text', tribeInfo[value].cons);
		$('tribeQuickStyle').set('text', tribeInfo[value].style);
	};

	$$('input[name=vid]').addEvent('change', function() {
		setTribeInfo(this.get('value'));
	});

	var selected = $$('input[name=vid]:checked');
	setTribeInfo(selected.length ? selected[0].get('value') : '0');
});
</script>
</body>
</html>
