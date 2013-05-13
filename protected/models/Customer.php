<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $tel1
 * @property string $tel2
 * @property string $tel3
 * @property string $email
 * @property string $IM
 * @property string $address
 * @property string $organization
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property CustomerOrder[] $customerOrders
 * @property GeneOrder[] $geneOrders
 * @property Visit[] $visits
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, name, tel1, tel2, tel3, email, IM', 'length', 'max'=>45),
			array('address, organization, add_date, comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, name, tel1, tel2, tel3, email, IM, address, organization, add_date, comment', 'safe', 'on'=>'search'),
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
			'customerOrders' => array(self::HAS_MANY, 'CustomerOrder', 'customer_id'),
			'geneOrders' => array(self::HAS_MANY, 'GeneOrder', 'customer_id'),
			'visits' => array(self::HAS_MANY, 'Visit', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'name' => 'Name',
			'tel1' => 'Tel1',
			'tel2' => 'Tel2',
			'tel3' => 'Tel3',
			'email' => 'Email',
			'IM' => 'Im',
			'address' => 'Address',
			'organization' => 'Organization',
                        'add_date' => 'Add Date',
			'comment' => 'Comment',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tel1',$this->tel1,true);
		$criteria->compare('tel2',$this->tel2,true);
		$criteria->compare('tel3',$this->tel3,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('IM',$this->IM,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('organization',$this->organization,true);
		$criteria->compare('comment',$this->comment,true);
                $criteria->compare('add_date',$this->add_date,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}