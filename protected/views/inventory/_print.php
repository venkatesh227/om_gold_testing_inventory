<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<table cellpadding="1" cellspacing="1" class="table table-bordered w-75 mt-5" align="center">
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
<script type="text/javascript">
	window.print();
	window.onafterprint = function(){
        window.close()
    }
	//window.close();
	setTimeout(function(){window.close();},1000);
</script>