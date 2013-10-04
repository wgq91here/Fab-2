<?php

/**
 * models
 *
 * @package 没有项目被加载
 * @author www.fabcms.com
 * @copyright 2010
 * @version $Id$
 * @access public
 */

class models extends CActiveRecord
{
    const PAGE_SIZE = 10;
    const LOCK = 1;
    const UNLOCK = 0;

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
    public static function model($className = __class__)
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
     * models::Scope()
     *
     * @return array
     */
    public function scopes()
    {
        return array('myforms' => array('condition' => $this->getTableAlias() . '.userid=' . Yii::app()->user->id));
    }


    /**
     * models::rules()
     *
     * @return array
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mid, userid, title, data, created', 'required'),
            array('userid, items', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'min' => 4),
            array('mid', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            // array('mid, created, userid, data', 'safe', 'on'=>'search'),
        );
    }

    public function beforesave()
    {
        $this->created = time();
        $this->data = serialize($this->data);
        return true;
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userid', 'select' => 'id as uid,username'),
            'posts' => array(self::HAS_MANY, 'posts', 'mid', 'select' => $this->getTableAlias() . '.userid as model_userid,pid,created'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'title' => '标题',
            'locked' => '状态',
            'mid' => '编号',
            'items' => '记录数',
            'created' => '建立日期',
            'userid' => '用户ID',
            'data' => '编码数据');
    }


    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    /*
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
    */

}
