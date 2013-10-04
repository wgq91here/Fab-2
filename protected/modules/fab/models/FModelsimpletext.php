<?php

class FModelsimpletext extends FModel
{
	// 外部名称
	public $name = '文本说明';
	// 内部名称
	public $nameID = 'simpletext';
  // 字段名称
  public $typeID = 'simpletext';

	public $uniquerID = null;

	public $attribute = array(
		'Label'=>'文本说明',
    'Required'=>false,
  );

	public function init() {
    $editor = new xheditor;
    $editor->init();

		return array(
			'jsFiles'=>array('fieldsimpletext.js'),
			);
	}



}