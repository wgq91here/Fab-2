<div style="padding-top: 30px;">
<div class="pagetitle">感谢您递交此表单，以下是您递交的信息。</div>
<table class="tableattr">
<?php
foreach ($data as $key=>$value)
{ ?>
<tr>
  <td id="lefttd"><?php echo $labels[$key]; ?></td>
  <td id="righttd"><?php echo $value; ?></td>
</tr>
<?php } ?>
</table>
<div class="ddiv"><?php echo CHtml::button(Yii::t('FabModule.fab','Close Window'),array('onclick'=>'window.opener="x";window.close();')); ?></div>
<?php
//echo vdump($data);
//echo vdump($labels);
?>
</div>