<?php
/* @var $this InventoryController */
/* @var $model Inventory */
/* @var $form CActiveForm */
?>

<div class="wide form mb-4">

<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	    'htmlOptions' => array(
	      'class'=>'customForm form-inline',
	      "autocomplete"=>"off",
	    ),
	)); 
?>
	<div class="row col-12">
		<div class="col-4">
			<?php echo $form->label($model,'dtInventoryDate',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'dtInventoryDate',array('class'=>'form-control')); ?>
		</div>

		<div class="col-6 mt-4">
			<?php //echo CHtml::submitButton('Search'); ?>
			<button class="btn btn-sm btn-primary shadow-sm mr-1">
	            <i class="fas fa-search fa-sm text-white-50"></i> 
	            Search
	        </button>		
	        <button type="button" id="downloadExcel" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1">
	            <i class="fas fa-download fa-sm text-white-50"></i> 
	            Download Excel
	        </button>
	        <button type="button" id="downloadPdf" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
	            <i class="fas fa-download fa-sm text-white-50"></i> 
	            Download PDF
	        </button>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->