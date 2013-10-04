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
    echo '<div class="grid_14" style="font-weight:bold;margin-top:6px;margin-bottom:6px;">';
    echo CHtml::encode($Former->attr->FormTitle);
    echo '</div>';
    echo '<div class="grid_10" style="text-align:right;margin-top:6px;margin-bottom:6px;">';
    echo ' <strong>建立者:</strong> '.CHtml::encode($model->user->username);
    echo ' <strong>时间:</strong> '.Fabdate($model->created,'Y-m-d 星期* H:i');
    echo '</div>';
  ?>
  <div class="clear"></div>
  
  <?php $this->widget('Datatables_post', array(
    'data'=>$posts,
    'fields'=>$fields,
    'ajaxurl'=>$this->createUrl('/test/t'),
    )); ?>

  </div>
</div>