<?php

/**
 * This is the model class for table "inventory".
 *
 * The followings are the available columns in table 'inventory':
 * @property integer $iID
 * @property string $iProductID
 * @property string $dtInventoryDate
 * @property string $iWeight
 * @property string $iType
 * @property integer $iCustomerID
 * @property string $iStatus
 * @property string $dtCreatedOn
 * @property string $dtModifiedOn
 */
class Inventory extends CActiveRecord
{
	public $showAllRecords = false;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dtInventoryDate, iWeight, dtCreatedOn, dtModifiedOn, iType, iProductID', 'required'),
			array('iCustomerID', 'numerical', 'integerOnly'=>true),
			array('iWeight,iTouch,iWastage,iFinalGrams,iInput', 'match', 'pattern'=>'/^[0-9]\d*(\.\d+)?$/'),
			array('iProductID, iType, iStatus', 'length', 'max'=>1),
			array('iWeight,iTouch,iWastage,iFinalGrams,iInput', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iID, iProductID, dtInventoryDate, iWeight, iType, iCustomerID, iStatus, dtCreatedOn, dtModifiedOn, showAllRecords', 'safe', 'on'=>'search'),
			//array('iCustomerID', 'required','on'=>'insert_out,update_out'),
			array('iCustomerID', 'customerIDValidation'),
			array('iTouch','touchValidation'),
			array('iWeight','customBalanceCheck'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer'=>array(self::BELONGS_TO, 'Customer', 'iCustomerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iID' => 'ID',
			'iProductID' => 'Product Name',
			'dtInventoryDate' => 'Inventory Date',
			'iWeight' => 'Weight (in gms)',
			'iType' => 'Inventory Type',
			'iCustomerID' => 'Customer Name',
			'iStatus' => 'Status',
			'iTouch'=>'Touch',
			'iInput'=>'Input',
			'iWastage'=>'Wastage',
			'iFinalGrams'=>'Output',
			'dtCreatedOn' => 'Created On',
			'dtModifiedOn' => 'Modified On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = ['customer'];
		$criteria->compare('iID',$this->iID);
		$criteria->compare('iProductID',$this->iProductID,true);
		$criteria->compare('dtInventoryDate',$this->dtInventoryDate,true);
		$criteria->compare('iWeight',$this->iWeight,true);
		$criteria->compare('iType',$this->iType,true);
		$criteria->compare('iCustomerID',$this->iCustomerID);
		$criteria->compare('iStatus',$this->iStatus,true);
		$criteria->compare('dtCreatedOn',$this->dtCreatedOn,true);
		$criteria->compare('dtModifiedOn',$this->dtModifiedOn,true);
		
		$condition = "";

		if($this->dtInventoryDate){
			if(strpos($this->dtInventoryDate,'-')){
				$splitDates = explode(' - ',$this->dtInventoryDate);
				$startDate = date("Y-m-d 00:00:00",strtotime($splitDates[0]));
				$endDate = date("Y-m-d 23:59:59",strtotime($splitDates[1]));
				
				$condition = $condition." and (dtInventoryDate >= '".$startDate."' and dtInventoryDate<='".$endDate."')";
			}
		}

		if($this->iProductID)
			$condition = $condition." and iProductID='".$this->iProductID."'";

		if($this->iType)
			$condition = $condition." and iType='".$this->iType."'";

		if($this->iCustomerID)
			$condition = $condition." and t.iCustomerID=".$this->iCustomerID;

		$criteria->condition = "t.iStatus!='2'".$condition;
		
		$dataCriteria = array(
			'criteria'=>$criteria,
			'pagination'=>array(
	        	'pageSize'=>Yii::app()->params['pagenationLimit'],
	    	),			
			'sort'=>array(
				'defaultOrder'=>'t.iID desc',
			)

		);

		if((isset($_GET['downloadExport']) && $_GET['downloadExport']) || $this->showAllRecords) {
			$dataCriteria = array(
				'criteria'=>$criteria,
				'pagination'=>array(
		        	'pageSize'=>$this->count($criteria),
		    	),			
				'sort'=>array(
					'defaultOrder'=>'t.iID desc',
				)
			);
		}

		return new CActiveDataProvider($this, $dataCriteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Inventory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function customerIDValidation($attributes,$params){
		if($this->iType==2 && !$this->iCustomerID){
			return $this->addError('iCustomerID', 'Customer Name cannot be blank.');
		}
	}
	
	public function touchValidation($attributes,$params){
		if($this->iType==2 && !$this->iTouch){
			return $this->addError('iTouch', 'Touch cannot be blank.');
		}
	}

	public function summary($payload=[])
	{
		$returnSummary = [
			"1-1"=>0,
			"1-2"=>0,
			"1-3"=>0,
		];
		if(isset(Yii::app()->params['products'][2])){
			$returnSummary ["2-1"]=0;
			$returnSummary ["2-2"]=0;
			$returnSummary ["2-3"]=0;
		}
		$criteria = new CDbCriteria();
		$criteria->select = 'iProductID,sum(iWeight) AS iWeight,iType,sum(iFinalGrams) As iFinalGrams'; 
		$criteria->group = 'iProductID,iType';
		
		if(isset($payload['prv']) && $payload['prv'])
			$criteria->condition = "date(dtInventoryDate)<'".date('Y-m-d')."' and iStatus='1'";
		else			
			$criteria->condition = "(dtInventoryDate between '".Date('Y-m-d 00:00:00')."' and '".Date('Y-m-d 23:59:59')."') and iStatus='1'";

		$summaryDetails = Inventory::model()->findAll($criteria);
		foreach ($summaryDetails as $key => $value) {
			$setKey = $value->iProductID."-".$value->iType;
			if($value->iType!='2'){ // In
				$returnSummary[$setKey] = $value->iWeight;
				if(isset($payload['prvSummary']) && $payload['prvSummary'] && isset($payload['prvSummary'][$setKey])){
					$returnSummary[$setKey]+=$payload['prvSummary'][$setKey];
				}
			}
			else{//Out
				$returnSummary[$setKey] = $value->iFinalGrams;
			}

		}
		
		$returnSummary['1-3'] =$returnSummary['1-1']-$returnSummary['1-2'];

		if(isset(Yii::app()->params['products'][2])){
			$returnSummary['2-3'] =$returnSummary['2-1']-$returnSummary['2-2'];
		}

		return $returnSummary;
	}

	public function getTotal($records, $columns)
    {
        $total = array();
        foreach ($records as $record) {
            foreach ($columns as $column) {
                  if(!isset($total[$column]))$total[$column]=0;
                  $total[$column] += $record->$column;
            }
        }
        return $total;
    }
    public function customBalanceCheck($attributes,$params){
		$prvSummary = Inventory::summary(['prv'=>true]);
		$summary = Inventory::summary(['prvSummary'=>$prvSummary]);
		$avilableBalance = $summary[$this->iProductID.'-3']; 
		if($this->iWeight>$avilableBalance && $this->iType==2){
			return $this->addError('iWeight', 'Entered Weight is not avilable, avilable balance is : '.$avilableBalance);
		}
    }
}
