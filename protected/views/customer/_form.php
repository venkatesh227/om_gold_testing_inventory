<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form CActiveForm */
?>

<div class="col">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
      'class'=>'customForm',
      "autocomplete"=>"off",
      'enctype' => 'multipart/form-data'
    ),
    'enableClientValidation'=>true,
    'clientOptions'=>array(
      'validateOnSubmit'=>true,
    ),
)); ?>

	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-6 form-group">
			<?php echo $form->labelEx($model,'vcName',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'vcName',array('size'=>60,'maxlength'=>150,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'vcName'); ?>
		</div>
	</div>
	<div class="row">	
		<div class="col-6 form-group">
			<?php echo $form->labelEx($model,'iPhoneNumber',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'iPhoneNumber',array('size'=>12,'maxlength'=>12,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'iPhoneNumber'); ?>
		</div>	
	</div>
	<div class="row">	
		<div class="col-6 form-group">
			<?php echo $form->labelEx($model,'vcCity',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'vcCity',array('size'=>60,'maxlength'=>150,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'vcCity'); ?>
		</div>	
	</div>
	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-lg btn-secondary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->