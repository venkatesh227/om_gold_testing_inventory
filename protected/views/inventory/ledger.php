<?php
$model->showAllRecords = true;
Yii::app()->clientScript->registerScript('search', "
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
");
?>

    <div class="card shadow mb-4 w-100">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Inventory Ledger
            </h6>
        </div>
        <div class="card-body" id="dashboardSummary">
            <?php 
                $this->renderPartial('_search_ledger',array(
                    'model'=>$model,
                ));
            ?>
        	<div class="table-responsive" id="downloadLedger">
				<table class="items table table-bordered">
					<thead>
						<tr>
							<th scope="col">S.No</th>
							<th scope="col">Inventory Date</th>
							<th scope="col">Weight</th>
							<th scope="col">Touch</th>
							<th scope="col">In</th>
							<th scope="col">Out</th>
							<th scope="col">Name</th>
							<th scope="col">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$row=1;
							$total = $summary['1-3'];
						?>
						<tr>
							<th scope="row"><?php echo $row;?></th>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<th class="text-right"><?php echo $total; ?></th>
						</tr>
						<?php
							$data = $model->search()->getData();
							if(count($data)>0)
							{
								foreach($data as $dataKey=>$dataValue)
								{
									$row++;
									if($dataValue->iType=='1')
										$total+=$dataValue->iWeight;
									else
										$total-=$dataValue->iFinalGrams;
						?>
								<tr>
									<th scope="row"><?php echo $row;?></th>
									<td><?php echo date('d-m-Y h:i',strtotime($dataValue->dtInventoryDate));?></td>
									<td><?php echo $dataValue->iWeight;?></td>
									<td><?php echo $dataValue->iTouch;?></td>
									<td><?php echo $dataValue->iInput;?></td>
									<td><?php echo $dataValue->iFinalGrams;?></td>
									<td><?php echo ($dataValue->customer)?$dataValue->customer->vcName:"";?></td>
									<th class="text-right"><?php echo $total; ?></th>
								</tr>
						<?php		
								}
							}
							else
							{
						?>
								<tr>
									<td colspan="8">No results found.</td>
								</tr>
						<?php		
							}
						?>
						<tr>
							<th scope="row"><?php echo $row+1;?></th>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<th class="text-right"><?php echo $total; ?></th>
						</tr>
					</tbody>
				</table>
        	</div>  
        </div>
    </div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>



<script type="text/javascript">
    $(document).on('click','#downloadPdf',function(){
        ExportPDF();
    });
    $(document).on('click','#downloadExcel',function(){
        ExportExcel();
    });
    function ExportExcel(){
    	var type ="csv";
		var data = document.getElementById('downloadLedger');
		var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
		XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
		XLSX.writeFile(file, 'file.' + type);    	
    }
    function ExportPDF() {
        html2canvas($("#downloadLedger"), {
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