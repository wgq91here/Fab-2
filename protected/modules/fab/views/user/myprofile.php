<?php $this->pageTitle=Yii::app()->name . ' - '.
Yii::t("FabModule.fab", "Profile");

$this->breadcrumbs=array(
	Yii::t("FabModule.fab", "Profile"),
);
?>

<h2><?php echo Yii::t("FabModule.fab", 'Your profile'); ?></h2>

<?php

$this->menu=array(
	array('label'=>Yii::t('FabModule.fab', 'Manage User'), 'url'=>array('admin'), 'visible' => Yii::app()->User->isAdmin()),
	array('label'=>Yii::t('FabModule.fab', 'Manage Roles'), 'url'=>array('role/admin'), 'visible' => Yii::app()->User->isAdmin()),
	array('label'=>Yii::t('FabModule.fab', 'List User'), 'url'=>array('index'), 'visible' => !Yii::app()->User->isAdmin()),
	array('label'=>Yii::t('FabModule.fab', 'Profile'), 'url'=>array('profile')),
	array('label'=>Yii::t('FabModule.fab', 'Edit'), 'url'=>array('edit')),
	array('label'=>Yii::t('FabModule.fab', 'Change password'), 'url'=>array('changepassword')),
	array('label'=>Yii::t('FabModule.fab', 'My Inbox'), 'url'=>array('messages/index')),
	array('label'=>Yii::t('FabModule.fab', 'Compose a Message'), 'url'=>array('messages/compose')),
	array('label'=>Yii::t('FabModule.fab', 'Logout'), 'url'=>array('logout')),
	
);

?>

<?php //$this->renderPartial('/messages/newMessages') ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?>
</th>
    <td><?php echo CHtml::encode($model->username); ?>
</td>
</tr>
<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
<tr>
	<th class="label"><?php echo CHtml::encode(Yii::t("FabModule.fab", $field->title)); ?>
</th>
    <td><?php echo CHtml::encode($profile->getAttribute($field->varname)); ?>
</td>
</tr>
			<?php
			}
		}
?>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('password')); ?>
</th>
    <td><?php echo CHtml::link(Yii::t("FabModule.fab", "Change password"),array("changepassword")); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>
</th>
    <td><?php echo CHtml::encode($model->email); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>
</th>
    <td><?php echo date("d.m.Y H:i:s",$model->createtime); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit')); ?>
</th>
    <td><?php echo date("d.m.Y H:i:s",$model->lastvisit); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>
</th>
    <td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status));
    ?>
</td>
</tr>
</table>
