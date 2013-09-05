<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $status
 * @property string $owner_id
 * @property string $requester_id
 * @property string $acceptance_date
 * @property string $due_date
 * @property string $weekly_remind
 * @property string $note
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property UsergroupsUser $requester
 * @property UsergroupsUser $createUser
 * @property UsergroupsUser $updateUser
 * @property UsergroupsUser $owner
 */
class Task extends CActiveRecord
{
        public $owner_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Task the static model class
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
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			array('type', 'length', 'max'=>50),
			array('owner_id, requester_id, create_user_id, update_user_id', 'length', 'max'=>20),
			array('description, status, acceptance_date, due_date,
                            create_time, note, update_time, weekly_remind', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, type, status, owner_id,
                            requester_id, acceptance_date, due_date, note,
                            create_time, create_user_id, update_time,
                            update_user_id, owner_search, weekly_remind',
                            'safe', 'on'=>'search'),
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
			'requester' => array(self::BELONGS_TO, 'UsergroupsUser', 'requester_id'),
			'createUser' => array(self::BELONGS_TO, 'UsergroupsUser', 'create_user_id'),
			'updateUser' => array(self::BELONGS_TO, 'UsergroupsUser', 'update_user_id'),
			'owner' => array(self::BELONGS_TO, 'UsergroupsUser', 'owner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Task',
			'description' => 'Description',
			'type' => 'Type',
			'status' => 'Status',
			'owner_id' => 'Owner',
			'requester_id' => 'Requester',
			'acceptance_date' => 'Acceptance Date',
			'due_date' => 'Due Date',
			'note' => 'Note',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
                        'owner_search' => 'User Name',
                        'weekly_remind' => 'Weekly Remide',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('t.status',$this->status,true);
		$criteria->compare('owner_id',$this->owner_id,true);
		$criteria->compare('requester_id',$this->requester_id,true);
		$criteria->compare('acceptance_date',$this->acceptance_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id,true);

                $criteria->with = array('owner');
                $criteria->compare('owner.username',$this->owner_search,true);
                $uid = Yii::app()->user->id;
                $criteria->addCondition("owner_id=$uid OR requester_id=$uid OR create_user_id=$uid");
                //$criteria->addCondition('owner_id=:user_id OR requester_id=:user_id OR create_user_id=:user_id');
                //$criteria->params = array_merge($_POST,array(':user_id' => Yii::app()->user->id));

                return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'owner_search'=>array(
                                    'asc'=>'owner.username',
                                    'desc'=>'owner.username DESC',
                                ),
                                '*',
                            ),
                        ),
		));
	}
        
        public function getUsers()
        {
            $getUsers = CHtml::listData(UserGroupsUser::model()->findAll('group_id > 2'), 'id', 'username');
            return $getUsers;
        }

        public function getWRText() {
            if ($this->weekly_remind == 1) {
                return 'Yes';
            } else {
                return 'No';
            }
        }
        
        public function getStatusOptions() {
            return array("进行中"=>"进行中","完成"=>"完成","取消" => '取消', "推延"=>'推延');
        }
}
