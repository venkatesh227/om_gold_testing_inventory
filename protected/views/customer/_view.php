<?php
/* @var $this CustomerController */
/* @var $data Customer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('iCustomerID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->iCustomerID), array('view', 'id'=>$data->iCustomerID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vcName')); ?>:</b>
	<?php echo CHtml::encode($data->vcName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iPhoneNumber')); ?>:</b>
	<?php echo CHtml::encode($data->iPhoneNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iStatus')); ?>:</b>
	<?php echo CHtml::encode($data->iStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtCreatedOn')); ?>:</b>
	<?php echo CHtml::encode($data->dtCreatedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtModifiedOn')); ?>:</b>
	<?php echo CHtml::encode($data->dtModifiedOn); ?>
	<br />


</div>