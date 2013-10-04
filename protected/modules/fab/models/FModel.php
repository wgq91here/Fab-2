<?php

class FModel
{
	// 外部名称
	public $name = '';
	// 内部名称
	public $nameID = '';
	// 唯一编号
	public $uniqueID = null;
	// 顺序号
	public $orderID = null;

	public $fieldType = array();

  const TABLEIDBYMODELID = 5;
  
	// 通用字段
	// Label 名字
	public $attribute = array(
		'Lable'=>'Label Name',
		);

	public function FModel() {}

	public function front()
	{
		if (!isset($this->uniquerID)) {
			$this->uniquerID = FController::FabRand(10);
		}

		$randerData = array(
			'fmClass'=>$this,
			);
		$renderFieldHtml = $this->renderFile('ajax_model_'.$this->nameID, $randerData, true);
		$renderMainHtml = $this->renderFile('_model_main',$randerData + array('content'=>$renderFieldHtml),true);

		// 暂存字段属性
		// Yii::app()->cache->set($randerData['fieldID'], $this);
		$renderUpdateHtml = $this->renderFile('ajax_model_update_'.$this->nameID, $randerData, true);

		// 返回 JSON
		return array('error'=>FALSE,'id'=>$this->uniquerID,'data'=>$this->getAttributes(),'field'=>$renderMainHtml,'tool'=>$renderUpdateHtml);
	}

	public function renderFile($viewFile,$_data_=null)
	{
		$viewPath = Yii::getPathOfAlias('application.modules.fab.views.model');

		if(is_array($_data_))
			extract($_data_,EXTR_PREFIX_SAME,'data');
		else
			$data=$_data_;

		ob_start();
		ob_implicit_flush(false);
		require($viewPath.'/'.$viewFile.'.php');
		return ob_get_clean();
	}

	public function getAttribute($name = null)
	{
		if (isset($this->attribute[$name])) return $this->attribute[$name];
		return null;
	}

	public function getAttributes()
	{
		return $this->attribute + array('nameID'=>$this->nameID,'typeID'=>$this->typeID);
	}

  // 从表单element取得返回值
  public function getValueByForm(&$element,$value,$returnType='string')
  {
    return $value;
  }
  
  public static function getTableIdByModelId($mid)
  {
    return ord($mid)%FModel::TABLEIDBYMODELID;
  }
  
  public function setAttributes($attr = array())
  {
    $this->attribute = $attr;
  }

}