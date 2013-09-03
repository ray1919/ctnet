<?php

/**
 * This is the model class for table "PCR_experiment".
 *
 * The followings are the available columns in table 'PCR_experiment':
 * @property integer $id
 * @property integer $gene_id
 * @property string $primer_id
 * @property integer $primer_fk
 * @property double $ct
 * @property double $tm1
 * @property double $tm2
 * @property integer $service_id
 * @property string $pos
 * @property string $plate_type
 * @property string $array_name
 * @property string $status
 * @property integer $sample_id
 *
 * The followings are the available model relations:
 * @property PCRSample $sample
 * @property PCRService $service
 * @property Gene $gene
 * @property Primer $primerFk
 */
class PCRExperiment extends CActiveRecord
{
        public $ctfile;
        public $tmfile;
        public $gene_search;
        public $sample_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PCRExperiment the static model class
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
		return 'PCR_experiment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctfile, tmfile', 'file', 'safe'=>true, 'types' => 'txt',
                            'allowEmpty' => false,'maxSize' => (1024 * 300), // 300 Kb
                            'tooLarge' => 'File no larger than 300Kb.',
                            'wrongType'=>'Only txt allowed.'),
			array('gene_id, primer_fk, service_id, sample_id', 'numerical', 'integerOnly'=>true),
			array('ct, tm1, tm2', 'numerical'),
			array('primer_id, pos, plate_type, array_name', 'length', 'max'=>45),
			array('status', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gene_id, primer_id, primer_fk, ct, tm1, tm2,
                            service_id, pos, plate_type, status, sample_id, gene_search,
                            sample_search, array_name',
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
			'sample' => array(self::BELONGS_TO, 'PCRSample', 'sample_id'),
			'service' => array(self::BELONGS_TO, 'PCRService', 'service_id'),
			'gene' => array(self::BELONGS_TO, 'Gene', 'gene_id'),
			'primerFk' => array(self::BELONGS_TO, 'Primer', 'primer_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gene_id' => 'Gene ID',
			'primer_id' => 'Primer ID',
			'primer_fk' => 'Primer Fk',
			'ct' => 'Ct',
			'tm1' => 'Tm1',
			'tm2' => 'Tm2',
			'service_id' => 'Service',
			'pos' => 'Pos',
			'plate_type' => 'Plate Type',
			'status' => 'Status',
			'sample_id' => 'Sample',
                        'array_name' => 'Array Name',
                        'ctfile' => 'Ct File',
                        'tmfile' => 'Tm File',
                        'gene_search' => 'Symbol',
                        'sample_search' => 'Sample',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('gene_id',$this->gene_id);
		$criteria->compare('primer_id',$this->primer_id,true);
		$criteria->compare('primer_fk',$this->primer_fk);
		$criteria->compare('ct',$this->ct);
		$criteria->compare('tm1',$this->tm1);
		$criteria->compare('tm2',$this->tm2);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('pos',$this->pos,true);
		$criteria->compare('plate_type',$this->plate_type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('sample_id',$this->sample_id);
		$criteria->compare('array_name',$this->array_name);

                $criteria->with = array('gene','sample');
                $criteria->compare('gene.gene_symbol',$this->gene_search,true);
                $criteria->compare('sample.name',$this->sample_search,true);

                $criteria->addCondition("t.service_id=$id");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'gene_search'=>array(
                                    'asc'=>'gene.gene_symbol',
                                    'desc'=>'gene.gene_symbol DESC',
                                ),
                                'sample_search'=>array(
                                    'asc'=>'sample.name',
                                    'desc'=>'sample.name DESC',
                                ),
                                '*',
                            ),
                        ),
                        'pagination'=>array('pageSize'=>96),
		));
	}

        public function getPlateOptions() {
            return array(
                "96-well"=>"96-well",
                "384-well"=>"384-well",
                );
        }        
}