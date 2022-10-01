<?php
/* @var $this InventoryController */
/* @var $model Inventory */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('search', "
	$('#Inventory_dtInventoryDate').daterangepicker({
	    singleDatePicker: true,
	    showDropdowns: true,
	 	//startDate: moment().startOf('hour'),
	    //endDate: moment().startOf('hour').add(32, 'hour'),	    
	    timePicker: true,
		locale: {
			format: 'YYYY-MM-DD HH:mm:ss'
		},
		autoApply: true,
		maxDate: new Date() 
	});	 
	function toggleInventoryType(){
		inventoryTypeVal = $('#Inventory_iType').val();
		if(inventoryTypeVal==2){
			$('#toggleCustomerInfo').show();
			$('#toggleTouch').show();
			$('#toggleWastage').show();
		}
		else{
			$('#toggleCustomerInfo').hide();
			$('#toggleTouch').hide();
			$('#toggleWastage').hide();
		}
	}
	$(document).on('change','#Inventory_iType',function(){
		toggleInventoryType();
	});
	$('#toggleCustomerInfo').hide();
	toggleInventoryType();
");
?>
<div class="col">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inventory-form',
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

	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php //echo $form->errorSummary($model); ?> 

	<div class="row">
		<div class="col-6 form-group"> 
			<?php echo $form->labelEx($model,'iProductID',array('class'=>'control-label')); ?>
			<?php 
				echo $form->dropDownList($model,'iProductID', Yii::app()->params['products'], array('empty'=>'Select Product','class'=>'form-control')); 
			?>			
			<?php echo $form->error($model,'iProductID'); ?>
		</div>
		<div class="col-6 form-group"> 
			<?php echo $form->labelEx($model,'dtInventoryDate',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'dtInventoryDate',array('class'=>'form-control','readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'dtInventoryDate'); ?>
		</div>	
	</div>

	<div class="row">
		<div class="col-6 form-group"> 
			<?php echo $form->labelEx($model,'iType',array('class'=>'control-label')); ?>
			<?php 
				echo $form->dropDownList($model,'iType', Yii::app()->params['inventoryTypes'], array('empty'=>'Select Inventory Type','class'=>'form-control')); 
			?>			
			<?php echo $form->error($model,'iType'); ?>
		</div>	
		<div class="col-6 form-group" id="toggleCustomerInfo"> 
			<?php echo $form->labelEx($model,'iCustomerID',array('class'=>'control-label')); ?>
			<?php //echo $form->textField($model,'iCustomerID',array('class'=>'form-control')); ?>
			<?php
				$userCondition = "iStatus='1'";
				echo $form->dropDownList($model, 'iCustomerID', CHtml::listData(Customer::model()->findAll(["condition"=>$userCondition,"select"=>"iCustomerID, CONCAT(vcName,'(',vcCity,')') as vcName"]), 'iCustomerID', 'vcName'),array('empty'=>'Select Customer','class'=>'form-control'));
			?>
			<?php echo $form->error($model,'iCustomerID'); ?>
		</div>		
	</div>

	<div class="row">
		<div class="col-6 form-group"> 
			<?php echo $form->labelEx($model,'iWeight',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'iWeight',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'iWeight'); ?>
		</div>		
		<div class="col-6 form-group" id="toggleTouch"> 
			<?php echo $form->labelEx($model,'iTouch',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'iTouch',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'iTouch'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-6 form-group" id="toggleWastage"> 
			<?php echo $form->labelEx($model,'iWastage',array('class'=>'control-label')); ?>
			<?php //echo $form->textField($model,'iWastage',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
			<?php
				echo $form->dropDownList($model,'iWastage', Yii::app()->params['productWastage'], array('class'=>'form-control')); 
				?>
			<?php echo $form->error($model,'iWastage'); ?>
		</div>
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-lg btn-secondary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->