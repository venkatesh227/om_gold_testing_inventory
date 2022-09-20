<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $iCustomerID
 * @property string $vcName
 * @property string $iPhoneNumber
 * @property string $iStatus
 * @property string $dtCreatedOn
 * @property string $dtModifiedOn
 */
class Customer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vcName, iPhoneNumber, vcCity, dtCreatedOn, dtModifiedOn', 'required'),
			array('vcName, vcCity', 'length', 'max'=>150),
			array('vcName', 'duplicateNameCheck'),
			array('vcCity','match', 'pattern' => '/^[a-zA-Z ]*$/','message' => 'Town/City must be alphabets.'),			
			array('iPhoneNumber', 'numerical', 'integerOnly'=>true),
			//array('iPhoneNumber', 'length', 'max'=>20),
			array('iPhoneNumber','match', 'pattern' => '/^[0-9]{10,12}$/','message' => 'Phone Number is invalid.'),			
			array('iStatus', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iCustomerID, vcName, vcCity, iPhoneNumber, iStatus, dtCreatedOn, dtModifiedOn', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iCustomerID' => 'Customer ID',
			'vcName' => 'Name',
			'iPhoneNumber' => 'Phone Number',
			'vcCity'=> 'Town/City',
			'iStatus' => 'Status',
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

		$criteria->compare('iCustomerID',$this->iCustomerID);
		$criteria->compare('vcName',$this->vcName,true);
		$criteria->compare('iPhoneNumber',$this->iPhoneNumber,true);
		$criteria->compare('vcCity',$this->vcCity,true);
		$criteria->compare('iStatus',$this->iStatus,true);
		$criteria->compare('dtCreatedOn',$this->dtCreatedOn,true);
		$criteria->compare('dtModifiedOn',$this->dtModifiedOn,true);

		$criteria->condition = "iStatus!='2'";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
	        	'pageSize'=>Yii::app()->params['pagenationLimit'],
	    	),			
			'sort'=>array(
				'defaultOrder'=>'t.iCustomerID desc',
			)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function duplicateNameCheck($attributes,$params){
		$condition ="t.iStatus!='2' and t.vcName='".$this->vcName."'";
		if($this->iCustomerID)
			$condition.=" and iCustomerID!=".$this->iCustomerID;
		$condition.=" order by iCustomerID desc";
		$cDetails = $this->find($condition);	
		if($cDetails){
			return $this->addError('vcName', 'Customer Name Already Exist');
		}	
	}

}
