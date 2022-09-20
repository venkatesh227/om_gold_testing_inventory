<?php
/* @var $this InventoryController */
/* @var $data Inventory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('iID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->iID), array('view', 'id'=>$data->iID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iProductID')); ?>:</b>
	<?php echo CHtml::encode($data->iProductID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtInventoryDate')); ?>:</b>
	<?php echo CHtml::encode($data->dtInventoryDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iWeight')); ?>:</b>
	<?php echo CHtml::encode($data->iWeight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iType')); ?>:</b>
	<?php echo CHtml::encode($data->iType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iCustomerID')); ?>:</b>
	<?php echo CHtml::encode($data->iCustomerID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iStatus')); ?>:</b>
	<?php echo CHtml::encode($data->iStatus); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dtCreatedOn')); ?>:</b>
	<?php echo CHtml::encode($data->dtCreatedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtModifiedOn')); ?>:</b>
	<?php echo CHtml::encode($data->dtModifiedOn); ?>
	<br />

	*/ ?>

</div>