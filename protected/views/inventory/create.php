<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
          Create Inventory
          <a href="<?php echo Yii::app()->createUrl('inventory'); ?>" class="float-right">Back To Inventory list</a>        
    </h6>
  </div>
  <div class="card-body">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
  </div>
</div>
