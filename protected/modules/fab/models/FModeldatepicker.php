<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FModeldatepicker
 *
 * @author wugangqiang
 */
class FModeldatepicker extends FModel {
	// 外部名称
	public $name = '选择日期';
	// 内部名称
	public $nameID = 'datepicker';
  // 字段名称
  public $typeID = 'datepicker';
  
	public $uniquerID = null;

	public $attribute = array(
		'Label'=>'选择日期',
    'Required'=>true,
  );

	public function init() {
    $datepicker_asa = new datepicker;
    $datepicker_asa->init();

		return array(
			'jsFiles'=>array('fielddatepicker.js'),
			);
	}


}
?>
