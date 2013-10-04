<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<title><?php echo $this->pageTitle; ?>&nbsp;<?php echo Yii::app()->controller->module->siteName; ?></title>

</head>

<body>
  <div class="gutter">
    <div class="container_24">
      <div class="logo grid_5">
        <?php echo CHtml::link(CHtml::image(FController::getAssetImagePath().('fab-logo-white.png')),$this->createUrl('home')); ?>
      </div>
      <div class="sing_in grid_11">
        -
      </div>
      <div class="buttons grid_8" style="text-align: right;">
        <?php $this->widget('UserMenu',array('visible'=>!Yii::app()->user->isGuest)); ?>
        <?php //echo CHtml::link(Yii::t('FabModule.fab','Login'),$this->createUrl('login'),array('class'=>'button wide')); ?>
        <!-- CHtml::image(FController::getAssetImagePath().('login.png')) -->
      </div>
    </div>    
  </div>


<?php echo $content; ?>


  <div id="footer">
    <div class="container_24">
      <div class="grid_11">上海市金山区教育信息中心 制作</div>
      <div class="grid_13" style="text-align: right;font-size:80%;"> wgq91here#gmail.com Made by Fabcms System on YiiFramework. 2010.8</div>
      <div class="clear"></div>       
    </div>
  </div>
  
<div id="ajaxstatus">Nothing</div>
<?php $this->widget('Updateie'); ?>
</body>
</html>