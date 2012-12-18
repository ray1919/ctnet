<?php

/**
 * This is the model class for table "position".
 *
 * The followings are the available columns in table 'position':
 * @property integer $id
 * @property integer $plate_id
 * @property string $well
 * @property integer $gene_id
 * @property integer $store_type_id
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Plate $plate
 * @property StoreType $storeType
 * @property Gene $gene
 */
class Position extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Position the static model class
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
		return 'position';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('plate_id, well, gene_id, store_type_id', 'required'),
			array('plate_id, gene_id, store_type_id', 'numerical', 'integerOnly'=>true),
			array('well', 'length', 'max'=>10),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, plate_id, well, gene_id, store_type_id, comment', 'safe', 'on'=>'search'),
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
			'plate' => array(self::BELONGS_TO, 'Plate', 'plate_id'),
			'storeType' => array(self::BELONGS_TO, 'StoreType', 'store_type_id'),
			'gene' => array(self::BELONGS_TO, 'Gene', 'gene_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'plate_id' => 'Plate',
			'well' => 'Well',
			'gene_id' => 'Gene',
			'store_type_id' => 'Store Type',
			'comment' => 'Comment',
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
		$criteria->compare('plate_id',$this->plate_id);
		$criteria->compare('well',$this->well,true);
		$criteria->compare('gene_id',$this->gene_id);
		$criteria->compare('store_type_id',$this->store_type_id);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}