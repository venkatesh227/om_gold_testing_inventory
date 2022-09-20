<?php
/* @var $this InventoryController */
/* @var $model Inventory */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#inventory-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

$('#Inventory_dtInventoryDate').daterangepicker({
	maxDate: new Date(),
	locale: {
		format: 'YYYY/MM/DD'
	},
});  

$(document).on('click','#downloadExcel',function(){
    //downloadExcel(this);
    var downloadLink = document.createElement('a');
    var selInventoryDate = $('#Inventory_dtInventoryDate').val();
    var selInventoryPID = $('#Inventory_iProductID').val();
    var selInventoryType = $('#Inventory_iType').val();
    var selCustomerID = $('#Inventory_iCustomerID').val();
    var params = '?Inventory[dtInventoryDate]='+selInventoryDate+'&Inventory[iProductID]='+selInventoryPID+'&Inventory[iType]='+selInventoryType+'&Inventory[iCustomerID]='+selCustomerID+'&downloadExport=true'
    downloadLink.href = '".Yii::app()->createUrl('dashboard/download')."'+params;
    downloadLink.target = '_blank';
    document.body.appendChild(downloadLink); 
    downloadLink.click();
    document.body.removeChild(downloadLink); 
});

");
?>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Manage Inventory
				<a href="<?php echo Yii::app()->createUrl('inventory/create'); ?>" class="float-right">Add Inventory</a>
            </h6>
        </div>
        <div class="card-body">
			<?php $this->renderPartial('_search',array(
				'model'=>$model,
			));?>
        	<div class="table-responsive mt-2">
				<?php $this->widget('bootstrap.widgets.BsGridView', array(
					'id'=>'inventory-grid',
					'dataProvider'=>$model->search(),
					'htmlOptions'=>array('class'=>'dataTables_wrapper dt-bootstrap4'),
					//'filter'=>$model,
					'columns'=>array(
						'iID'=>array(
							'name'=>'iID',
                            'filter'=>false
                        ),
						
                        'iProductID'=>array(
                            'name'=>'iProductID',
                            'value'=>function($data){
                                return Yii::app()->params['products'][$data->iProductID];
                            },
                            'filter' => CHtml::activeDropDownList($model, 'iProductID', Yii::app()->params['products'],
                                array('empty' => 'All')
                            )
                        ),
						'iWeight'=>array(
							'name'=>"iWeight",
							'filter'=>false
						),
						'iTouch'=>array(
                            'name'=>'iTouch',
                            'filter'=>false
                        ),
                        'iInput'=>array(
                            'name'=>'iInput',
                            'filter'=>false
                        ),
                        'iFinalGrams'=>array(
                            'name'=>'iFinalGrams',
                            'filter'=>false
                        ),
                        'dtInventoryDate',
                        'iType'=>array(
                            'name'=>'iType',
                            'value'=>function($data){
                                return Yii::app()->params['inventoryTypesShort'][$data->iType];
                            },
                            'filter' => CHtml::activeDropDownList($model, 'iType', Yii::app()->params['inventoryTypesShort'],
                                array('empty' => 'All')
                            )
                        ),
                        'iCustomerID'=>array(
                            'name'=>'iCustomerID',
                            'value'=>function($data){
                                $returnVal = '-';
                                if($data->customer){
                                    return $data->customer->vcName;
                                }
                                return $returnVal;
                            },
                            'filter' => CHtml::activeDropDownList($model, 'iCustomerID', CHtml::listData(Customer::model()->findAll("iStatus='1'"), 'iCustomerID', 'vcName'),
                                array('empty' => 'All')
                            )                            
                        ),
						/*'iStatus'=>array(
							'name'=>"iStatus",
							'filter'=>false,
							'value'=>function($data){
								$status = "Inactive";
								if($data->iStatus==1)
									$status="Active";
								else if($data->iStatus==2)
									$status="Deleted";
								return $status;
							}
						),*/
						//'dtCreatedOn',
						/*'dtModifiedOn'=>array(
							'name'=>"dtModifiedOn",
							'filter'=>false
						),*/
						array(
							'class'=>'CButtonColumn',
							'template'=>'{update}&nbsp;&nbsp;{print}&nbsp;&nbsp;{delete}',
							'buttons'=>array(
								 'delete' => array(
									'label'=>'Delete',
									'imageUrl'=>false,
									'icon'=>'glyphicon glyphicon-lock',
									'url'=>'$this->grid->controller->createUrl("inventory/delete/",array("id"=>$data->iID))',
									'visible' => '$data->iStatus!=2'

								),
								'print' => array(
									'label'=>'Print',
									 'options'=>array('target'=>'_blank'),
									'url'=>'$this->grid->controller->createUrl("/inventory/print/$data->iID")',
									'visible'=>'$data->iType==2'
								),								 
								'update' => array(
									'label'=>'Update',
									'imageUrl'=>false,	
									'url'=>'$this->grid->controller->createUrl("inventory/update/",array("id"=>$data->iID))',
									'visible' => '$data->iStatus!=2'
								),
							),
						),
					),
				)); 
				?>
			</div>	
		</div>
	</div>
