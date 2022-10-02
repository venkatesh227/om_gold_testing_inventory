<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
          View Inventory #<?php echo $model->iID; ?>
          <a href="<?php echo Yii::app()->createUrl('inventory'); ?>" class="float-right">Back To Inventory list</a>
    </h6>
  </div>
  <div class="card-body">
  	<div id="printDiv">
		<table cellpadding="1" cellspacing="1" class="table table-bordered">
			<tr>
				<td colspan="2" class="text-center">
					<?php echo Yii::app()->name;?>
					<br>
					Receipt
				</td>
			</tr>
			<tr>
				<td>Receipt No : <?php echo $model->iID;?></td>
				<td class="text-right">Date :  <?php echo date("d/m/Y H:i:s",strtotime($model->dtInventoryDate));?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><?php echo $model->customer->vcName;?></td>
			</tr>
			<tr>
				<td>Town / City</td>
				<td><?php echo $model->customer->vcCity;?></td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td><?php echo $model->customer->iPhoneNumber;?></td>
			</tr>
			<!-- <tr>
				<td>Product</td>
				<td><?php echo Yii::app()->params['products'][$model->iProductID];?></td>
			</tr> -->
			<tr>
				<td>Weight (in gms)</td>
				<td><?php echo $model->iWeight;?></td>
			</tr>
			<tr>
				<td>Touch</td>
				<td><?php echo $model->iTouch;?></td>
			</tr>
			<tr>
				<td>Wastage</td>
				<td><?php echo $model->iWastage;?></td>
			</tr>
			<tr>
				<td>Final Weight (in gms)</td>
				<td><?php echo $model->iFinalGrams;?></td>
			</tr>
		</table>
  	</div>
		<a href="<?php echo Yii::app()->createUrl('inventory/print')."/".$model->iID;?>" class="btn btn-primary text-center" target="_blank">Print</a>  		
  </div>
</div>
