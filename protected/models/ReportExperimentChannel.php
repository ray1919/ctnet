<?php

/**
 * This is the model class for table "report_experiment_channel".
 *
 * The followings are the available columns in table 'report_experiment_channel':
 * @property integer $id
 * @property integer $report_experiment_id
 * @property string $channel
 * @property double $fluorescence
 *
 * The followings are the available model relations:
 * @property ReportExperiment $reportExperiment
 */
class ReportExperimentChannel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'report_experiment_channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('report_experiment_id, channel, fluorescence', 'required'),
			array('report_experiment_id', 'numerical', 'integerOnly'=>true),
			array('fluorescence', 'numerical'),
			array('channel', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, report_experiment_id, channel, fluorescence', 'safe', 'on'=>'search'),
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
			'reportExperiment' => array(self::BELONGS_TO, 'ReportExperiment', 'report_experiment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'report_experiment_id' => 'Report Experiment',
			'channel' => 'Channel',
			'fluorescence' => 'Fluorescence',
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
		$criteria->compare('report_experiment_id',$this->report_experiment_id);
		$criteria->compare('channel',$this->channel,true);
		$criteria->compare('fluorescence',$this->fluorescence);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReportExperimentChannel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
