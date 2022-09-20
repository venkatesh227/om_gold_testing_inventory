<?php
/* @var $this CustomerController */
/* @var $model Customer */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
    <!-- Breadcrumbs-->
    <?php //echo $this->renderPartial('breadcrumbs',array('action'=>'Manage Customer'));?>
<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));*/?>
<!-- search-form -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Manage Customers
				<a href="<?php echo Yii::app()->createUrl('customer/create'); ?>" class="float-right">Add Customer</a> 				
            </h6>
        </div>
        <div class="card-body">
        	<div class="table-responsive">
				<?php $this->widget('bootstrap.widgets.BsGridView', array(
					'id'=>'customer-grid',
					'dataProvider'=>$model->search(),
					'htmlOptions'=>array('class'=>'dataTables_wrapper dt-bootstrap4'),
					//'filter'=>$model,
					'columns'=>array(
						//'iCustomerID',
						'vcName',
						'iPhoneNumber',
						'vcCity',
						'iStatus'=>array(
							'name'=>"Status",
							'value'=>function($data){
								$status = "Inactive";
								if($data->iStatus==1)
									$status="Active";
								else if($data->iStatus==2)
									$status="Deleted";
								return $status;
							}
						),
						//'dtCreatedOn',
						//'dtModifiedOn',
						array(
							'class'=>'CButtonColumn',
							'template'=>'{update}&nbsp;&nbsp;{delete}',
							'buttons'=>array(
								 'delete' => array(
									'label'=>'Delete',
									'imageUrl'=>false,
									'url'=>'$this->grid->controller->createUrl("customer/delete/",array("id"=>$data->iCustomerID))',
									'visible' => '$data->iStatus!=2'

								),
								 'update' => array(
									'label'=>'Update',
									'imageUrl'=>false,	
									'url'=>'$this->grid->controller->createUrl("customer/update/",array("id"=>$data->iCustomerID))',
									'visible' => '$data->iStatus!=2'
								),
							),
						),
					),
				)); ?>
			</div>	
		</div>
	</div>
