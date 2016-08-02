<?php

/**
 * This is the model class for table "position".
 *
 * The followings are the available columns in table 'position':
 * @property integer $id
 * @property integer $plate_id
 * @property string $well
 * @property integer $primer_id
 * @property integer $store_type_id
 * @property string $comment
 * @property string $store_date
 *
 * The followings are the available model relations:
 * @property Plate $plate
 * @property Primer $primer
 * @property StoreType $storeType
 */
class Position extends CActiveRecord
{
  public $primer_search1;
  public $primer_search2;
  public $primer_search3;
  public $plate_search;
  public $st_search;
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
			array('plate_id, well', 'required'),
			array('plate_id, primer_id, store_type_id', 'numerical', 'integerOnly'=>true),
			array('well', 'length', 'max'=>10),
			array('comment, store_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, plate_id, well, primer_id, store_type_id, comment,
                            store_date, primer_search1, primer_search2, primer_search3,
                            plate_search, st_search, synthetic_name',
                            'safe', 'on'=>'search'),
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
			'primer' => array(self::BELONGS_TO, 'Primer', 'primer_id'),
			'storeType' => array(self::BELONGS_TO, 'StoreType', 'store_type_id'),
      'primerPositions' => array(self::HAS_MANY, 'PrimerPosition', 'position_id'),
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
			'primer_id' => 'Primer',
			'store_type_id' => 'Store Type',
			'comment' => 'Note',
			'store_date' => 'Store Date',
                        'synthetic_name' => 'Synthetic Name',
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
		$criteria->compare('primer_id',$this->primer_id);
		$criteria->compare('store_type_id',$this->store_type_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('store_date',$this->store_date,true);
		$criteria->compare('synthetic_name',$this->synthetic_name,true);

                $criteria->with = array( 'primer', 'plate', 'storeType' );
                $criteria->compare( 'primer.gene_symbol', $this->primer_search1, true );
                $criteria->compare( 'primer.gene_id', $this->primer_search2, true );
                $criteria->compare( 'primer.primer_id', $this->primer_search3, true );
                $criteria->compare( 'plate.name', $this->plate_search, true );
                $criteria->compare( 'storeType.name', $this->st_search, true );

		return new CActiveDataProvider($this, array(
                            'criteria'=>$criteria,
                            'sort'=>array(
                              'attributes'=>array(
                                  'primer_search1'=>array(
                                      'asc'=>'primer.gene_symbol',
                                      'desc'=>'primer.gene_symbol DESC',
                                  ),
                                  'primer_search2'=>array(
                                      'asc'=>'primer.gene_id',
                                      'desc'=>'primer.gene_id DESC',
                                  ),
                                  'primer_search3'=>array(
                                      'asc'=>'primer.primer_id',
                                      'desc'=>'primer.primer_id DESC',
                                  ),
                                  'plate_search'=>array(
                                      'asc'=>'plate.name',
                                      'desc'=>'plate.name DESC',
                                  ),
                                  'st_search'=>array(
                                      'asc'=>'storeType.name',
                                      'desc'=>'storeType.name DESC',
                                  ),
                                  '*',
                              ),
                            ),
		));
	}

  public function getStoreType()
  {
    $getStoreType = CHtml::listData(StoreType::model()->findAll(), 'id', 'name');
    return $getStoreType;
  }

  public function getPlateName()
  {
    $getStoreType = CHtml::listData(Plate::model()->findAll(array('order'=>'name')), 'id', 'name');
    return $getStoreType;
  }

  public function getPrimerId()
  {
    $primer_id = Primer::model()->id;
    return $primer_id;
  }

  public function getGeneSymbol($position_id)
  {
    $symbols = Yii::app()->db->createCommand("
      SELECT group_concat(gene_symbol) name
      FROM primer p, position o, primer_position pp
      WHERE pp.primer_id = p.id
      AND pp.position_id = o.id
      AND o.id = $position_id
      GROUP BY o.id
      ")->queryScalar();
    return $symbols;
  }

  public function getPrimerColumn($position_id, $column)
  {
    $symbols = Yii::app()->db->createCommand("
      SELECT group_concat(p.$column SEPARATOR ', ')
      FROM primer p, position o, primer_position pp
      WHERE pp.primer_id = p.id
      AND pp.position_id = o.id
      AND o.id = $position_id
      GROUP BY o.id
      ")->queryScalar();
    return $symbols;
  }
}
