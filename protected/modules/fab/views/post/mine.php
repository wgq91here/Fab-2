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
  
  <?php $this->widget('Datatables_mypost', array(
    'data'=>$posts,
    )); ?>
  

  </div>
</div>