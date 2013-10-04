<fieldset class="choices">
  <legend><?php echo Yii::t('FabModule.fab', 'Base Attributes'); ?></legend>

<div><?php echo Yii::t('FabModule.fab', 'Field Label'); ?>:</div>
<?php echo CHtml::textField(
        'fieldLabel_'.$fmClass->uniquerID,
        $fmClass->getAttribute('Label'),
        array('onKeyUp'=>'changeLabel("'.$fmClass->uniquerID.'",this.value);')
); ?>

<div><?php echo Yii::t('FabModule.fab', 'Field Size'); ?>:</div>
<?php
echo CHtml::listBox(
        'fieldFieldSize_'.$fmClass->uniquerID,
        $fmClass->getAttribute('Size'),
        $fmClass->Size ,
        array('size'=>1,'onChange'=>'changeFieldSize("'.$fmClass->uniquerID.'",this.value);')
); ?>
</fieldset>

<div>
<fieldset class="choices" style="border:1px solid #CCCCCC;">
  <legend><?php echo Yii::t('FabModule.fab', 'Advanced Attributes'); ?></legend>
<div><?php echo Yii::t('FabModule.fab', 'Field Required'); ?>:
<?php
echo CHtml::checkBox(
        $fmClass->uniquerID.'_required',
        $fmClass->getAttribute('Required'),
        array('onclick'=>'Field_update_data("'.$fmClass->uniquerID.'","Required",$(this).attr("checked"));')
        );
?>
</div>
  
<div><?php echo Yii::t('FabModule.fab', 'Min Length'); ?>:</div>
<div>
<?php echo CHtml::textField(
        'Minlength_'.$fmClass->uniquerID,
        $fmClass->getAttribute('Minlength'),
        array(
          'onKeyUp'=>'ChangeMLength("'.$fmClass->uniquerID.'","Minlength");'
        )
); ?>
</div>
<div><?php echo Yii::t('FabModule.fab', 'Max Length'); ?>:</div>
<div>
<?php echo CHtml::textField(
        'Maxlength_'.$fmClass->uniquerID,
        $fmClass->getAttribute('Maxlength'),
        array(
          'onKeyUp'=>'ChangeMLength("'.$fmClass->uniquerID.'","Maxlength");'
        )
); ?>
</div>
</fieldset>
</div>

<A HREF="#" onclick="copy_fields('<?php echo $fmClass->uniquerID; ?>');">ajax_model_update_text</A>
<?php echo $fmClass->uniquerID; ?>

