<?php

/**
 * This is the model class for table "mirna".
 *
 * The followings are the available columns in table 'mirna':
 * @property integer $id
 * @property string $miRNA_id
 * @property string $accession
 * @property string $description
 * @property integer $tax_id
 *
 * The followings are the available model relations:
 * @property Species $tax
 * @property Primer[] $primers
 */
class Mirna extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mirna the static model class
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
		return 'mirna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('miRNA_id, accession, tax_id', 'required'),
			array('tax_id', 'numerical', 'integerOnly'=>true),
			array('miRNA_id', 'length', 'max'=>45),
			array('accession', 'length', 'max'=>15),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, miRNA_id, accession, description, tax_id', 'safe', 'on'=>'search'),
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
			'primers' => array(self::HAS_MANY, 'Primer', 'mirna_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'miRNA_id' => 'Mi Rna',
			'accession' => 'Accession',
			'description' => 'Description',
			'tax_id' => 'Tax',
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
		$criteria->compare('miRNA_id',$this->miRNA_id,true);
		$criteria->compare('accession',$this->accession,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('tax_id',$this->tax_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}