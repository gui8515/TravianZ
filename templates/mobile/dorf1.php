<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       templates/desktop/dorf1.php                                 ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<title><?php echo SERVER_NAME . ' - Village overview &raquo; ' . $village->vname; ?></title>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7i" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css" />
	<?php
	if ($session->gpack == null || GP_ENABLE == false) {
		echo "
	<link href='" . GP_LOCATE . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . GP_LOCATE . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	} else {
		echo "
	<link href='" . $session->gpack . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . $session->gpack . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	}
	?>
	<script type="text/javascript">
		window.addEvent('domready', start);
	</script>
	<style type="text/css">
		body,
		.wrapper {
			overflow-x: hidden;
		}

		#dynamic_header,
		#header,
		#mid,
		#footer,
		#mtop {
			min-width: 0 !important;
			width: 100% !important;
		}

		#dynamic_header,
		#dynamic_header .dyn1,
		#dynamic_header .dyn2 {
			background-position: center top !important;
		}

		#mid {
			float: none;
			display: block;
			padding: 8px;
			box-sizing: border-box;
		}

		#content.village1 {
			float: none;
			width: 100% !important;
			max-width: 720px;
			padding: 8px !important;
			margin: 0 auto;
			box-sizing: border-box;
		}

		#map_details,
		#side_info,
		#side_navi {
			float: none !important;
			width: 100% !important;
			margin: 12px 0 0;
			position: static !important;
			left: auto !important;
			top: auto !important;
			box-sizing: border-box;
		}

		#footer #mfoot {
			width: auto !important;
			padding-left: 12px;
			padding-right: 12px;
			box-sizing: border-box;
		}

		#res,
		#ltime {
			position: static !important;
			left: auto !important;
			top: auto !important;
			width: auto !important;
			height: auto !important;
			margin: 8px 0;
		}

		@media (max-width: 768px) {
			#content.village1 {
				padding: 0 !important;
			}

			#village_map,
			#village_map img {
				max-width: 100%;
			}

			table {
				display: block;
				width: 100% !important;
				overflow-x: auto;
			}
		}
	</style>
</head>

<body class="v35 ie ie8">
	<div class="wrapper">
		<!-- <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> -->
		<div id="dynamic_header">
		</div>
		<?php
		include("Templates/header.tpl");
		include("Templates/res.tpl");

		?>

		<div id="mid">
			<?php
			// include("Templates/menu.tpl"); 
			?>
			<div id="content" class="village1">
				<h1><?php echo $village->vname;
					if ($village->loyalty != '100') {
						if ($village->loyalty > '33') {
							$color = "gr";
						} else {
							$color = "re";
						} ?><div id="loyality" class="<?php echo $color; ?>"><?php echo LOYALTY; ?> <?php echo floor($village->loyalty); ?>%</div><?php } ?></h1>
				<div id="cap" align="left"><?php if ($village->capital != '0') {
												echo "<font color=gray>(" . CAPITAL1 . ")</font>";
											} ?></div>
				<?php include("Templates/field.tpl");
				$timer = 1;
				?>
				<div id="map_details">
					<br /><br />
					<?php
					include("Templates/movement.tpl");
					include("Templates/production.tpl");
					include("Templates/troops.tpl");

					if ($building->NewBuilding) include("Templates/Building.tpl");
					?>
				</div>
				<br /><br /><br /><br />
				<!-- <div id="side_info">
					<?php
					include("Templates/multivillage.tpl");
					include("Templates/quest.tpl");
					include("Templates/news.tpl");
					if (!NEW_FUNCTIONS_DISPLAY_LINKS) {
						echo "<br><br><br><br>";
						include("Templates/links.tpl");
					}
					?>
				</div> -->
				<div class="clear"></div>
			</div>
			<div class="footer-stopper"></div>
			<div class="clear"></div>

			<?php
			include("Templates/footer.tpl");
			include("Templates/quest.tpl");
			?>
			<div id="stime">
				<div id="ltime">
					<div id="ltimeWrap">
						<?php echo CALCULATED_IN; ?> <b><?php
														echo round(($generator->pageLoadTimeEnd() - $start_timer) * 1000);
														?></b> ms

						<br /><?php echo SERVER_TIME; ?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
					</div>
				</div>
			</div>

			<div id="ce"></div>
</body>

</html>