<?php

class FModeldropdownlist extends FModel
{
    // 外部名称
    public $name = '下拉菜单';
    // 内部名称
    public $nameID = 'dropdownlist';
    // 字段名称
    public $typeID = 'dropdownlist';

    public $uniquerID = null;

    public $Select = array(1);

    public $attribute = array(
        'Label' => '下拉菜单',
        'Required' => true,
        'Data' => array(
            '1' => 'Option A',
            '2' => 'Option B',
            '3' => 'Option C',
        ),
        'Select' => 1,
    );

    public function init()
    {
        return array(
            'jsFiles' => array('fielddropdownlist.js'),
        );
    }

    // 从表单element取得返回值 覆盖
    public function getValueByForm(&$element, $value, $returnType = 'string')
    {
        return $element->items[$value];
    }

}