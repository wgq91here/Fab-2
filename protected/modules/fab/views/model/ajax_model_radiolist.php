<span id="<?php echo $fmClass->uniquerID; ?>_title">
<?php echo $fmClass->getAttribute('Label'); ?>
</span>:<br/>
<ul id="<?php echo $fmClass->uniquerID; ?>_ul" style="list-style:none;">
    <?php
    echo CHtml::radioButtonList(
        $fmClass->uniquerID . '_option',
        empty($fmClass->Select) ? $fmClass->getAttribute('Select') : $fmClass->Select,
        $fmClass->getAttribute('Data'),
        array(
            'template' => '<li style="display:inline;padding-right:46px">{input} {label}</li>',
            'separator' => '',
            'disabled' => true,
        )
    );
    ?>
</ul>