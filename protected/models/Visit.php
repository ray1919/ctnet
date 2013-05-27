<?php

/**
 * This is the model class for table "visit".
 *
 * The followings are the available columns in table 'visit':
 * @property integer $id
 * @property integer $customer_id
 * @property string $executor
 * @property string $status
 * @property string $way
 * @property string $class
 * @property string $time
 * @property string $comment
 * @property integer $return_visit
 * @property string $scheduled
 * @property string $create_time
 * @property integer $create_user_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property User $createUser
 */
class Visit extends CActiveRecord
{
        public $customer_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Visit the static model class
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
		return 'visit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, create_user_id, return_visit', 'numerical', 'integerOnly'=>true),
			array('executor, status, way, class', 'length', 'max'=>45),
			array('time, comment, create_time, scheduled', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, customer_id, executor, status, way, class, time, comment, return_visit, scheduled, create_time, create_user_id, customer_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    Yii::import('application.modules.userGroups.models.*');
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			//'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
      'createUser' => array(self::BELONGS_TO, 'UserGroupsUser', 'create_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'executor' => 'Executor Email',
			'status' => 'Contact Status',
			'way' => 'Way',
			'class' => 'Communication Class',
			'time' => 'Time',
			'comment' => 'Content',
                        'return_visit' => 'Return Visit',
                        'scheduled' => 'Next scheduled',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
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
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('executor',$this->executor,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('way',$this->way,true);
		$criteria->compare('class',$this->class,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('return_visit',$this->return_visit,true);
		$criteria->compare('scheduled',$this->scheduled,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);

                $criteria->with = array( 'customer');
                $criteria->compare( 'customer.title', $this->customer_search, true );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                        'attributes'=>array(
                            'customer_search'=>array(
                                'asc'=>'customer.title',
                                'desc'=>'customer.title DESC',
                            ),
                            '*',
                        ),
                    ),
		));
	}
        
        public function getStatusOptions() {
            return array("没兴趣"=>"没兴趣","潜在客户"=>"潜在客户","明确意向"=>"明确意向","回复资料"=>"回复资料","其他"=>"其他");
        }        
        public function getWayOptions() {
            return array("来电"=>"来电","去电"=>"去电","Email"=>"Email","拜访"=>"拜访","客户来访"=>"客户来访","其他"=>"其他");
        }        
        public function getClassOptions() {
            return array("跟踪"=>"跟踪","售前"=>"售前","售后"=>"售后","回访"=>"回访","关闭"=>"关闭","其他"=>"其他");
        }
        public function getReturnVisitOptions() {
            return array(0=>"不需要",1=>"已计划",2=>"已完成");
        }
        
	/**
	 * @return string the return_visit text display for the current communication
	 */ 
	public function getReturnVisitText()
	{
		$returnVisitOptions=$this->returnVisitOptions;
		return isset($returnVisitOptions[$this->return_visit]) 
                        ? $returnVisitOptions[$this->return_visit] 
                        : "unknown type ({$this->return_visit})";
	}

}
