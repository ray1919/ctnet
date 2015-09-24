<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property integer $id
 * @property string $type
 * @property string $purpose
 * @property string $date
 * @property string $experimenter
 * @property string $sample
 * @property string $sampleLayout
 * @property string $cycleProgram
 * @property string $formula
 * @property string $result
 * @property string $conclusion
 */
class Report extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, purpose, date, experimenter, sample, sampleLayout, cycleProgram, formula, result, conclusion', 'required'),
			array('type, experimenter', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, purpose, date, experimenter, sample, sampleLayout, cycleProgram, formula, result, conclusion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => '实验分类',
			'purpose' => '实验目的',
			'date' => '实验日期',
			'experimenter' => '实验员',
			'sample' => '样本信息（样本类别，编号）',
			'sampleLayout' => '样本排列',
			'cycleProgram' => '循环条件',
			'formula' => '实验配方',
			'result' => '实验结果',
			'conclusion' => '实验结论',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('experimenter',$this->experimenter,true);
		$criteria->compare('sample',$this->sample,true);
		$criteria->compare('sampleLayout',$this->sampleLayout,true);
		$criteria->compare('cycleProgram',$this->cycleProgram,true);
		$criteria->compare('formula',$this->formula,true);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('conclusion',$this->conclusion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Report the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  public function getTypeOptions() {
    return array('服务' => '服务', '验证实验' => '验证实验', '体系开发' => '体系开发');
  }
}
