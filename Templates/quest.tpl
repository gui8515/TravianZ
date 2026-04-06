<?php 

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       quest.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Rework by:     ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##                                                                             ##
#################################################################################
$_SESSION['qtyp'] = QTYPE;
if ($_SESSION['id_user'] != 1 && (($_SESSION['qst'] < 38 && QTYPE == 37 && QUEST == true) || ($_SESSION['qst'] < 31 && QTYPE == 25 && QUEST == true) || ($_SESSION['qst'] >= 90 && QUEST == true))) {?>
<div id="anm" style="width:120px; height:140px; visibility:hidden;"></div>
<div id="qge" style="display:none;"></div>
<style type="text/css">
#fab-quest {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 120px;
    height: 120px;
    background: transparent;
    border: none;
    cursor: pointer;
    z-index: 999;
    padding: 0;
}
#fab-quest:hover {
    transform: scale(1.05);
}
#fab-quest:active {
    transform: scale(0.96);
}
#fab-quest img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); */
}
</style>
<div id="fab-quest" onclick="qst_handle();" title="To the task">
    <?php if ($_SESSION['qst'] == 0 or (isset($_SESSION['qstnew']) && $_SESSION['qstnew']==1)){ ?>
    <img id="fab-quest-img" src="<?php echo GP_LOCATE; ?>img/q/l<?php echo $session->userinfo['tribe'];?>g.jpg" alt="To the task" />
    <?php }else{?>
    <img id="fab-quest-img" src="<?php echo GP_LOCATE; ?>img/q/l<?php echo $session->userinfo['tribe'];?>.jpg" alt="To the task" />
    <?php } ?>
</div>
<script type="text/javascript">
 <?php if ($_SESSION['qst']==0){ ?>
     quest.number=null;
     <?php }else{ ?>
         quest.number=0;
         <?php } if ($_SESSION['qst']<38 && QTYPE==37){?>
             quest.last = 37;
             <?php } else {?>
                 quest.last = 30;
                 <?php }?>
 cache_preload = new Image();
 cache_preload.src = "img/x.gif";
 cache_preload.className = "wood";

 // Remove fundo branco da imagem do FAB
 (function() {
     var img = document.getElementById('fab-quest-img');
     if (!img) {
         return;
     }

     var processImage = function() {
         try {
             var canvas = document.createElement('canvas');
             var width = img.naturalWidth || img.width;
             var height = img.naturalHeight || img.height;
             if (!width || !height) {
                 return;
             }

             canvas.width = width;
             canvas.height = height;
             var ctx = canvas.getContext('2d');
             if (!ctx) {
                 return;
             }

             ctx.drawImage(img, 0, 0, width, height);
             var imageData = ctx.getImageData(0, 0, width, height);
             var data = imageData.data;

             for (var i = 0; i < data.length; i += 4) {
                 var r = data[i];
                 var g = data[i + 1];
                 var b = data[i + 2];

                 if (r > 245 && g > 245 && b > 245) {
                     data[i + 3] = 0;
                 } else if (r > 220 && g > 220 && b > 220) {
                     data[i + 3] = Math.min(data[i + 3], 90);
                 }
             }

             ctx.putImageData(imageData, 0, 0);
             img.src = canvas.toDataURL('image/png');
         } catch (e) {
             // fallback: keep original image
         }
     };

     if (img.complete) {
         processImage();
     } else if (img.addEventListener) {
         img.addEventListener('load', processImage);
     } else if (img.attachEvent) {
         img.attachEvent('onload', processImage);
     }
 })();
</script>                        
<?php } ?>
