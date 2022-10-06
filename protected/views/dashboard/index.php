<?php
$model->showAllRecords = true;
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $('#inventory-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
//$('#Inventory_dtInventoryDate').daterangepicker();  

$(document).on('click','#downloadExcel',function(){
    if($('.empty').length){
        alert('No records to download');
        return false;
    }
    var downloadLink = document.createElement('a');
    var selInventoryDate = $('#Inventory_dtInventoryDate').val();
    var selInventoryPID = $('#Inventory_iProductID').val();
    var selInventoryType = $('#Inventory_iType').val();
    var selCustomerID = $('#Inventory_iCustomerID').val();
    var params = '?Inventory[iProductID]='+selInventoryPID+'&Inventory[iType]='+selInventoryType+'&Inventory[iCustomerID]='+selCustomerID+'&downloadExport=true'
    downloadLink.href = '".Yii::app()->createUrl('dashboard/dbdownload')."'+params;
    downloadLink.target = '_blank';
    document.body.appendChild(downloadLink); 
    downloadLink.click();
    document.body.removeChild(downloadLink); 
});

/*$(document).on('click','#downloadPdf',function(){
    if($('.empty').length){
        alert('No records to download');
        return false;
    }
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
});*/

$('.summary').parent().hide();

");
?>

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <?php
        foreach ($summary as $key => $value) {
        $keySplit = explode('-',$key);   
        $typecolor = ($key==1)?'warning':'secondary';
    ?>    
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-<?php echo $typecolor;?> shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-<?php echo $typecolor;?> text-uppercase mb-1">
                            <?php 
                                echo Yii::app()->params['products'][$keySplit[0]]." (".Yii::app()->params['dashboardSummaryNames'][$keySplit[1]].")";
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
        <div class="card-body" id="dashboardSummary">
            <div class="text-right mb-2">
                <?php echo "Date : ".date('d/m/Y'); ?><br>
            </div>
            <div class="text-right mb-2">
                <?php echo $summary['1-1']." gms"; ?><br>
            </div>
            <div class="table-responsive">
                <?php
                    $Totals=$model->getTotal($model->search()->getData(), array('iWeight','iInput','iFinalGrams'));
                ?>
                <?php $this->widget('bootstrap.widgets.BsGridView', array(
                    'id'=>'inventory-grid',
                    'dataProvider'=>$model->search(),
                    'htmlOptions'=>array('class'=>'dataTables_wrapper dt-bootstrap4'),
                    //'filter'=>$model,
                    'columns'=>array(
                        'iID'=>array(
                            'name'=>'SL No',
                            'filter'=>false,
                            'footer'=>'Total',
                            'value'=>'++$row'
                        ),
                        /*'iProductID'=>array(
                            'name'=>'iProductID',
                            'value'=>function($data){
                                return Yii::app()->params['products'][$data->iProductID];
                            },
                            'filter' => CHtml::activeDropDownList($model, 'iProductID', Yii::app()->params['products'],
                                array('empty' => 'All')
                            )
                        ),*/
                        'iWeight'=>array(
                            'name'=>'iWeight',
                            'filter'=>false,
                            'footer'=>($Totals)?number_format($Totals['iWeight'],2):false,
                        ),
                        'iTouch'=>array(
                            'name'=>'iTouch',
                            'filter'=>false,
                            'footer'=>($Totals)?number_format($Totals['iInput']-$Totals['iFinalGrams'],2):false,    
                        ),
                        'iInput'=>array(
                            'name'=>'iInput',
                            'filter'=>false,
                            'footer'=>($Totals)?number_format($Totals['iInput'],2):false,
                        ),
                        'iFinalGrams'=>array(
                            'name'=>'iFinalGrams',
                            'filter'=>false,
                            'footer'=>($Totals)?number_format($Totals['iFinalGrams'],2):false,
                        ),
                       // 'dtInventoryDate',
                        /*'iType'=>array(
                            'name'=>'iType',
                            'value'=>function($data){
                                return Yii::app()->params['inventoryTypesShort'][$data->iType];
                            },
                            'filter' => CHtml::activeDropDownList($model, 'iType', Yii::app()->params['inventoryTypesShort'],
                                array('empty' => 'All')
                            )
                        ),*/
                        'iAdjustment'=>array(
                            'name'=>'Adjustment',
                            'filter'=>false,
                            
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
            <div class="text-right mb-2">
                <?php echo $summary['1-3']." gms"; ?><br>
            </div>
        </div>
    </div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


<script type="text/javascript">
    $(document).on('click','#downloadPdf',function(){
        ExportPDF();
    });
    function ExportPDF() {
        html2canvas($("#dashboardSummary"), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("<?php echo time();?>.pdf");
            }
        });
    }

</script>                    