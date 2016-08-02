<?php

/**
 * This is the model class for table "primer".
 *
 * The followings are the available columns in table 'primer':
 * @property integer $id
 * @property string $gene_id
 * @property string $gene_symbol
 * @property string $primer_id
 * @property string $barcode
 * @property integer $tax_id
 * @property string $type_of_primer
 * @property integer $gene_fk
 * @property integer $mirna_fk
 * @property string $comment
 * @property string $create_date
 * @property string $update_date
 *
 * The followings are the available model relations:
 * @property GeneOrder[] $geneOrders
 * @property Position[] $positions
 * @property Species $tax
 * @property Gene $geneFk
 * @property Mirna $mirnaFk
 */
class Primer extends CActiveRecord
{
  public $tax_search;
  public $qc_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Primer the static model class
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
		return 'primer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tax_id, gene_fk, mirna_fk, qc', 'numerical', 'integerOnly'=>true),
			array('gene_id, gene_symbol, primer_id, barcode, type_of_primer', 'length', 'max'=>45),
			array('comment, create_date, update_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gene_id, gene_symbol, primer_id, barcode, tax_id,
                            type_of_primer, gene_fk, mirna_fk, comment, create_date,
                            update_date, tax_search, qc, qc_search',
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
			'pCRExperiments' => array(self::HAS_MANY, 'pCRExperiment', 'primer_fk'),
			'positions' => array(self::HAS_MANY, 'Position', 'primer_id'),
			'tax' => array(self::BELONGS_TO, 'Species', 'tax_id'),
			'qcFk' => array(self::BELONGS_TO, 'Qc', 'qc'),
			'geneFk' => array(self::BELONGS_TO, 'Gene', 'gene_fk'),
			'mirnaFk' => array(self::BELONGS_TO, 'Mirna', 'mirna_fk'),
      'primerPositions' => array(self::HAS_MANY, 'PrimerPosition', 'primer_id'),
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
			'gene_symbol' => 'Gene Symbol',
			'primer_id' => 'Primer ID',
			'barcode' => 'Barcode',
			'tax_id' => 'Tax',
			'type_of_primer' => 'Type Of Primer',
			'gene_fk' => 'Gene Fk',
			'mirna_fk' => 'Mirna Fk',
			'comment' => 'Comment',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'tax_search' => 'Organsim',
                        'qc' => 'QC ID',
                        'qc_search' => 'QC',
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
		$criteria->compare('gene_id',$this->gene_id);
		$criteria->compare('gene_symbol',$this->gene_symbol,true);
		$criteria->compare('primer_id',$this->primer_id,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('tax_id',$this->tax_id);
		$criteria->compare('type_of_primer',$this->type_of_primer,true);
		$criteria->compare('gene_fk',$this->gene_fk);
		$criteria->compare('mirna_fk',$this->mirna_fk);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('qc',$this->qc);

                $criteria->with = array('tax','qcFk');
                // $criteria->compare('tax.name',$this->tax_search,true);
                $criteria->compare('tax.common',$this->tax_search,true);
                $criteria->compare('qcFk.name',$this->qc_search,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'tax_search'=>array(
                                    // 'asc'=>'tax.name',
                                    // 'desc'=>'tax.name DESC',
                                    'asc'=>'tax.common',
                                    'desc'=>'tax.common DESC',
                                ),
                                'qc_search'=>array(
                                    'asc'=>'qcFk.name',
                                    'desc'=>'qcFk.name DESC',
                                ),
                                '*',
                            ),
                        ),
		));
	}

        public function getSpecies()
        {
            $getStoreType = CHtml::listData(Species::model()->findAll(), 'id', 'name');
            return $getStoreType;
        }

        public function getQcOptions() {
            //return array(1=>"合格",2=>"未测定",-1 => '被替换', 0=>"不合格",40=>'ct40');
            $getStoreType = CHtml::listData(Qc::model()->findAll(), 'id', 'name');
            return $getStoreType;
        }

}
