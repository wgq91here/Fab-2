<?php

class models extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'models':
	 * @var string $mid
	 * @var integer $created
	 * @var integer $userid
	 * @var string $data
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return models the static model class
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
		return 'models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, created, userid, data', 'required'),
			array('created, userid', 'numerical', 'integerOnly'=>true),
			array('mid', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mid, created, userid, data', 'safe', 'on'=>'search'),
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
			'mid' => 'Mid',
			'created' => 'Created',
			'userid' => 'Userid',
			'data' => 'Data',
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

		$criteria->compare('mid',$this->mid,true);

		$criteria->compare('created',$this->created);

		$criteria->compare('userid',$this->userid);

		$criteria->compare('data',$this->data,true);

		return new CActiveDataProvider('models', array(
			'criteria'=>$criteria,
		));
	}
}