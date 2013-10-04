<?php

class FModelradiolist extends FModel
{
	// 外部名称
	public $name = '单项选择';
	// 内部名称
	public $nameID = 'radiolist';
  // 字段名称
  public $typeID = 'radiolist';

	public $uniquerID = null;

	public $Select = '1';

	public $attribute = array(
		'Label'=>'单项选择',
    'Required'=>true,
		'Data'=>array(
			'1'=>'Option A',
			'2'=>'Option B',
			'3'=>'Option C',
			),
    'Select'=>'1',
  );

	public function init() {
		return array(
			'jsFiles'=>array('fieldradiolist.js'),
			);
	}

  // 从表单element取得返回值 覆盖
  public function getValueByForm(&$element,$value,$returnType='string')
  {   
    return $element->items[$value];
  }

}