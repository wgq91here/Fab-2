<table id="datatables<?php echo $ID; ?>" class="display">
<thead>
  <tr>
  <th style="width: 140px;">表单建立日期</th>
  <th>表单标题(点击标题预览)</th>
  <th style="width: 80px;">已递交数据</th>
  <th style="width: 200px;">最后递交信息</th>
  <th style="width: 26px;">状态</th>
  <th style="width: 26px;">编辑</th>
  <th style="width: 26px;">删除</th>
  </tr>  
</thead>
<tbody>
<?php foreach($data as $n=>$d): ?>
  <tr>    
  <td><?php //echo CHtml::encode($data->mid); ?><?php echo Fabdate($d->created,'Y-m-d 星期* H:i'); ?></td>    
  <td><strong><?php echo CHtml::link(CHtml::encode($d->title),array('model/submit/id/'.$d->mid),array('target'=>'preview')); ?></strong>
  </td>
  <td><?php echo ($d->items>0)?CHtml::link($d->items.' 条',array('post/list/id/'.$d->mid)):'-'; ?>  
  <?php //echo CHtml::link(Yii::t('FabModule.fab','Preview'),array('model/submit/id/'.$d->mid),array('target'=>'preview')); ?></td>
  <td><?php echo CHtml::encode($d->lastmessage); ?></td>
  <td><?php if ($d->locked == models::LOCK) $lock = 'Unlock'; else $lock = 'Lock';
  echo CHtml::ajaxLink(
    Yii::t('FabModule.fab',$lock),
    Yii::app()->urlManager->createUrl('fab/model/lock'),
    array('update'=>"#{$d->mid}",'data'=>array('id'=>$d->mid)),
    array('id'=>$d->mid)
    ); ?>
  </td>
  <td>
  <?php echo ($d->items>0)?'-':CHtml::link(Yii::t('FabModule.fab','Edit'),array('/fab/model/update/id/'.$d->mid)); ?>  
  </td>
  <td>  
  <?php echo CHtml::ajaxLink(
    Yii::t('FabModule.fab','Delete'),
    Yii::app()->urlManager->createUrl('fab/model/delete'),
    array(
      'dataType'=>'json',
      'beforeSend'=>'function() { if (confirm("你确信要删除此表单吗？\n注意: 对应记录都将删除!")) { return true;} else {return false; } }',
      'success'=>"function(data) { if (data.error) { alert(data.html); } else { alert(data.html); oTable.fnDeleteRow(data.n); } }",
      'data'=>array('n'=>$n,'id'=>$d->mid)),
    array('id'=>'delete_'.$d->mid)
    );?>
  </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php 
  //$FormSubmitUrl = 'http://'.$_SERVER['HTTP_HOST'].Yii::app()->createUrl('fab/model/submit',array('id'=>$d->mid));
  //echo CHtml::link('['.Yii::t('FabModule.fab','Copy').']','#',array('onclick'=>'copyToClipboard("'.$FormSubmitUrl.'");')); ?>
  <?php //echo CHtml::link('['.Yii::t('FabModule.fab','删除').']',array('model/deleteform/id/'.$d->mid)); ?>