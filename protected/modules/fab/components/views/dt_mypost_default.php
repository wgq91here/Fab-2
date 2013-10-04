<table id="datatables<?php echo $ID; ?>" class="display">
<thead>
  <tr>
  <th style="width: 140px;">递交时间</th>
  <th style="width: 190px;">表单名称</th>
  <th style="width: 70px;">表单创建者</th>
  <th>您递交的内容</th>
  <th style="width: 30px;">操作</th>
  </tr>  
</thead>
<tbody>
<?php foreach($data as $n=>$d): ?>
  <tr>    
  <td><?php echo Fabdate($d->created,'Y-m-d 星期* H:i'); ?></td>    
  <td><strong><?php echo CHtml::link(CHtml::encode($d->model->title),array('model/submit/id/'.$d->mid),array('target'=>'preview')); ?></strong>
  </td>
  <td><?php echo CHtml::encode($d->model->user->username);?></td>
  <td><?php 
    $postData = unserialize($d->pdata);
    echo htmlspecialchars(FabStrlen(current($postData),50));
    echo CHtml::link(' [view]',array('post/view/id/'.$d->pid),array('target'=>'viewpost'));
     ?></td>
  <td>  
  <?php
  if ($d->model->locked == models::UNLOCK) {
   echo CHtml::ajaxLink(
    Yii::t('FabModule.fab','Delete'),
    Yii::app()->urlManager->createUrl('fab/post/delete'),
    array(
      'dataType'=>'json',
      'type'=>'POST',
      'beforeSend'=>'function() { if (confirm("你确信要删除此记录吗？")) { return true;} else {return false; } }',
      'success'=>"function(data) { alert(data.n); oTable.fnDeleteRow(data.n); }",
      'data'=>array('n'=>$n,'id'=>$d->pid,'mid'=>$d->mid)),
      array('id'=>'delete_'.$d->pid)
    );    
   } else {
    echo '-';
   } ?>    
  </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>