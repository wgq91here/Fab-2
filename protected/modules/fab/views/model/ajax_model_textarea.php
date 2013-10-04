<span id="<?php echo $fmClass->uniquerID; ?>_title"><?php echo $fmClass->getAttribute('Label'); ?></span>:<br/>
<?php
echo CHtml::textArea($fmClass->uniquerID . '_field', '', array('cols' => $fmClass->getAttribute('Cols'), 'rows' => $fmClass->getAttribute('Rows')));
?>