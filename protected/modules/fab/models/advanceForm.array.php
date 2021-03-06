<?php

return array(
    'simple-text' => array(
        'postID' => 1,
        'postPassword' => null,
        'themeID' => 'clean',
        'FormTitle' => '文本收集表单',
        'UniqueId' => null,
        'logo' => '',
        'Data' => array(
            FController::FabRand() =>
            array(
                'Label' => '请在此说明填写要求',
                'Required' => false,
                'nameID' => 'simpletext',
                'typeID' => 'simpletext',
                'sort' => 1,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此填写您的班级或姓名',
                'Required' => true,
                'nameID' => 'text',
                'typeID' => 'text',
                'Minlength' => 5,
                'Maxlength' => 50,
                'Size' => '100px',
                'sort' => 2,
            ),
            FController::FabRand() =>
            array(
                'Label' => '填写咨询内容',
                'Required' => true,
                'Rows' => 10,
                'Cols' => 50,
                'editorclass' => 'xheditor-simple',
                'nameID' => 'textarea',
                'typeID' => 'textarea',
                'sort' => 3,
            ),
        ),
    ),

    'simple-simpletext' => array(
        'postID' => 1,
        'postPassword' => null,
        'themeID' => 'clean',
        'FormTitle' => '单项调查表单',
        'UniqueId' => null,
        'logo' => '',
        'Data' => array(
            FController::FabRand() =>
            array(
                'Label' => '请在此说明填写要求',
                'Required' => false,
                'nameID' => 'simpletext',
                'typeID' => 'simpletext',
                'sort' => 1,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此填写您的班级或姓名',
                'Required' => true,
                'nameID' => 'text',
                'typeID' => 'text',
                'Minlength' => 5,
                'Maxlength' => 50,
                'Size' => '100px',
                'sort' => 2,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此选择您的选项',
                'Required' => true,
                'nameID' => 'radiolist',
                'typeID' => 'radiolist',
                'Data' => array(
                    '1' => '选项一',
                    '2' => '选项二',
                    '3' => '选项三',
                    '4' => '选项四',
                ),
                'Select' => '1',
                'sort' => 3,
            ),
        ),
    ),

    'simple-checkboxlist' => array(
        'postID' => 1,
        'postPassword' => null,
        'themeID' => 'clean',
        'FormTitle' => '多项调查表单',
        'UniqueId' => null,
        'logo' => '',
        'Data' => array(
            FController::FabRand() =>
            array(
                'Label' => '请在此说明填写要求',
                'Required' => false,
                'nameID' => 'simpletext',
                'typeID' => 'simpletext',
                'sort' => 1,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此填写您的班级或姓名',
                'Required' => true,
                'nameID' => 'text',
                'typeID' => 'text',
                'Minlength' => 5,
                'Maxlength' => 50,
                'Size' => '100px',
                'sort' => 2,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此选择您的选项(多选)',
                'Required' => true,
                'nameID' => 'checkboxlist',
                'typeID' => 'checkboxlist',
                'Data' => array(
                    '1' => '选项一',
                    '2' => '选项二',
                    '3' => '选项三',
                    '4' => '选项四',
                ),
                'Select' => '',
                'sort' => 3,
            ),
        ),
    ),

    'simple-dropdownlist' => array(
        'postID' => 1,
        'postPassword' => null,
        'themeID' => 'clean',
        'FormTitle' => '含有下拉式菜单的表单',
        'UniqueId' => null,
        'logo' => '',
        'Data' => array(
            FController::FabRand() =>
            array(
                'Label' => '请在此说明填写要求',
                'Required' => false,
                'nameID' => 'simpletext',
                'typeID' => 'simpletext',
                'sort' => 1,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此填写您的班级或姓名',
                'Required' => true,
                'nameID' => 'text',
                'typeID' => 'text',
                'Minlength' => 5,
                'Maxlength' => 50,
                'Size' => '100px',
                'sort' => 2,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此选择您的选项',
                'Required' => true,
                'nameID' => 'dropdownlist',
                'typeID' => 'dropdownlist',
                'Data' => array(
                    '1' => '选项一',
                    '2' => '选项二',
                    '3' => '选项三',
                    '4' => '选项四',
                ),
                'Select' => 1,
                'sort' => 3,
            ),
            FController::FabRand() =>
            array(
                'Label' => '填写咨询内容',
                'Required' => true,
                'Rows' => 10,
                'Cols' => 50,
                'editorclass' => 'xheditor-simple',
                'nameID' => 'textarea',
                'typeID' => 'textarea',
                'sort' => 4,
            ),
        ),
    ),

    'simple-datepicker' => array(
        'postID' => 1,
        'postPassword' => null,
        'themeID' => 'clean',
        'FormTitle' => '含有日期选择的表单',
        'UniqueId' => null,
        'logo' => '',
        'Data' => array(
            FController::FabRand() =>
            array(
                'Label' => '请在此说明填写要求',
                'Required' => false,
                'nameID' => 'simpletext',
                'typeID' => 'simpletext',
                'sort' => 1,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此填写您的班级或姓名',
                'Required' => true,
                'nameID' => 'text',
                'typeID' => 'text',
                'Minlength' => 5,
                'Maxlength' => 50,
                'Size' => '100px',
                'sort' => 2,
            ),
            FController::FabRand() =>
            array(
                'Label' => '日期',
                'Required' => true,
                'nameID' => 'datepicker',
                'typeID' => 'datepicker',
                'sort' => 3,
            ),
            FController::FabRand() =>
            array(
                'Label' => '填写咨询内容',
                'Required' => true,
                'Rows' => 10,
                'Cols' => 50,
                'editorclass' => 'xheditor-simple',
                'nameID' => 'textarea',
                'typeID' => 'textarea',
                'sort' => 4,
            ),
        ),
    ),

    'simple-has-all' => array(
        'postID' => 1,
        'postPassword' => null,
        'themeID' => 'clean',
        'FormTitle' => '含有所有功能的表单',
        'UniqueId' => null,
        'logo' => '',
        'Data' => array(
            FController::FabRand() =>
            array(
                'Label' => '请在此说明填写要求',
                'Required' => false,
                'nameID' => 'simpletext',
                'typeID' => 'simpletext',
                'sort' => 1,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此填写您的班级或姓名',
                'Required' => true,
                'nameID' => 'text',
                'typeID' => 'text',
                'Minlength' => 5,
                'Maxlength' => 50,
                'Size' => '100px',
                'sort' => 2,
            ),
            FController::FabRand() =>
            array(
                'Label' => '日期',
                'Required' => true,
                'nameID' => 'datepicker',
                'typeID' => 'datepicker',
                'sort' => 3,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此选择您的选项',
                'Required' => true,
                'nameID' => 'dropdownlist',
                'typeID' => 'dropdownlist',
                'Data' => array(
                    '1' => '选项一',
                    '2' => '选项二',
                    '3' => '选项三',
                    '4' => '选项四',
                ),
                'Select' => 1,
                'sort' => 4,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此选择您的选项(多选)',
                'Required' => true,
                'nameID' => 'checkboxlist',
                'typeID' => 'checkboxlist',
                'Data' => array(
                    '1' => '选项一',
                    '2' => '选项二',
                    '3' => '选项三',
                    '4' => '选项四',
                ),
                'Select' => '',
                'sort' => 5,
            ),
            FController::FabRand() =>
            array(
                'Label' => '请在此选择您的选项',
                'Required' => true,
                'nameID' => 'radiolist',
                'typeID' => 'radiolist',
                'Data' => array(
                    '1' => '选项一',
                    '2' => '选项二',
                    '3' => '选项三',
                    '4' => '选项四',
                ),
                'Select' => '1',
                'sort' => 6,
            ),
            FController::FabRand() =>
            array(
                'Label' => '填写咨询内容',
                'Required' => true,
                'Rows' => 10,
                'Cols' => 50,
                'editorclass' => 'xheditor-simple',
                'nameID' => 'textarea',
                'typeID' => 'textarea',
                'sort' => 7,
            ),
        ),
    ),

);