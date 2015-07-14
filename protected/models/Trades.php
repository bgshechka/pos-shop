<?php

/**
 * This is the model class for table "Trades".
 *
 * The followings are the available columns in table 'Trades':
 * @property integer $id
 * @property string $date
 * @property string $tradeInfo
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $comment
 * @property string $paymentType
 * @property integer $totalPrice
 */
class Trades extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Trades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, tradeInfo, name, phone, email,, paymentType, totalPrice', 'required'),
			array('totalPrice', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			array('phone, email', 'length', 'max'=>255),
			array('paymentType', 'length', 'max'=>50),
			// The following rule is used by search().
			array('address, comment','unsafe'),
			// @todo Please remove those attributes that should not be searched.
			//array('id, date, tradeInfo, name, phone, email, address, comment, paymentType, totalPrice', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'date' => 'Date',
			'tradeInfo' => 'Trade Info',
			'name' => 'Name',
			'phone' => 'Phone',
			'email' => 'Email',
			'address' => 'Address',
			'comment' => 'Comment',
			'paymentType' => 'Payment Type',
			'totalPrice' => 'Total Price',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('tradeInfo',$this->tradeInfo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('paymentType',$this->paymentType,true);
		$criteria->compare('totalPrice',$this->totalPrice);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Trades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
