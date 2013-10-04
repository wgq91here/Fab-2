<?php

/**
 * posts
 * 
 * @package fab
 * @author fabcms
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class posts extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'posts':
	 * @var integer $pid
	 * @var string $mid
	 * @var string $pdata
	 */

  var $tmid = '0';
  var $tuserid = 0;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return posts_0 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
  
  public function setModelId($id) 
  {
    $this->tmid = $id;
  }
  
  public function setUserId($id=-1)
  {
    $this->tuserid = ($id == -1)?Yii::app()->user->id:$id;
  }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'posts';
	}
  
  public function scopes()
  {
    return array(
      'Bymid'=>array('condition'=>$this->getTableAlias().'.mid="'.$this->tmid.'"'),
      'Bymine'=>array('condition'=>$this->getTableAlias().'.userid="'.Yii::app()->user->id.'"'),
      'Byuid'=>array('condition'=>$this->getTableAlias().'.userid="'.$this->tuserid.'"'),
    );
  }  
  
  public function setModel($mid)
  {
    //return $this::model()->findAll('mid="'.$tmid.'"');
  }
  
  public function getPostItemsByMid($mid)
  {
    return $this->count('mid="'.$mid.'"');
  }
  
  public function refreshModelPostItems($mid)
  {
    $postItems = $this->getPostItemsByMid($mid);
    models::model()->updateByPk($mid,array('items'=>$postItems,'lastmessage'=>date('Y-m-d H:i').' Refresh'));
    return true;    
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
			// array('pid, mid, pdata', 'safe', 'on'=>'search'),
		);
	}
  
  protected function beforeSave()
  {
    $this->created = time();
    $this->userid = Yii::app()->user->id;
    $this->pdata = serialize($this->pdata);
    
    if ($this->isNewRecord) {
      models::model()->updateCounters(array('items'=>1),"mid='{$this->mid}'");
      models::model()->updateByPk($this->mid,array('lastmessage'=>date('Y-m-d H:i').' Added'));
    }
    return true;
  }
  
  protected function afterDelete()
  {
    models::model()->updateCounters(array('items'=>-1),"mid='{$this->mid}'");
    models::model()->updateByPk($this->mid,array('lastmessage'=>date('Y-m-d H:i').' Deleted'));
  }
  
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
      'user'=>array(self::BELONGS_TO,'User','userid','select'=>'id,username'),
      'model'=>array(self::BELONGS_TO,'models','mid','select'=>'lastmessage,title,userid,locked'),
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
      'created' => 'Created',
      'userid' => 'Userid',
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