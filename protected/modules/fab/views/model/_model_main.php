<li>
    <div style="display: none;" class="modelfield" id="<?php echo $fmClass->uniquerID; ?>"
         onclick='showtool_fields("<?php echo $fmClass->uniquerID; ?>","<?php echo $fmClass->nameID; ?>", "<?php echo Yii::app()->createUrl('/fab/model/FieldUpdateRender', array('fieldId' => $fmClass->uniquerID)); ?>");'
         onmouseover="$(this).addClass('foucemouseoverfield');"
         onmouseout="$(this).removeClass('foucemouseoverfield');">
        <div class="fieldtools">
            <span id="sortTitle_<?php echo $fmClass->uniquerID; ?>" style="font-size:150%;color:green;"></span>
            <span onclick='remove_fields("<?php echo $fmClass->uniquerID; ?>");'
                  style='cursor: pointer;'><?php echo Yii::t('FabModule.fab', 'Del'); ?></span>
            <!-- <span onclick='showtool_fields("<?php echo $fmClass->uniquerID; ?>");' style='cursor: pointer;'><?php echo Yii::t('FabModule.fab','E'); ?></span> -->
            <!-- <span onclick='copy_fields("<?php echo $fmClass->uniquerID; ?>");' style='cursor: pointer;'><?php echo Yii::t('FabModule.fab','C'); ?></span>-->
            <!-- <span onclick='logField("<?php echo $fmClass->uniquerID; ?>");' style='cursor: pointer;'><?php echo Yii::t('FabModule.fab','I'); ?></span>-->
        </div>
        <div class="fieldcontent">
            <?php echo $content; ?>
        </div>
    </div>
</li>