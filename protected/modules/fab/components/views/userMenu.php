<?php echo CHtml::link(Yii::app()->user->username,array('user/profile'),array('class'=>'username')); ?>
, 
<?php echo CHtml::link(Yii::t('FabModule.fab','Logout'),array('user/logout')); ?>