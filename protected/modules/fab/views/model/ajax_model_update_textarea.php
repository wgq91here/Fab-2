<fieldset class="choices">
    <legend><?php echo Yii::t('FabModule.fab', 'Base Attributes'); ?></legend>

    <div><?php echo Yii::t('FabModule.fab', 'Field Label'); ?>:</div>
    <?php echo CHtml::textField(
        'fieldLabel_' . $fmClass->uniquerID,
        $fmClass->getAttribute('Label'),
        array('onKeyUp' => 'changeLabel("' . $fmClass->uniquerID . '",this.value);')
    ); ?>

    <div><?php echo Yii::t('FabModule.fab', 'Rows'); ?>:</div>
    <div>
        <?php echo CHtml::textField(
            'Rows_' . $fmClass->uniquerID,
            $fmClass->getAttribute('Rows'),
            array(
                'onKeyUp' => 'TextArea_cols_change("' . $fmClass->uniquerID . '","Rows",this.value);'
            )
        ); ?>
    </div>

    <div><?php echo Yii::t('FabModule.fab', 'editorclass'); ?>:</div>
    <div>
        <?php echo CHtml::listBox(
            'editorclass_' . $fmClass->uniquerID,
            $fmClass->getAttribute('editorclass'),
            $fmClass->editorSelect,
            array(
                'size' => 1,
                'onchange' => 'Field_update_data("' . $fmClass->uniquerID . '","editorclass",this.value);'
            )
        ); ?>
    </div>

</fieldset>

<div>
    <fieldset class="choices" style="border:1px solid #CCCCCC;">
        <legend><?php echo Yii::t('FabModule.fab', 'Advanced Attributes'); ?></legend>
        <div><?php echo Yii::t('FabModule.fab', 'Field Required'); ?>:
            <?php
            echo CHtml::checkBox(
                $fmClass->uniquerID . '_required',
                $fmClass->getAttribute('Required'),
                array('onclick' => 'Field_update_data("' . $fmClass->uniquerID . '","Required",$(this).attr("checked"));')
            );
            ?>
        </div>

    </fieldset>
</div>