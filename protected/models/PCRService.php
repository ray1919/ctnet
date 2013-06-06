<?php

/**
 * This is the model class for table "PCR_service".
 *
 * The followings are the available columns in table 'PCR_service':
 * @property integer $id
 * @property string $date
 * @property integer $customer_id
 * @property string $service_type
 * @property string $sample_arrival_date
 * @property string $report_date
 * @property string $note
 *
 * The followings are the available model relations:
 * @property PCRExperiment[] $pCRExperiments
 * @property PCRSample[] $pCRSamples
 * @property Customer $customer
 */
class PCRService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PCRService the static model class
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
		return 'PCR_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id', 'numerical', 'integerOnly'=>true),
			array('service_type', 'length', 'max'=>45),
			array('date, sample_arrival_date, report_date, note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, customer_id, service_type, sample_arrival_date, report_date, note', 'safe', 'on'=>'search'),
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
			'pCRExperiments' => array(self::HAS_MANY, 'PCRExperiment', 'service_id'),
			'pCRSamples' => array(self::HAS_MANY, 'PCRSample', 'service_id'),
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
			'date' => 'Date',
			'customer_id' => 'Customer',
			'service_type' => 'Service Type',
			'sample_arrival_date' => 'Sample Arrival Date',
			'report_date' => 'Report Date',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('service_type',$this->service_type,true);
		$criteria->compare('sample_arrival_date',$this->sample_arrival_date,true);
		$criteria->compare('report_date',$this->report_date,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getTypeOptions() {
            return array("表达谱PCR芯片服务"=>"表达谱PCR芯片服务","定制表达谱PCR芯片"=>"定制表达谱PCR芯片","其他"=>"其他");
        }
        
}