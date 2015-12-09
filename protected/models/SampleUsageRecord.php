<?php

/**
 * This is the model class for table "sample_usage_record".
 *
 * The followings are the available columns in table 'sample_usage_record':
 * @property integer $id
 * @property integer $sample_id
 * @property string $date
 * @property string $person
 * @property string $volume_left
 * @property string $memo
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property Sample $sample
 */
class SampleUsageRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sample_usage_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sample_id, date, person, volume_left, memo, timestamp', 'required'),
			array('sample_id', 'numerical', 'integerOnly'=>true),
			array('person', 'length', 'max'=>20),
			array('volume_left', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sample_id, date, person, volume_left, memo, timestamp', 'safe', 'on'=>'search'),
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
			'sample' => array(self::BELONGS_TO, 'Sample', 'sample_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sample_id' => 'Sample',
			'date' => '使用日期',
			'person' => '人员',
			'volume_left' => '样本剩余量',
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
		$criteria->compare('sample_id',$this->sample_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('person',$this->person,true);
		$criteria->compare('volume_left',$this->volume_left,true);
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
	 * @return SampleUsageRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
