<?php

/**
 * This is the model class for table "gene_order".
 *
 * The followings are the available columns in table 'gene_order':
 * @property integer $id
 * @property integer $gene_id
 * @property integer $customer_id
 * @property double $price
 * @property integer $quantity
 * @property string $date
 * @property string $status
 * @property string $comment
 * @property string $create_time
 *
 * The followings are the available model relations:
 * @property Gene $gene
 * @property Customer $customer
 */
class GeneOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GeneOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gene_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gene_id, customer_id, quantity', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('status', 'length', 'max'=>45),
			array('date, comment, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gene_id, customer_id, price, quantity, date, status, comment, create_time', 'safe', 'on'=>'search'),
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
			'gene' => array(self::BELONGS_TO, 'Gene', 'gene_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gene_id' => 'Gene',
			'customer_id' => 'Customer',
			'price' => 'Price',
			'quantity' => 'Quantity',
			'date' => 'Date',
			'status' => 'Status',
			'comment' => 'Comment',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('gene_id',$this->gene_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}