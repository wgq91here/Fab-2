<?php

class FModeltextarea extends FModel
{
    // 外部名称
    public $name = '多行文本';
    // 内部名称
    public $nameID = 'textarea';
    // 字段名称
    public $typeID = 'textarea';

    public $uniquerID = null;

    public $attribute = array(
        'Required' => true,
        'Rows' => 5,
        'Cols' => 50,
        'editorclass' => '',
        'Label' => '文本名称',
    );

    public $editorSelect = array(
        'editorclass' => 'editorclass',
        'xheditor' => 'xheditor',
        'xheditor-simple' => 'xheditor-simple',
        'xheditor-mini' => 'xheditor-mini',
    );

    public function init()
    {
        return array(
            'jsFiles' => array('fieldtextarea.js'),
        );
    }

    public function getValueByForm(&$element, $value, $returnType = 'string')
    {
        return $value;
    }
}