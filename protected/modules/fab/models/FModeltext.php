<?php

class FModeltext extends FModel
{
    // 外部名称
    public $name = '单行文本';
    // 内部名称
    public $nameID = 'text';
    // 字段名称
    public $typeID = 'text';

    public $uniquerID = null;

    public $Size = array(
        '100px' => 'small size',
        '150px' => 'middle size',
        '200px' => 'large size',
    );

    public $attribute = array(
        'Required' => true,
        'Minlength' => 5,
        'Maxlength' => 50,
        'Label' => '文本名称',
        'Size' => '100px',
    );

    public function init()
    {
        return array(
            'jsFiles' => array('fieldtext.js'),
        );
    }

}