<div id="navigation">
    <div class="container_24" style="height:25px;padding-top:5px;">
        <div class="grid_20">
            <div style="text-align:left;padding-right: 5px;">
                <?php
                $this->widget('fab.components.FormMenu');
                ?>
            </div>
        </div>

        <div class="grid_4">
            <div style="text-align:right;padding-right: 5px;">
                <?php echo CHtml::link('自定义表单', 'create', array('class' => 'button wide')); ?>
            </div>
        </div>

    </div>

    <div class="clear"></div>

</div>

<div id="wrapper" style="overflow: auto;">
    <div class="container_24">

        <?php $i = 0;
        foreach ($advanceForms as $key => $aForm) { ?>
            <div class="grid_8">
                <div style="padding-top: 5px;text-align:center;">
                    <?php echo CHtml::link(CHtml::image($this->assetImagePath . '/' . $key . '.png', $aForm['FormTitle'], array('width' => 200, 'height' => 200)), array('advancegeneration', 'formid' => $key)); ?>
                </div>
                <div style="padding-bottom: 5px;text-align:center;">
                    <?php echo CHtml::link($aForm['FormTitle'], array('advancegeneration', 'formid' => $key), array('style' => 'font-weight:bold;')); ?>
                </div>
            </div>
            <?php $i++;
            if ($i % 3 == 0) echo '<div class="clear"></div>'; ?>
        <?php } ?>

        <div class="clear"></div>
    </div>
</div>