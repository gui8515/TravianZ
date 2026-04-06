<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       templates/mobile/dorf1.php                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

/* ----------------------------------------------------------------
 * Mobile village view template – dorf1
 *
 * All backend variables ($village, $session, $database, $generator,
 * $building, $technology, $message) are set by the caller (dorf1.php).
 * This file is display-only; it does not modify any game state.
 * ---------------------------------------------------------------- */

// Resolve loyalty colour class for inline use via CSS class
$loyaltyClass = '';
if ($village->loyalty != '100') {
    $loyaltyClass = ($village->loyalty > '33') ? 'gr' : 're';
}

// Resource values
$wood = round($village->getProd('wood'));
$clay = round($village->getProd('clay'));
$iron = round($village->getProd('iron'));
$crop = round($village->getProd('crop'));
$totalproduction = $village->allcrop;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <title><?php echo SERVER_NAME . ' - Village overview &raquo; ' . $village->vname; ?></title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="templates/mobile/style.css" />
    <script src="mt-full.js?0faab" type="text/javascript"></script>
    <script src="unx.js?f4b7i" type="text/javascript"></script>
    <script src="new.js?0faab" type="text/javascript"></script>
    <?php
    if ($session->gpack == null || GP_ENABLE == false) {
        echo "<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />";
    } else {
        echo "<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />";
    }
    ?>
    <script type="text/javascript">
    window.addEvent('domready', start);
    </script>
</head>
<body>

<div class="m-wrapper">

    <!-- ===================================================
         TOP NAVIGATION BAR
         =================================================== -->
    <header class="m-topbar">
        <span class="m-topbar__logo"><?php echo SERVER_NAME; ?></span>

        <nav class="m-topbar__links" aria-label="Quick navigation">
            <a href="<?php echo ($_SESSION['id_user'] != 1 ? 'berichte.php' : '#'); ?>" title="Reports">&#128196;</a>
            <a href="nachrichten.php" title="Messages">
                <?php
                if ($message->unread || $message->nunread) {
                    echo '&#128233;';
                } else {
                    echo '&#9993;';
                }
                ?>
            </a>
            <?php if ($_SESSION['id_user'] != 1): ?>
            <a href="plus.php" title="Plus">
                <span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span>
            </a>
            <?php endif; ?>
        </nav>

        <button class="m-hamburger" id="m-hamburger-btn" aria-label="Open navigation menu" aria-expanded="false" aria-controls="m-nav-drawer">
            <span class="m-hamburger__bar"></span>
            <span class="m-hamburger__bar"></span>
            <span class="m-hamburger__bar"></span>
        </button>
    </header>

    <!-- ===================================================
         SLIDE-OUT NAVIGATION DRAWER
         =================================================== -->
    <div class="m-nav-overlay" id="m-nav-overlay" role="presentation"></div>

    <nav class="m-nav-drawer" id="m-nav-drawer" aria-label="Main navigation">
        <?php if ($session->logged_in): ?>

        <div class="m-nav-drawer__section">
            <div class="m-nav-drawer__section-title">Account</div>
            <a href="spieler.php?uid=<?php echo $session->uid; ?>">Profile</a>
            <a href="logout.php">Logout</a>
            <?php if ($session->access == MULTIHUNTER): ?>
            <a href="Admin/admin.php">Multihunter Panel</a>
            <?php endif; ?>
            <?php if ($session->access == ADMIN): ?>
            <a href="Admin/admin.php">Admin Panel</a>
            <a href="massmessage.php">Mass Message</a>
            <a href="build_croppers.php">Build Cropper</a>
            <a href="sysmsg.php">System Message</a>
            <?php endif; ?>
        </div>

        <div class="m-nav-drawer__section">
            <div class="m-nav-drawer__section-title">Navigation</div>
            <a href="dorf1.php">Village overview</a>
            <a href="dorf2.php">Village centre</a>
            <a href="karte.php">Map</a>
            <a href="statistiken.php">Statistics</a>
            <a href="allianz.php?s=2">Forum</a>
        </div>

        <div class="m-nav-drawer__section">
            <div class="m-nav-drawer__section-title">Messages</div>
            <a href="<?php echo ($_SESSION['id_user'] != 1 ? 'berichte.php' : '#'); ?>">Reports</a>
            <a href="nachrichten.php">Messages</a>
        </div>

        <?php if ($_SESSION['id_user'] != 1): ?>
        <div class="m-nav-drawer__section">
            <div class="m-nav-drawer__section-title">More</div>
            <a href="plus.php?id=3">TravianZ Plus</a>
            <a href="spieler.php?uid=1">Support</a>
            <?php if (NEW_FUNCTIONS_DISPLAY_LINKS) include("Templates/links.tpl"); ?>
            <?php include("Templates/natars.tpl"); ?>
        </div>
        <?php endif; ?>

        <?php endif; ?>
    </nav>

    <!-- ===================================================
         FIXED RESOURCE BAR
         =================================================== -->
    <div class="m-resource-bar" role="status" aria-label="Village resources">
        <div class="m-resource-bar__item">
            <img src="img/x.gif" class="r1 m-resource-bar__icon" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" />
            <span class="m-resource-bar__value"><?php echo round($village->awood); ?></span>
            <span>/<?php echo $village->maxstore; ?></span>
        </div>
        <div class="m-resource-bar__item">
            <img src="img/x.gif" class="r2 m-resource-bar__icon" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" />
            <span class="m-resource-bar__value"><?php echo round($village->aclay); ?></span>
            <span>/<?php echo $village->maxstore; ?></span>
        </div>
        <div class="m-resource-bar__item">
            <img src="img/x.gif" class="r3 m-resource-bar__icon" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" />
            <span class="m-resource-bar__value"><?php echo round($village->airon); ?></span>
            <span>/<?php echo $village->maxstore; ?></span>
        </div>
        <div class="m-resource-bar__item">
            <img src="img/x.gif" class="r4 m-resource-bar__icon" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" />
            <?php if ($village->acrop > 0): ?>
            <span class="m-resource-bar__value"><?php echo round($village->acrop); ?></span>
            <?php else: ?>
            <span class="m-resource-bar__value">0</span>
            <?php endif; ?>
            <span>/<?php echo $village->maxcrop; ?></span>
        </div>
        <div class="m-resource-bar__item">
            <img src="img/x.gif" class="r5 m-resource-bar__icon" alt="<?php echo CROP_COM; ?>" title="<?php echo CROP_COM; ?>" />
            <span class="m-resource-bar__value"><?php echo ($village->pop + $technology->getUpkeep($village->unitall, 0)); ?></span>
            <span>/<?php echo $totalproduction; ?></span>
        </div>
        <div class="m-resource-bar__gold">
            <?php
            if ($session->gold <= 1) {
                echo '<img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="You currently have: '.$session->gold.' gold" /> '.$session->gold.' G';
            } else {
                echo '<img src="'.GP_LOCATE.'img/a/gold.gif" alt="Gold" title="You currently have: '.$session->gold.' gold" /> '.$session->gold.' G';
            }
            ?>
        </div>
    </div>

    <!-- ===================================================
         PAGE BODY
         =================================================== -->
    <main class="m-page-body">

        <!-- Village name & loyalty -->
        <div class="m-village-header">
            <div class="m-village-header__name"><?php echo $village->vname; ?></div>
            <?php if ($village->loyalty != '100'): ?>
            <div class="m-village-header__loyalty m-village-header__loyalty--<?php echo ($village->loyalty > '33' ? 'ok' : 'warn'); ?>">
                <?php echo LOYALTY; ?> <?php echo floor($village->loyalty); ?>%
            </div>
            <?php endif; ?>
            <?php if ($village->capital != '0'): ?>
            <div class="m-village-header__capital">(<?php echo CAPITAL1; ?>)</div>
            <?php endif; ?>
        </div>

        <!-- Quick-action nav (village / map / stats) -->
        <nav class="m-action-nav" aria-label="Page navigation">
            <a class="m-action-nav__btn m-action-nav__btn--active" href="dorf1.php">&#127807; Resources</a>
            <a class="m-action-nav__btn" href="dorf2.php">&#127963; Village</a>
            <a class="m-action-nav__btn" href="karte.php">&#128506; Map</a>
            <a class="m-action-nav__btn" href="statistiken.php">&#128202; Stats</a>
        </nav>

        <!-- Village map / resource fields -->
        <div class="m-village-map">
            <div class="m-village-map__inner" id="village_map" class="f<?php echo $village->type; ?>">
                <?php
                $coorarray = array(1=>"101,33,28","165,32,28","224,46,28","46,63,28","138,74,28","203,94,28","262,86,28","31,117,28","83,110,28","214,142,28","269,146,28","42,171,28","93,164,28","160,184,28","239,199,28","87,217,28","140,231,28","190,232,28");
                $arrayVillage = $village->resarray;
                $jobs = $database->getJobs($village->wid);
                $activeFields = [];
                if (count($jobs)) {
                    foreach ($jobs as $job) {
                        if ($job['type'] <= 4) {
                            $activeFields[$job['field']] = true;
                        }
                    }
                }

                for ($i = 1; $i <= 18; $i++) {
                    if ($arrayVillage['f'.$i.'t'] != 0) {
                        echo '<img src="img/x.gif" class="reslevel rf'.$i.' level'.$arrayVillage['f'.$i].(isset($activeFields[$i]) ? '_active' : '').'" alt="Level '.$arrayVillage['f'.$i].(isset($activeFields[$i]) ? ' (upgrade in progress)' : '').'" />';
                    }
                }
                ?>
                <map name="rx" id="rx">
                <?php
                for ($i = 1; $i <= 18; $i++) {
                    echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="'.Building::procResType($arrayVillage['f'.$i.'t']).' Level '.$arrayVillage['f'.$i].(isset($activeFields[$i]) ? ' (upgrade in progress)' : '').'" />';
                }
                ?>
                    <area href="dorf2.php" coords="144,131,36" shape="circle" title="Village centre" alt="" />
                </map>
                <img id="resfeld" usemap="#rx" src="img/x.gif" alt="Resource fields" />
            </div>
            <a class="m-village-map__centre-link" href="dorf2.php">&#9654; Go to Village Centre</a>
        </div>

        <!-- Building queue -->
        <?php if ($building->NewBuilding): ?>
        <?php $building->loadBuilding(); ?>
        <div class="m-card">
            <div class="m-card__header">
                <?php echo BUILDING_UPGRADING; ?>
                <?php if ($session->gold >= 2): ?>
                <a href="?buildingFinish=1" onclick="return confirm('Finish all construction and research orders in this village immediately for 2 Gold?');" title="Finish all construction and research orders in this village immediately for 2 Gold?">
                    <img class="clock" alt="Finish immediately" src="img/x.gif" />
                </a>
                <?php endif; ?>
            </div>
            <div class="m-card__body">
                <?php foreach ($building->buildArray as $job): ?>
                <?php if ($job['master'] == 0): ?>
                <div class="m-build-row">
                    <div class="m-build-row__cancel">
                        <a href="?d=<?php echo $job['id']; ?>&a=0&c=<?php echo $session->checker; ?>">
                            <img src="img/x.gif" class="del" title="Cancel" alt="Cancel" />
                        </a>
                    </div>
                    <div class="m-build-row__info">
                        <a href="build.php?id=<?php echo $job['field']; ?>"><?php echo Building::procResType($job['type']); ?></a>
                        (Level <?php echo $job['level']; ?>)
                        <?php if ($job['loopcon'] == 1) echo ' <em>(waiting loop)</em>'; ?>
                    </div>
                    <div class="m-build-row__timer">
                        in <span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat($job['timestamp'] - time()); ?></span> hrs
                        &mdash; done at <?php echo date('H:i', $job['timestamp']); ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="m-build-row">
                    <div class="m-build-row__cancel">
                        <a href="?d=<?php echo $job['id']; ?>&a=0&c=<?php echo $session->checker; ?>">
                            <img src="img/x.gif" class="del" title="Cancel" alt="Cancel" />
                        </a>
                    </div>
                    <div class="m-build-row__info">
                        <?php echo Building::procResType($job['type']); ?>
                        <span class="none"> (Level <?php echo $job['level']; ?>)</span>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Troop movements
             movement.tpl opens its own <table id="movements"> when there are
             movements and outputs <tr> rows inside it.  We close the table
             ourselves after the include. -->
        <div class="m-card m-card--movements">
            <div class="m-card__body">
                <?php
                $timer = 1;
                include("Templates/movement.tpl");
                // movement.tpl opens a <table> only when $aantal > 0,
                // but never closes it – we close it here to keep valid HTML.
                $oases2 = 0;
                $oasisArray2 = $database->getOasis($village->wid);
                foreach ($oasisArray2 as $conqured2) {
                    $oases2 += count($database->getMovement(6, $conqured2['wref'], 0));
                }
                $movTotal = (count($database->getMovement(4,$village->wid,1)) + count($database->getMovement(3,$village->wid,1)) + count($database->getMovement(3,$village->wid,0)) + count($database->getMovement(7,$village->wid,1)) + count($database->getMovement(5,$village->wid,0)) + $oases2 - count($database->getMovement(8,$village->wid,1)) - count($database->getMovement(9,$village->wid,0)));
                if ($movTotal > 0) {
                    echo '</tbody></table>';
                }
                ?>
            </div>
        </div>

        <!-- Production -->
        <div class="m-card">
            <div class="m-card__header"><?php echo PRODUCTION; ?></div>
            <div class="m-card__body">
                <table class="m-production" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td class="ico"><img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" /></td>
                        <td class="res"><?php echo LUMBER; ?></td>
                        <td class="num"><?php echo $village->getProd('wood'); ?></td>
                        <td class="per"><?php echo PER_HR; ?></td>
                    </tr>
                    <tr>
                        <td class="ico"><img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" /></td>
                        <td class="res"><?php echo CLAY; ?></td>
                        <td class="num"><?php echo $village->getProd('clay'); ?></td>
                        <td class="per"><?php echo PER_HR; ?></td>
                    </tr>
                    <tr>
                        <td class="ico"><img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" /></td>
                        <td class="res"><?php echo IRON; ?></td>
                        <td class="num"><?php echo $village->getProd('iron'); ?></td>
                        <td class="per"><?php echo PER_HR; ?></td>
                    </tr>
                    <tr>
                        <td class="ico"><img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" /></td>
                        <td class="res"><?php echo CROP; ?></td>
                        <td class="num"><?php echo $village->getProd('crop'); ?></td>
                        <td class="per"><?php echo PER_HR; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Troops present -->
        <div class="m-card">
            <div class="m-card__header"><?php echo TROOPS; ?></div>
            <div class="m-card__body">
                <?php
                $troops = $technology->getAllUnits($village->wid, true, 1);
                $troopsPresent = false;
                ?>
                <table class="m-troops" cellpadding="0" cellspacing="0">
                    <tbody>
                    <?php for ($i = 1; $i <= 50; $i++): ?>
                    <?php if ($troops['u'.$i] > 0): ?>
                    <?php $troopsPresent = true; ?>
                    <tr>
                        <td class="ico">
                            <a href="build.php?id=39">
                                <img class="unit u<?php echo $i; ?>" src="img/x.gif" alt="<?php echo $technology->getUnitName($i); ?>" title="<?php echo $technology->getUnitName($i); ?>" />
                            </a>
                        </td>
                        <td class="num"><?php echo $troops['u'.$i]; ?></td>
                        <td class="un"><?php echo $technology->getUnitName($i); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($troops['hero'] > 0): ?>
                    <?php $troopsPresent = true; ?>
                    <tr>
                        <td class="ico">
                            <a href="build.php?id=39">
                                <img class="unit uhero" src="img/x.gif" alt="Hero" title="Hero" />
                            </a>
                        </td>
                        <td class="num"><?php echo $troops['hero']; ?></td>
                        <td class="un">Hero</td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!$troopsPresent): ?>
                    <tr><td colspan="3" class="m-section-empty">None present</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Village list (multi-village) -->
        <?php if (count($session->villages) > 1): ?>
        <div class="m-card">
            <div class="m-card__header"><a href="dorf3.php"><?php echo VILLAGES; ?></a></div>
            <div class="m-card__body">
                <?php
                $returnVillageArray = $database->getArrayMemberVillage($session->uid);
                echo '<ul class="m-village-list">';
                for ($i = 1; $i <= count($session->villages); $i++) {
                    $isActive = ($_SESSION['wid'] == $returnVillageArray[$i-1]['wref']);
                    $href = '?newdid='.$returnVillageArray[$i-1]['wref'];
                    echo '<li class="m-village-list__item">';
                    echo '<span class="m-village-list__dot'.($isActive ? ' m-village-list__dot--active' : '').'">●</span>';
                    echo '<a class="m-village-list__name" href="'.$href.'">'.$returnVillageArray[$i-1]['name'].'</a>';
                    echo '<span class="m-village-list__coords">('.$returnVillageArray[$i-1]['x'].'|'.$returnVillageArray[$i-1]['y'].')</span>';
                    echo '</li>';
                }
                echo '</ul>';
                ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Quest / news (rendered by existing templates) -->
        <?php include("Templates/quest.tpl"); ?>
        <?php include("Templates/news.tpl"); ?>
        <?php if (!NEW_FUNCTIONS_DISPLAY_LINKS): ?>
        <?php include("Templates/links.tpl"); ?>
        <?php endif; ?>

    </main><!-- /.m-page-body -->

    <!-- ===================================================
         FOOTER
         =================================================== -->
    <footer class="m-footer">
        &copy; 2010&ndash;<?php echo date('Y'); ?> <?php echo (defined('SERVER_NAME') ? SERVER_NAME : 'TravianZ'); ?> All rights reserved.
    </footer>

    <!-- Page load time / server time -->
    <div class="m-stime">
        <?php echo CALCULATED_IN; ?> <strong><?php echo round(($generator->pageLoadTimeEnd() - $start_timer) * 1000); ?></strong> ms
        &mdash; <?php echo SERVER_TIME; ?> <span id="tp1"><?php echo date('H:i:s'); ?></span>
    </div>

</div><!-- /.m-wrapper -->

<!-- Hidden res div kept so existing JS timers work -->
<?php include("Templates/res.tpl"); ?>

<div id="ce"></div>

<script type="text/javascript">
(function () {
    var btn     = document.getElementById('m-hamburger-btn');
    var drawer  = document.getElementById('m-nav-drawer');
    var overlay = document.getElementById('m-nav-overlay');

    function openDrawer() {
        drawer.classList.add('is-open');
        overlay.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
    }

    function closeDrawer() {
        drawer.classList.remove('is-open');
        overlay.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
    }

    btn.addEventListener('click', function () {
        if (drawer.classList.contains('is-open')) {
            closeDrawer();
        } else {
            openDrawer();
        }
    });

    overlay.addEventListener('click', closeDrawer);
}());
</script>

</body>
</html>
