<?php

class posts_0 extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'posts_0':
	 * @var integer $pid
	 * @var string $mid
	 * @var string $pdata
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return posts_0 the static model class
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
		return 'posts_0';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, pdata', 'required'),
			array('mid', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pid, mid, pdata', 'safe', 'on'=>'search'),
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
			'pid' => 'Pid',
			'mid' => 'Mid',
			'pdata' => 'Pdata',
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

		$criteria->compare('pid',$this->pid);

		$criteria->compare('mid',$this->mid,true);

		$criteria->compare('pdata',$this->pdata,true);

		return new CActiveDataProvider('posts_0', array(
			'criteria'=>$criteria,
		));
	}
}