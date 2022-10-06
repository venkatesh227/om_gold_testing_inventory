<?php

class DashboardController extends Controller
{
	public function actionIndex()
	{
		$prvSummary = Inventory::summary(['prv'=>true]);
		$summary = Inventory::summary(['prvSummary'=>$prvSummary]);
		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
		$model->iType='2';
		if(isset($_GET['Inventory']))
			$model->attributes=$_GET['Inventory'];
        $model->dtInventoryDate = date("Y/m/d")." - ".date("Y/m/d");
		$this->render('index',array(
			'model'=>$model,
			'summary'=>$summary
		));
	}

	public function actionDbdownload()
	{
		$prvSummary = Inventory::summary(['prv'=>true]);
		$summary = Inventory::summary(['prvSummary'=>$prvSummary]);

		$fp = fopen('php://temp', 'w');

		Yii::import('ext.ECSVExport');
		$filename = time().'.csv';
		/* 
		 * Write a header of csv file
		 */
		$headers = array(
			'SL No',
			'iWeight',
			'iTouch',
			'iInput',
			'iFinalGrams',
			'Adjustment',
			'iCustomerID',
		);
		$headerLabel = array();
		foreach($headers as $header) {
			$headerLabel[] = Inventory::model()->getAttributeLabel($header);
		}

		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
        $model->dtInventoryDate = date("Y/m/d")." - ".date("Y/m/d");
		if(isset($_GET['Inventory'])) {
			$model->attributes=$_GET['Inventory'];
		}
		$dp = $model->search();
		$csvData = array();
		$csvData[] = ['','','','','',$summary['1-1']."gms"];
		$csvData[] = $headerLabel;
		$row=1;
		$totalWeight = 0;
		$totalInput = 0;
		$totalOutput = 0;
		foreach ($dp->getData() as $key => $value) {
			$rowData = array();
			
			$rowData[] = $row;
			$rowData[] = $value->iWeight;
			$rowData[] = $value->iTouch;
			$rowData[] = $value->iInput;
			$rowData[] = $value->iFinalGrams;
			$rowData[] = "";
			$rowData[] = ($value->customer)?$value->customer->vcName:"-";
			
			$totalWeight += $value->iWeight;
			$totalInput += $value->iInput;
			$totalOutput += $value->iFinalGrams;

			$csvData[] = $rowData;
			$row++;
		}	
		$csvData[] = ['Total',$totalWeight,$totalInput-$totalOutput,$totalInput,$totalOutput,''];
		$csvData[] = ['','','','','',$summary['1-3']."gms"];
		$defaultHeader = ['','','','','',"Date : ".date('d/m/Y')];
		//print_r($dp->getData());
		$csv = new ECSVExport($csvData);
		$csv->setHeaders($defaultHeader);
		$output = $csv->toCSV();
		Yii::app()->getRequest()->sendFile($filename, $output, "text/csv", false);
		die();
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
			'Adjustment',
			'iCustomerID',
		);
		$headerLabel = array();
		foreach($headers as $header) {
			$headerLabel[] = Inventory::model()->getAttributeLabel($header);
		}
		fputcsv($fp,$headerLabel);

		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
        $model->dtInventoryDate = date("Y/m/d")." - ".date("Y/m/d");
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
			$rowData[] = "";
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

	public function actionDownloadPdf(){
		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
        //$model->noPagination = true;
        $model->dtInventoryDate = date("Y/m/d")." - ".date("Y/m/d");
		if(isset($_GET['Inventory']))
			$model->attributes=$_GET['Inventory'];

		$this->render('_downloadpdf',array(
			'model'=>$model,
		));
	}
}