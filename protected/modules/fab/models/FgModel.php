<?php
/**
 * Description of FcForm\
 * 通用模型
 *
 * @author wugangqiang
 */
class FgModel extends CFormModel
{
    //
    private $x = array();

    public $_rules = array();
    public $_labels = array();

    public function rules()
    {
        return $this->_rules;
    }

    public function attributeLabels()
    {
        return $this->_labels;
    }

    public function __get($nm)
    {
        if (isset($this->x[$nm])) {
            $r = $this->x[$nm];
            return $r;
        } else {
            echo null;
        }
    }

    public function __set($nm, $val)
    {
        $this->x[$nm] = $val;
    }

    public function __isset($nm)
    {
        return isset($this->x[$nm]);
    }

    public function __unset($nm)
    {
        unset($this->x[$nm]);
    }

}

?>
