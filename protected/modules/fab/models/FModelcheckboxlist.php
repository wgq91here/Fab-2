<?php

class FModelcheckboxlist extends FModel
{
	// 外部名称
	public $name = '多项选择';
	// 内部名称
	public $nameID = 'checkboxlist';
  // 字段名称
  public $typeID = 'checkboxlist';

	public $uniquerID = null;

	public $Select = array(1);

	public $attribute = array(
		'Label'=>'多项选择',
    'Required'=>true,
		'Data'=>array(
			'1'=>'Option A',
			'2'=>'Option B',
			'3'=>'Option C',
			),
    'Select'=>array(
      '1'=>true,
      '2'=>false,
      '3'=>false,
    ),
  );

	public function init() {
		return array(
			'jsFiles'=>array('fieldcheckboxlist.js'),
			);
	}

  // 从表单element取得返回值 覆盖
  public function getValueByForm(&$element,$value,$returnType='string')
  {
    $_temp = array();
    foreach ($_POST['FgModel'][$element->name] as $value) {
      $_temp[] = $element->items[$value];
    }
    return implode(',',$_temp);
  }


}