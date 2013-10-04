<fieldset class="choices" style="border:1px solid #CCCCCC;" onclick="SimpleText_changeID('<?php echo $fmClass->uniquerID; ?>');">
  <legend><?php echo Yii::t('FabModule.fab', 'Base Attributes'); ?></legend>

  <div><?php echo Yii::t('FabModule.fab', 'Field Label'); ?>:</div>
<?php echo CHtml::textField(
        'fieldLabel_'.$fmClass->uniquerID,
        $fmClass->getAttribute('Label'),
        array('onKeyUp'=>'changeLabel("'.$fmClass->uniquerID.'",this.value);')
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
</fieldset>

</div>