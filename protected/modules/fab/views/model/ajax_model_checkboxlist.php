<span id="<?php echo $fmClass->uniquerID; ?>_title">
<?php echo $fmClass->getAttribute('Label'); ?>
</span>:<br/>
<ul id="<?php echo $fmClass->uniquerID; ?>_ul" style="list-style:none;">
    <?php
    echo CHtml::checkBoxList(
        $fmClass->uniquerID . '_option',
        empty($fmClass->Select) ? array_keys($fmClass->getAttribute('Select')) : $fmClass->Select,
        $fmClass->getAttribute('Data'),
        array(
            'template' => '<li style="display:inline;padding-right:46px">{input} {label}</li>',
            'separator' => '',
            'disabled' => true,
        )
    );
    ?>
</ul>