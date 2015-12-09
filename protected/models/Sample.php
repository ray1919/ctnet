<?php

/**
 * This is the model class for table "sample".
 *
 * The followings are the available columns in table 'sample':
 * @property integer $id
 * @property string $source
 * @property string $type
 * @property string $organism
 * @property string $purpose
 * @property string $arrival_date
 * @property string $total_volume
 * @property string $sample_acc
 * @property string $name
 * @property string $location
 * @property string $person_in_charge
 * @property string $memo
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property SampleUsageRecord[] $sampleUsageRecords
 */
class Sample extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sample';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, location, timestamp', 'required'),
			array('source, organism, purpose', 'length', 'max'=>100),
			array('type, location', 'length', 'max'=>50),
			array('total_volume, name', 'length', 'max'=>30),
			array('sample_acc', 'length', 'max'=>15),
			array('person_in_charge', 'length', 'max'=>20),
			array('arrival_date, memo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, source, type, organism, purpose, arrival_date, total_volume, sample_acc, name, location, person_in_charge, memo, timestamp', 'safe', 'on'=>'search'),
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
			'sampleUsageRecords' => array(self::HAS_MANY, 'SampleUsageRecord', 'sample_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
      'source' => '来源',
			'type' => '类型',
			'organism' => '物种',
			'purpose' => '用途',
			'arrival_date' => '取到日期',
			'total_volume' => '总样量',
			'sample_acc' => '样本获取号',
			'name' => '名称',
			'location' => '位置',
			'person_in_charge' => '责任人',
			'memo' => '备忘',
			'timestamp' => 'Timestamp',
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
		$criteria->compare('source',$this->source,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('organism',$this->organism,true);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('arrival_date',$this->arrival_date,true);
		$criteria->compare('total_volume',$this->total_volume,true);
		$criteria->compare('sample_acc',$this->sample_acc,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('person_in_charge',$this->person_in_charge,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sample the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
