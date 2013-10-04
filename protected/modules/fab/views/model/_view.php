<?php foreach($myforms as $n=>$data): ?>
<div class="post">
    <?php echo CHtml::encode($data->mid); ?> - posted by <?php echo ' on ' . date('Y-m-d', $data->created); ?> <br />
</div>
<?php endforeach; ?>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>