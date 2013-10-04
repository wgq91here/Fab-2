<div style="height:100px;">&nbsp;</div>
<CENTER>
<table class="tableattr" style="width:450px;" cellspacing="0" cellpadding="2">
<?php echo CHtml::beginForm(); ?>
<tr>
<td id="bottomtd" colspan="2" bgcolor="#CFDDF8"><h5>Install&nbsp;<?php echo Yii::app()->controller->module->siteName; ?>&nbsp;<?php echo Yii::app()->controller->module->version; ?></h5></td>
</tr>
<tr>
<td id="righttd">
它是Yii的模块扩展。它最终目标是为了更加快速的实现Yii系统的搭建和完整的后台用户管理、权限管理和更高级的模型制作及管理功能。<br/><br/>

<div style="padding:20px;">
<HR>
<B>将执行以下内容:</B>
<UL style="padding-left:30px;">
	<LI>Create User Table</LI>
	<LI>Insert Admin User Record</LI>
</UL>
</div>

</td>
</tr>
<tr>
<td id="bottomtd" colspan="2" style="text-align:right"><?php echo CHtml::submitButton('确认安装'); ?></td>
</tr>
<?php echo CHtml::endForm(); ?>
<tr>
<td colspan="2" style="text-align:right"><div style="float:left;">&nbsp;<?php echo Yii::app()->controller->module->siteName; ?>&nbsp;<?php echo Yii::app()->controller->module->version; ?>&nbsp;-&nbsp;2010</div></td>
</tr>
</table>
</CENTER>