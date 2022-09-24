                <?php $this->widget('bootstrap.widgets.BsGridView', array(
                    'id'=>'inventory-grid',
                    'dataProvider'=>$model->search(),
                    'htmlOptions'=>array('class'=>'dataTables_wrapper dt-bootstrap4'),
                    'enablePagination'=>false,
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript">
        ExportPDF();
        setTimeout(function(){window.close();},1000);
        function ExportPDF() {
            html2canvas($("table.items"), {
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