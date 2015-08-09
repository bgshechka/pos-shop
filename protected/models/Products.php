<?php

/**
 * This is the model class for table "Products".
 *
 * The followings are the available columns in table 'Products':
 * @property integer $id
 * @property integer $type_id
 * @property string $article
 * @property string $photo
 * @property string $description
 * @property string $prices
 * @property string $price_intervals
 * @property string $values_
 *
 * The followings are the available model relations:
 * @property ProductTypes $type
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id, article, photo, description, prices, price_intervals, values_', 'required'),
			array('type_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type_id, article, photo, description, prices, price_intervals, values_', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'ProductTypes', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_id' => 'Type',
			'article' => 'Article',
			'photo' => 'Photo',
			'description' => 'Description',
			'prices' => 'Prices',
			'price_intervals' => 'Price Intervals',
			'values_' => 'Values',
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
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('prices',$this->prices,true);
		$criteria->compare('price_intervals',$this->price_intervals,true);
		$criteria->compare('values_',$this->values_,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//возвращает селовекочитаемою строку с промежутками цен
	public  function getPriceString()
	{
		$prices = json_decode($this->prices);
		$intervals = json_decode($this->price_intervals);

		$firstInt = 1;
		
		$priceStr = "<table>";
		for ($i=0;$i<count($prices);$i++)
		{
			$secondInt = $intervals[$i];
			if ($secondInt!=-1)	$priceStr = $priceStr."<tr><td>$firstInt-$secondInt шт.</td><td>-$prices[$i] р.</td></tr>";
			else $priceStr = $priceStr."<tr><td> > $firstInt шт.</td><td>-$prices[$i] р.</td></tr>";
			$firstInt = $secondInt;
		}
		$priceStr = $priceStr."</table>";
		return $priceStr;
	}
}
