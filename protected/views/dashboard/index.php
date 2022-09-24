<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $('#inventory-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
//$('#Inventory_dtInventoryDate').daterangepicker();  

$(document).on('click','#downloadExcel',function(){
    var downloadLink = document.createElement('a');
    var selInventoryDate = $('#Inventory_dtInventoryDate').val();
    var selInventoryPID = $('#Inventory_iProductID').val();
    var selInventoryType = $('#Inventory_iType').val();
    var selCustomerID = $('#Inventory_iCustomerID').val();
    var params = '?Inventory[iProductID]='+selInventoryPID+'&Inventory[iType]='+selInventoryType+'&Inventory[iCustomerID]='+selCustomerID+'&downloadExport=true'
    downloadLink.href = '".Yii::app()->createUrl('dashboard/download')."'+params;
    downloadLink.target = '_blank';
    document.body.appendChild(downloadLink); 
    downloadLink.click();
    document.body.removeChild(downloadLink); 
});

$(document).on('click','#downloadPdf',function(){
    var downloadLink = document.createElement('a');
    var selInventoryDate = $('#Inventory_dtInventoryDate').val();
    var selInventoryPID = $('#Inventory_iProductID').val();
    var selInventoryType = $('#Inventory_iType').val();
    var selCustomerID = $('#Inventory_iCustomerID').val();
    var params = '?Inventory[iProductID]='+selInventoryPID+'&Inventory[iType]='+selInventoryType+'&Inventory[iCustomerID]='+selCustomerID+'&downloadExport=true'
    downloadLink.href = '".Yii::app()->createUrl('dashboard/downloadpdf')."'+params;
    downloadLink.target = '_blank';
    document.body.appendChild(downloadLink); 
    downloadLink.click();
    document.body.removeChild(downloadLink); 
});


");
?>

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <?php
        foreach ($summary as $key => $value) {
        $keySplit = explode('-',$key);   
        $typecolor = ($key==1)?'warning':'secondary';
    ?>    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-<?php echo $typecolor;?> shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-<?php echo $typecolor;?> text-uppercase mb-1">
                            <?php 
                                echo Yii::app()->params['products'][$keySplit[0]]."(".Yii::app()->params['inventoryTypesShort'][$keySplit[1]].")";
                            ?>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $value;?>
                            <small>grams</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
</div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php 
                $this->renderPartial('_search',array(
                    'model'=>$model,
                ));
            ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            'name'=>'iWeight',
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
                    ),
                )); 
                ?>
            </div>  
        </div>
    </div>