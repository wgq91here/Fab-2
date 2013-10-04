<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FAttr
 *
 * @author wugangqiang
 */
class FAttr extends CFormModel
{
    public $postID = 1;
    public $postPassword = '';
    public $themeID = 'clean';
    public $Data = '';
    public $UniqueId = '0';
    public $FormTitle = 'Form Default Title';

    public $postOptions = array(
        1 => '匿名递交',
        21 => '通过口令访问并递交',
        31 => '根据用户登陆状态实名递交',
    );

    public $postHtmlOptions = array(
        "onclick" => "if (this.value == 21) { $('#postPasswordDiv').show(); } else { $('#postPasswordDiv').hide(); };",
    );

    public $themeOptions = array(
        'clean' => '单色整洁',
        'blue' => '蓝色基调',
        'jsedu' => '金山教育',
    );

    public function FAttr($init = array())
    {
        if (!empty($init)) {
            foreach ($init as $key => $value) {
                if (isset($this->$key)) {
                    $this->$key = isset($init[$key]) ? $init[$key] : $this->$key;
                }
            }
        }
        if ($this->FormTitle == 'Form Default Title') $this->FormTitle = Yii::t('FabModule.fab', 'Form Default Title');
    }

    public function rules()
    {
        return array(
            array('postID, themeID, Data, UniqueId, FormTitle', 'required'),
            array('postID, themeID', 'numerical'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'postID' => '表单递交范围',
            'postPassword' => '口令',
            'themeID' => '表单模板选择',
        );
    }
}

?>
