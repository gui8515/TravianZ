
	<br>

	<form method="get" action="index.php" style="margin-left: 20px; margin-bottom: 10px;">
		<input type="hidden" name="s" value="0" />
		<label for="install_lang" class="f9 c6"><?php echo htmlspecialchars(install_t('intro_language', 'Installer language'), ENT_QUOTES, 'UTF-8'); ?>:</label>
		<select name="l" id="install_lang" onchange="this.form.submit()">
			<?php foreach($installAvailableLanguages as $langCode => $langLabel) { ?>
				<option value="<?php echo htmlspecialchars($langCode, ENT_QUOTES, 'UTF-8'); ?>"<?php if($installLang === $langCode) { echo ' selected="selected"'; } ?>><?php echo htmlspecialchars($langLabel, ENT_QUOTES, 'UTF-8'); ?></option>
			<?php } ?>
		</select>
		<noscript><input type="submit" value="OK" /></noscript>
	</form>

	<h4>&nbsp;&nbsp;<?php echo htmlspecialchars(install_t('intro_disclaimer_title', 'Disclaimer'), ENT_QUOTES, 'UTF-8'); ?></h4>

	<ul>
	<li><?php echo htmlspecialchars(install_t('intro_disclaimer_1', 'Along with the installation/usage of this game, you shall be fully responsible for any legal results raised by the owners of any unlicensed content your copy publishes.'), ENT_QUOTES, 'UTF-8'); ?></li>

	<li><?php echo htmlspecialchars(install_t('intro_disclaimer_2', 'Neither the team that created this script nor the team that customized this distribution shall be responsible for any damage done to your computer/server system.'), ENT_QUOTES, 'UTF-8'); ?></li>

	<li><?php echo htmlspecialchars(install_t('intro_disclaimer_3', 'All code was confirmed to run correctly by the original team, without visible security risks they were aware of at release time.'), ENT_QUOTES, 'UTF-8'); ?></li>

	<li><?php echo htmlspecialchars(install_t('intro_disclaimer_4', 'Users are asked to review the code on their own behalf.'), ENT_QUOTES, 'UTF-8'); ?></li>

	<li><?php echo htmlspecialchars(install_t('intro_disclaimer_5', 'Any customizations are the property of each customization author; sharing remains at each author\'s discretion.'), ENT_QUOTES, 'UTF-8'); ?></li>

	<li><b><?php echo htmlspecialchars(install_t('intro_disclaimer_6', 'You have no rights to edit copyright notices or claim this script as your own.'), ENT_QUOTES, 'UTF-8'); ?></b></li>

	<li><?php echo htmlspecialchars(install_t('intro_disclaimer_7', 'Last but not least, enjoy.'), ENT_QUOTES, 'UTF-8'); ?></li>
	</ul>

        <br>
	<ul>
	<li><h4><?php echo htmlspecialchars(install_t('intro_before_install_title', 'Before Installation (Linux)'), ENT_QUOTES, 'UTF-8'); ?>:</h4></li>
	<li><?php echo htmlspecialchars(install_t('intro_before_install_1', 'CHMOD install to 777 (chmod -R 777 install)'), ENT_QUOTES, 'UTF-8'); ?></li>
	<li><?php echo htmlspecialchars(install_t('intro_before_install_2', 'CHMOD GameEngine to 777 (chmod -R 777 GameEngine)'), ENT_QUOTES, 'UTF-8'); ?></li>
	<li><h4><?php echo htmlspecialchars(install_t('intro_after_install_title', 'After Installation'), ENT_QUOTES, 'UTF-8'); ?></h4></li>
	<li><?php echo htmlspecialchars(install_t('intro_after_install_1', 'Delete install folder (sudo rm -R install)'), ENT_QUOTES, 'UTF-8'); ?></li>
	<li><?php echo htmlspecialchars(install_t('intro_after_install_2', 'CHMOD GameEngine back to 755 (sudo chmod -R 755 GameEngine)'), ENT_QUOTES, 'UTF-8'); ?></li>
    <li><?php echo htmlspecialchars(install_t('intro_after_install_3', 'CHMOD Prevention to 777 (sudo chmod -R 777 GameEngine/Prevention)'), ENT_QUOTES, 'UTF-8'); ?></li>
    <li><?php echo htmlspecialchars(install_t('intro_after_install_4', 'CHMOD Notes to 777 (sudo chmod -R 777 GameEngine/Notes)'), ENT_QUOTES, 'UTF-8'); ?></li>
    <li><?php echo htmlspecialchars(install_t('intro_after_install_5', 'CHMOD var/log to 777 (sudo chmod -R 777 var/log)'), ENT_QUOTES, 'UTF-8'); ?></li>
	</ul>
	
	<ul>
	<li><h4><?php echo htmlspecialchars(install_t('intro_security_title', 'After Installation (Security)'), ENT_QUOTES, 'UTF-8'); ?></h4></li>
	<li><?php echo htmlspecialchars(install_t('intro_security_1', 'Protect folder /Admin with a password-protected directory.'), ENT_QUOTES, 'UTF-8'); ?></li>
	</ul>

	<div class="lbox">
	<?php echo htmlspecialchars(install_t('intro_team', 'TravianZ Team'), ENT_QUOTES, 'UTF-8'); ?>
	</div>
	<br>

	<center>
	<form>
		<input type="button" name="next" value="<?php echo htmlspecialchars(install_t('intro_next', 'Next'), ENT_QUOTES, 'UTF-8'); ?>" onclick="location.href='?s=1&amp;l=<?php echo rawurlencode($installLang); ?>'">
	</form>
	</center>

</div>
