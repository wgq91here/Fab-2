<span id="<?php echo $fmClass->uniquerID; ?>_title"><?php echo $fmClass->getAttribute('Label'); ?></span>:<br/>
<?php
echo CHtml::TextField($fmClass->uniquerID.'_field','',array("class"=>"datepicker"));
?>