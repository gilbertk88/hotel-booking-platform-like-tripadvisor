<?php

/**
 * This is the model class for table "userplan".
 *
 * The followings are the available columns in table 'userplan':
 * @property integer $id
 * @property integer $userId
 * @property integer $planId
 * @property string $expiryDate
 * @property string $dateActivated
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Plans $plan
 */
class Userplan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'userplan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, planId, expiryDate, dateActivated', 'required'),
			array('userId, planId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, planId, expiryDate, dateActivated', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
			'plan' => array(self::BELONGS_TO, 'Plans', 'planId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'planId' => 'Plan',
			'expiryDate' => 'Expiry Date',
			'dateActivated' => 'Date Activated',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('planId',$this->planId);
		$criteria->compare('expiryDate',$this->expiryDate,true);
		$criteria->compare('dateActivated',$this->dateActivated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Userplan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
