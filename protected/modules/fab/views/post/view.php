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
      Right...     
      </div>
    </div>

  </div>

  <div class="clear"></div>

</div>

<div id="wrapper" style="overflow: auto;">
  <div class="container_24">
  
  <?php
    $data = unserialize($post->pdata); 
    echo '<div class="grid_14" style="font-weight:bold;margin-top:6px;margin-bottom:6px;">';
    echo CHtml::link(CHtml::encode($Former->attr->FormTitle),array('model/submit','id'=>$post->mid),array('target'=>'preview'));
    echo '</div>';
    echo '<div class="grid_10" style="text-align:right;margin-top:6px;margin-bottom:6px;">';
    echo ' <strong>建立者:</strong> '.CHtml::encode($model->user->username);
    echo ' <strong>时间:</strong> '.Fabdate($model->created,'Y-m-d 星期* H:i');
    echo '</div>';
  ?>
  <div class="clear"></div>
  <?php //echo vdump($Former); ?>
  <?php //var_dump($Former->model->_labels); ?>
  
  <table class="tableattr" style="margin-bottom: 10px;">  
  <?php foreach ($Former->model->_labels as $key=>$label)
  { ?>
  <tr>
    <td class="tleft ttile" width="20%"><?php echo $label; ?></td>
    <td class="tright"><?php echo $data[$key]; ?></td>
  </tr>  
  <?php } ?>
  </table>

  <div class="clear"></div>
  </div>
</div>