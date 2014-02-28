<?php

/**
 * This is the model class for table "PCR_sample".
 *
 * The followings are the available columns in table 'PCR_sample':
 * @property integer $id
 * @property integer $service_id
 * @property string $name
 * @property string $type
 * @property integer $species_id
 * @property string $note
 *
 * The followings are the available model relations:
 * @property PCRExperiment[] $pCRExperiments
 * @property Species $species
 * @property PCRService $service
 */
class PCRSample extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PCRSample the static model class
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
		return 'PCR_sample';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, species_id', 'numerical', 'integerOnly'=>true),
			array('name, type', 'length', 'max'=>45),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, service_id, name, type, species_id, note', 'safe', 'on'=>'search'),
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
			'pCRExperiments' => array(self::HAS_MANY, 'PCRExperiment', 'sample_id'),
			'species' => array(self::BELONGS_TO, 'Species', 'species_id'),
			'service' => array(self::BELONGS_TO, 'PCRService', 'service_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'service_id' => 'Service ID',
			'name' => 'Name',
			'type' => 'Type',
			'species_id' => 'Species',
			'note' => 'Note',
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
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('species_id',$this->species_id);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function getSpecies()
        {
            $getStoreType = CHtml::listData(Species::model()->findAll(), 'id', 'name');
            return $getStoreType;
        }

        public function getTypeOptions() {
            return array("组织"=>"组织","RNA"=>"RNA","DNA"=>"DNA","cDNA"=>"cDNA","全血"=>"全血","细胞"=>"细胞","其他"=>"其他");
        }
        
}
