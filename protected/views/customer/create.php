<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
          Create Customer
          <a href="<?php echo Yii::app()->createUrl('customer'); ?>" class="float-right">Back To Customer list</a>        
    </h6>
  </div>
  <div class="card-body">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
  </div>
</div>
