<?php

/**
 * This is the model class for table "gene".
 *
 * The followings are the available columns in table 'gene':
 * @property integer $id
 * @property string $symbol
 * @property string $name
 * @property integer $tax_id
 * @property string $synonyms
 * @property string $type_of_gene
 *
 * The followings are the available model relations:
 * @property Species $tax
 * @property GeneOrder[] $geneOrders
 * @property Position[] $positions
 */
class Gene extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gene the static model class
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
		return 'gene';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, symbol, tax_id', 'required'),
			array('id, tax_id', 'numerical', 'integerOnly'=>true),
			array('symbol, type_of_gene', 'length', 'max'=>45),
			array('name', 'length', 'max'=>200),
			array('synonyms', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, symbol, name, tax_id, synonyms, type_of_gene', 'safe', 'on'=>'search'),
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
			'tax' => array(self::BELONGS_TO, 'Species', 'tax_id'),
			'geneOrders' => array(self::HAS_MANY, 'GeneOrder', 'gene_id'),
			'positions' => array(self::HAS_MANY, 'Position', 'gene_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'symbol' => 'Symbol',
			'name' => 'Name',
			'tax_id' => 'Tax',
			'synonyms' => 'Synonyms',
			'type_of_gene' => 'Type Of Gene',
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
		$criteria->compare('symbol',$this->symbol,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tax_id',$this->tax_id);
		$criteria->compare('synonyms',$this->synonyms,true);
		$criteria->compare('type_of_gene',$this->type_of_gene,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}