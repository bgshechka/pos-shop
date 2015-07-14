<?php

/**
 * This is the model class for table "new_Products".
 *
 * The followings are the available columns in table 'new_Products':
 * @property integer $id
 * @property string $name
 * @property string $model
 * @property string $format
 * @property string $orientation
 * @property string $thickness
 * @property string $mount
 * @property string $article
 * @property string $price
 * @property string $description
 * @property string $photo
 * @property string $price_number_1
 * @property string $price_number_2
 * @property string $price_number_3
 * @property string $reserved_0
 * @property string $reserved_1
 * @property string $reserved_2
 * @property string $reserved_3
 * @property string $reserved_4
 */
class NewProducts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'new_Products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, model, format, orientation, thickness, mount, article, price, description, photo, price_number_1, price_number_2, price_number_3, reserved_0, reserved_1, reserved_2, reserved_3, reserved_4', 'required'),
			array('name', 'required'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, model, format, orientation, thickness, mount, article, price, description, photo, price_number_1, price_number_2, price_number_3, reserved_0, reserved_1, reserved_2, reserved_3, reserved_4', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'model' => 'Model',
			'format' => 'Format',
			'orientation' => 'Orientation',
			'thickness' => 'Thickness',
			'mount' => 'Mount',
			'article' => 'Article',
			'price' => 'Price',
			'description' => 'Description',
			'photo' => 'Photo',
			'price_number_1' => 'Price Number 1',
			'price_number_2' => 'Price Number 2',
			'price_number_3' => 'Price Number 3',
			'reserved_0' => 'Reserved 0',
			'reserved_1' => 'Reserved 1',
			'reserved_2' => 'Reserved 2',
			'reserved_3' => 'Reserved 3',
			'reserved_4' => 'Reserved 4',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('format',$this->format,true);
		$criteria->compare('orientation',$this->orientation,true);
		$criteria->compare('thickness',$this->thickness,true);
		$criteria->compare('mount',$this->mount,true);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('price_number_1',$this->price_number_1,true);
		$criteria->compare('price_number_2',$this->price_number_2,true);
		$criteria->compare('price_number_3',$this->price_number_3,true);
		$criteria->compare('reserved_0',$this->reserved_0,true);
		$criteria->compare('reserved_1',$this->reserved_1,true);
		$criteria->compare('reserved_2',$this->reserved_2,true);
		$criteria->compare('reserved_3',$this->reserved_3,true);
		$criteria->compare('reserved_4',$this->reserved_4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewProducts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
