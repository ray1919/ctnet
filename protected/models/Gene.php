<?php

/**
 * This is the model class for table "gene".
 *
 * The followings are the available columns in table 'gene':
 * @property integer $gene_id
 * @property string $gene_symbol
 * @property string $gene_name
 * @property integer $tax_id
 * @property string $synonyms
 * @property string $type_of_gene
 *
 * The followings are the available model relations:
 * @property Species $tax
 * @property Primer[] $primers
 */
class Gene extends CActiveRecord
{
  public $tax_search;
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
			array('gene_id', 'required'),
			array('gene_id, tax_id', 'numerical', 'integerOnly'=>true),
			array('gene_symbol, type_of_gene', 'length', 'max'=>45),
			array('gene_name', 'length', 'max'=>200),
			array('synonyms', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gene_id, gene_symbol, gene_name, tax_id, synonyms, type_of_gene, tax_search', 'safe', 'on'=>'search'),
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
			'primers' => array(self::HAS_MANY, 'Primer', 'gene_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gene_id' => 'Gene ID',
			'gene_symbol' => 'Gene Symbol',
			'gene_name' => 'Gene Name',
			'tax_id' => 'Taxomony ID',
			'synonyms' => 'Synonyms',
			'type_of_gene' => 'Type Of Gene',
                        'modification_date' => 'Modification Date',
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

		$criteria->compare('gene_id',$this->gene_id);
		$criteria->compare('gene_symbol',$this->gene_symbol,true);
		$criteria->compare('gene_name',$this->gene_name,true);
		$criteria->compare('tax_id',$this->tax_id);
		$criteria->compare('synonyms',$this->synonyms,true);
		$criteria->compare('type_of_gene',$this->type_of_gene,true);

    $criteria->with = array('tax');
    $criteria->compare('tax.name',$this->tax_search,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
      'sort'=>array(
          'attributes'=>array(
              'tax_search'=>array(
                  'asc'=>'tax.name',
                  'desc'=>'tax.name DESC',
              ),
              '*',
          ),
      ),
		));
	}
}
