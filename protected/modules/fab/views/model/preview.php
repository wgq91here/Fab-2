<div class="formbody">
<h3 class="title">
  <span<?php if ($model->locked == 1) echo ' class="locked"';?>>
    <?php echo $PreViewForm->title; ?>
  </span>
</h3>
<div style='text-align:right;width:99%;padding-top:5px;'>
  <span style='padding-right:20px;font-size:90%;'>
  <strong><?php echo $model->user->username; ?></strong>,
  <strong><?php echo Fabdate($model->created,'Y-m-d 星期* H:i'); ?></strong>,  
  <strong><?php echo Yii::app()->params['mainsite'].$PreViewForm->action; ?></strong>
  </span>
</div>
<?php
$PreViewForm->title = '';
echo $PreViewForm;
?>

  <div class="version">
  Made by <?php echo CHtml::link(Yii::app()->name,Yii::app()->params['mainsite'],array('target'=>'_blank')); ?>
  </div>
</div>