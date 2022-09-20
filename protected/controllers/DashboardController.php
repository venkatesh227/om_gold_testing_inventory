<?php

class DashboardController extends Controller
{
	public function actionIndex()
	{
		$summary = Inventory::summary();
		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inventory']))
			$model->attributes=$_GET['Inventory'];

		$this->render('index',array(
			'model'=>$model,
			'summary'=>$summary
		));
	}

	public function actionDownload()
	{
		$fp = fopen('php://temp', 'w');

		Yii::import('ext.ECSVExport');
		$filename = time().'.csv';
		/* 
		 * Write a header of csv file
		 */
		$headers = array(
			'dtInventoryDate',
			'iProductID',
			'iType',
			'iWeight',
			'iCustomerID',
		);
		$headerLabel = array();
		foreach($headers as $header) {
			$headerLabel[] = Inventory::model()->getAttributeLabel($header);
		}
		fputcsv($fp,$headerLabel);

		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inventory'])) {
			$model->attributes=$_GET['Inventory'];
		}

		$dp = $model->search();
		$csvData = array();
		//$csvData[] = $headerLabel;

		foreach ($dp->getData() as $key => $value) {
			$rowData = array();
			
			$rowData[] = $value->dtInventoryDate;
			$rowData[] = Yii::app()->params['products'][$value->iProductID];
			$rowData[] = Yii::app()->params['inventoryTypesShort'][$value->iProductID];
			$rowData[] = $value->iWeight;
			$rowData[] = ($value->customer)?$value->customer->vcName:"-";

			$csvData[] = $rowData;
		}	

		//print_r($dp->getData());
		$csv = new ECSVExport($csvData);
		$csv->setHeaders($headerLabel);
		$output = $csv->toCSV();
		Yii::app()->getRequest()->sendFile($filename, $output, "text/csv", false);
		die();
	}	
}