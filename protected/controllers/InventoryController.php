<?php

class InventoryController extends Controller
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionPrint($id)
	{
		$this->renderPartial('_print',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Inventory;
		$model->dtInventoryDate = date('Y-m-d H:i:s');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Inventory']))
		{
			$model->attributes=$_POST['Inventory'];
			$model->dtCreatedOn = date('Y-m-d H:i:s');
			$model->dtModifiedOn = date('Y-m-d H:i:s');
			
			if($model->iType==1){
				$model->iCustomerID = NULL;
				$model->iTouch = NULL;
			}
			else if($model->iType==2 && $model->iWeight && $model->iTouch){
				$model->iWastage = Yii::app()->params['productWastage'];
				$making = $model->iTouch - $model->iWastage;
				$model->iInput = ($model->iWeight * $model->iTouch)/100;
				$model->iFinalGrams = ($model->iWeight * $making)/100;
			}

			if($model->save()){
				Yii::app()->user->setFlash('successMessage','Inventory created successfully');
				if($model->iType==2)
					$this->redirect(array('view','id'=>$model->iID));
				else
					$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Inventory']))
		{
			$model->attributes=$_POST['Inventory'];
			$model->dtModifiedOn = date('Y-m-d H:i:s');

			if($model->iType==1){
				$model->iCustomerID = NULL;
				$model->iTouch = NULL;
			}
			else if($model->iType==2 && $model->iWeight && $model->iTouch){
				$model->iWastage = Yii::app()->params['productWastage'];
				$making = $model->iTouch - $model->iWastage;
				$model->iInput = $model->iWeight - $making;
				$model->iFinalGrams = ($model->iWeight * $making)/100;
			}

			if($model->save()){
				Yii::app()->user->setFlash('successMessage','Selected Inventory details updated successfully');
				if($model->iType==2)
					$this->redirect(array('view','id'=>$model->iID));
				else
					$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//$this->loadModel($id)->delete();

		$model = $this->loadModel($id);
		$model->iStatus='2';
		$model->dtModifiedOn = date('Y-m-d H:i:s');
		$model->save(false);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
		$model->dtInventoryDate = date("Y/m/d")." - ".date("Y/m/d");
		if(isset($_GET['Inventory']))
			$model->attributes=$_GET['Inventory'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Inventory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Inventory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Inventory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
