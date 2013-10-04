<fieldset class="choices" style="border:1px solid #CCCCCC;" onclick="SimpleText_changeID('<?php echo $fmClass->uniquerID; ?>');">
  <legend><?php echo Yii::t('FabModule.fab', 'Base Attributes'); ?></legend>

  <div><?php echo Yii::t('FabModule.fab', 'Field Label'); ?>:&nbsp;按[ctrl+enter]更新</div>
<?php
echo CHtml::textArea(
        'fieldLabel_'.$fmClass->uniquerID,
        $fmClass->getAttribute('Label'),
        array('rows'=>'10','class'=>'xheditor-mini','style'=>'font-size:12px;','onKeyUp'=>'changeLabel("'.$fmClass->uniquerID.'",this.value);')
); ?>
</fieldset>