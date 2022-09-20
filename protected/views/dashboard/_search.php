<?php
/* @var $this InventoryController */
/* @var $model Inventory */
/* @var $form CActiveForm */
?>

<div class="wide form">

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
		<?php /*?>
		<div class="col-3">
			<?php echo $form->label($model,'dtInventoryDate',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'dtInventoryDate',array('class'=>'form-control')); ?>
		</div>
		<?php */?>

		<div class="col-3">
			<?php echo $form->label($model,'iProductID',array('class'=>'control-label')); ?>
			<?php
				echo CHtml::activeDropDownList($model, 'iProductID', Yii::app()->params['products'],array('empty' => 'All','class'=>'form-control'));
			?>
		</div>

		<div class="col-3">
			<?php echo $form->label($model,'iType',array('class'=>'control-label')); ?>
			<?php
				echo CHtml::activeDropDownList($model, 'iType', Yii::app()->params['inventoryTypesShort'],array('empty' => 'All','class'=>'form-control'));
			?>
		</div>

		<div class="col-3">
			<?php echo $form->label($model,'iCustomerID',array('class'=>'control-label')); ?>
			<?php 
				echo CHtml::activeDropDownList($model, 'iCustomerID', CHtml::listData(Customer::model()->findAll("iStatus='1'"), 'iCustomerID', 'vcName'),
	                                array('empty' => 'All','class'=>'form-control'));
			?>
		</div>
	</div>
	<div class="row col-12 mt-2">
		<div class="col-3 buttons">
			<?php //echo CHtml::submitButton('Search'); ?>
			<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1">
	            <i class="fas fa-search fa-sm text-white-50"></i> 
	            Search
	        </button>		
			<!-- <a href="<?php echo Yii::app()->createUrl('inventory'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1">
	            <i class="fas fa-search fa-sm text-white-50"></i> 
	            Reset
	        </a> -->		
	        <button type="button" id="downloadExcel" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1">
	            <i class="fas fa-download fa-sm text-white-50"></i> 
	            Download Excel
	        </button>
	        <!-- <button type="button" id="downloadPdf" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
	            <i class="fas fa-download fa-sm text-white-50"></i> 
	            Download PDF
	        </button> -->
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->