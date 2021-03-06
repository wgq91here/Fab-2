<fieldset class="choices" style="border:1px solid #CCCCCC;">
    <legend><?php echo Yii::t('FabModule.fab', 'Base Attributes'); ?></legend>

    <div><?php echo Yii::t('FabModule.fab', 'Field Label'); ?>:</div>
    <?php
    echo CHtml::textField(
        'fieldLabel_' . $fmClass->uniquerID,
        $fmClass->getAttribute('Label'),
        array('onKeyUp' => 'changeLabel("' . $fmClass->uniquerID . '",this.value);')
    ); ?>

    <div><?php echo Yii::t('FabModule.fab', 'Check Options'); ?>:</div>
    <div id="<?php echo $fmClass->uniquerID; ?>_options">
        <?php
        $_Select = empty($fmClass->Select) ? array_keys($fmClass->getAttribute('Select')) : $fmClass->Select;
        foreach ($fmClass->getAttribute('Data') as $key => $option):
            $_KEY = $key - 1;
            ?>
            <div id="<?php echo $_KEY; ?>">
                <?php
                echo CHtml::textField(
                    'option_' . $_KEY,
                    $option,
                    array('onKeyUp' => 'changeCheckboxOption("' . $fmClass->uniquerID . '",$(this).parent().attr("id"),this.value);')
                );
                ?>
                &nbsp;<A HREF="javascript:void(null);"
                         onclick="insertCheckbox('<?php echo $fmClass->uniquerID; ?>',$(this));">[insert]</A>
                &nbsp;<A HREF="javascript:void(null);"
                         onclick="deleteCheckbox('<?php echo $fmClass->uniquerID; ?>',$(this));">[delete]</A>
                <?php
                $_selectCssClass = (in_array($key, $_Select)) ? "selected" : "unselect";
                $_selectValue = (in_array($key, $_Select)) ? "[unselect]" : "[select]";
                ?>
                &nbsp;<A name="checkboxSelect" class="<?php echo $_selectCssClass; ?>" HREF="javascript:void(null);"
                         onclick="selectedCheckbox('<?php echo $fmClass->uniquerID; ?>',$(this));"><?php echo $_selectValue; ?>
                </A>
            </div>
        <?php endforeach; ?>
    </div>

</fieldset>

<fieldset class="choices" style="border:1px solid #CCCCCC;">
    <legend><?php echo Yii::t('FabModule.fab', 'Advanced Attributes'); ?></legend>
    <div><?php echo Yii::t('FabModule.fab', 'Field Required'); ?>:
        &nbsp;
        <?php
        echo CHtml::checkBox(
            $fmClass->uniquerID . '_required',
            $fmClass->getAttribute('Required'),
            array('onclick' => 'Field_update_data("' . $fmClass->uniquerID . '","Required",$(this).attr("checked"));')
        );
        ?>
    </div>
</fieldset>
