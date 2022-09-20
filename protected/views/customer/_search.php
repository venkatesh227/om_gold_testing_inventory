<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'iCustomerID'); ?>
		<?php echo $form->textField($model,'iCustomerID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vcName'); ?>
		<?php echo $form->textField($model,'vcName',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iPhoneNumber'); ?>
		<?php echo $form->textField($model,'iPhoneNumber',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iStatus'); ?>
		<?php echo $form->textField($model,'iStatus',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dtCreatedOn'); ?>
		<?php echo $form->textField($model,'dtCreatedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dtModifiedOn'); ?>
		<?php echo $form->textField($model,'dtModifiedOn'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->