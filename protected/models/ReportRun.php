<?php

/**
 * This is the model class for table "report_run".
 *
 * The followings are the available columns in table 'report_run':
 * @property integer $id
 * @property integer $report_id
 * @property string $name
 * @property string $memo
 *
 * The followings are the available model relations:
 * @property ReportExperiment[] $reportExperiments
 * @property Report $report
 */
class ReportRun extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'report_run';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('report_id, name', 'required'),
			array('report_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('memo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, report_id, name, memo', 'safe', 'on'=>'search'),
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
			'reportExperiments' => array(self::HAS_MANY, 'ReportExperiment', 'run_id'),
			'report' => array(self::BELONGS_TO, 'Report', 'report_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'report_id' => 'Report',
			'name' => 'Name',
			'memo' => 'Memo',
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
		$criteria->compare('report_id',$this->report_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('memo',$this->memo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReportRun the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
