<?php
/**
 * Description of FabForm
 *
 * @author wugangqiang
 */
class FabForm
{
    public $UniqueId;
    public $attr;
    public $model;
    public $config;
    public $PostData;

    public $CForm;

    // UniqueId数据不正确
    const UNIQUEIDNOTEXIST = 0;
    const FORMDATAERROR = 1;
    const JSONDECODEERROR = 2;

    /**
     * FabForm::initForm()
     *
     * @param mixed $PostData = array('UniqueId','FAttr')
     * @return void
     */
    public function initForm($PostData = array(), $_issave = true)
    {
        Yii::import('application.modules.fab.libs.*');
        @require_once('Flea.Array.php');

        $this->UniqueId = $PostData['FAttr']['UniqueId'];

        if (!is_array($PostData['FAttr']['Data'])) {
            $_jsondecodeData = json_decode($PostData['FAttr']['Data'], true);
        } else {
            $_jsondecodeData = $PostData['FAttr']['Data'];
        }

        if (empty($_jsondecodeData)) {
            return Fabcms::JSONDECODEERROR;
        }


        $this->_Fields = array_column_sort($_jsondecodeData, 'sort');
        unset($_jsondecodeData, $this->_Fields['fxqueue']);

        $this->config['showErrorSummary'] = false;

        foreach ($this->_Fields as $key => $field) {
            $this->config['elements'][$key] = array('type' => $field['typeID']);
        }

        $this->config['buttons'] = array('post' => array('type' => 'submit', 'label' => Yii::t('FabModule.fab', 'Post this form'),));

        $_rules = array();
        $Required = array();
        $this->model = new FgModel;

        foreach ($this->_Fields as $key => $field) {
            $this->model->$key = null;
            $this->model->_labels[$key] = $field['Label'];

            $Default[] = $key;
            if ($field['Required']) {
                $Required[] = $key;
            }

            if ($field['nameID'] == 'text') {
                $this->config['elements'][$key]['layout'] = "{hint}{error}<div style='padding-bottom:5px;'>{label}</div>{input}";
            }

            if ($field['nameID'] == 'datepicker') {
                $this->model->_rules[] = array($key, 'type', 'type' => 'date', 'dateFormat' =>
                'yyyy-MM-dd');
                $this->config['elements'][$key]['layout'] = "{hint}{error}<div style='padding-bottom:5px;'>{label}</div>{input}";
            }

            if ($field['nameID'] == 'checkboxlist') {
                $this->config['elements'][$key]['items'] = $field['Data'];
                $this->config['elements'][$key]['separator'] = '';
                $this->config['elements'][$key]['layout'] = '{hint}{error}<div style="padding-bottom:5px;">{label}</div><ul>{input}</ul>';
                $this->config['elements'][$key]['template'] = '<li style="display:inline;padding-right:46px">{input}{label}</li>';
                $this->model->$key = (empty($field['Select'])) ? array() : array_keys(array_filter($field['Select']));
                //$this->model->$key = array(1);
            }

            if ($field['nameID'] == 'textarea') {
                $this->config['elements'][$key]['rows'] = $field['Rows'];
                $this->config['elements'][$key]['cols'] = $field['Cols'];
                $this->config['elements'][$key]['layout'] = "{hint}{error}<div style='padding-bottom:5px;'>{label}</div>{input}";
                $this->config['elements'][$key]['class'] = $field['editorclass'];
            }

            if ($field['nameID'] == 'radiolist') {
                $this->config['elements'][$key]['items'] = $field['Data'];
                $this->config['elements'][$key]['separator'] = '';
                $this->config['elements'][$key]['layout'] =
                    '{hint}{error}<div style="padding-bottom:5px;">{label}</div><ul>{input}</ul>';
                $this->config['elements'][$key]['template'] =
                    '<li style="display:inline;padding-right:46px">{input} {label}</li>';
                $this->model->$key = $field['Select'];
            }

            if ($field['nameID'] == 'dropdownlist') {
                $this->config['elements'][$key]['items'] = $field['Data'];
                $this->config['elements'][$key]['separator'] = '';
                $this->config['elements'][$key]['layout'] =
                    '{hint}{error}<div style="padding-bottom:5px;">{label}</div><ul>{input}</ul>';
                $this->model->$key = $field['Select'];
            }

            if ($field['nameID'] == 'simpletext') {
                array_pop($Default);
                unset($this->model->_labels[$key]);
                unset($this->model->$key);
                $this->config['elements'][$key] = '<div class="row">' . $field['Label'] . '</div>';
                //unset($this->model->$key);
            }
        }

        $this->model->_rules[] = array(implode(',', $Required), 'required');
        $this->model->_rules[] = array(implode(',', $Default), 'default');

        //echo vdump($this->model);
        //echo vdump($this->config);

        //require_once('FabForm.php');
        //echo ini_get('include_path');
        //die;

        $this->attr = new FAttr();
        $this->attr->attributes = $PostData['FAttr'];
        //$PreViewForm->title = $attr->FormTitle;

        $this->config['title'] = $this->attr->FormTitle;
        $this->PostData = $PostData['FAttr'];

        $_saveForm = array(
            'config' => $this->config,
            'attr' => $this->attr,
            'model' => $this->model,
            'PostData' => $PostData['FAttr']
        );

        if ($_issave) $this->_save($_saveForm);
        return $_saveForm;
    }


    public function load($UniqueId)
    {
        $saveForm = Yii::app()->cache->get($UniqueId);

        if ($saveForm == null) {
            $Db_model = models::model();
            $ClassFormer = $Db_model->findByPk($UniqueId);
            if ($ClassFormer == false) return false;

            $saveForm = $this->mb_unserialize($ClassFormer->data);
            $this->_saveCache($saveForm);
        }
        $this->UniqueId = $UniqueId;
        $this->config = $saveForm['config'];
        $this->model = $saveForm['model'];
        $this->attr = $saveForm['attr'];
        $this->PostData = $saveForm['PostData'];
        return true;
    }

    private function mb_unserialize($serial_str)
    {
        $out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str);
        return unserialize($out);
    }

    private function _saveCache($SaveForm)
    {
        Yii::app()->cache->delete($this->UniqueId);
        Yii::app()->cache->set($this->UniqueId, $SaveForm);
    }

    private function _save($SaveForm)
    {
        //$SaveForm = array('config'=>$this->config,'model'=>$this->model,'PostData'=>$PostData['FAttr']);

        //$PreViewForm = $this($this->config, $this->model);
//		$PreViewForm->setattr($attr);
//
//		$PreViewForm->action = $this->createUrl('submit', array('id' => $UniqueId));
//		$PreViewForm->inputElementClass = 'c';

        //echo vdump($PreViewForm->getElementsByTagName('CFormElementCollection_form'));
        //echo vdump($SaveForm);
        //die;

        //$PreViewForm->activeForm = $this->config;
        //echo vdump($SaveForm);
        $this->_saveCache($SaveForm);

        // 保存表单至数据库
        $CurrentForm = models::model()->findByPk($this->UniqueId);
        if ($CurrentForm == null) {
            $newForm = array(
                "mid" => $this->UniqueId,
                "created" => time(),
                "title" => $SaveForm['config']['title'],
                "userid" => isset(Yii::app()->user) ? Yii::app()->user->id : 0,
                "data" => $SaveForm,
            );
            $CurrentForm = new models;
            $CurrentForm->isNewRecord = true;
        } else {
            $newForm = array(
                "created" => time(),
                "title" => $SaveForm['config']['title'],
                "userid" => isset(Yii::app()->user) ? Yii::app()->user->id : 0,
                "data" => $SaveForm,
            );
        }
        $CurrentForm->attributes = $newForm;
        return $CurrentForm->save();
    }

    public function CForm()
    {
        $this->CForm = new CForm($this->config, $this->model, null);

        return $this->CForm;
    }


//
//	public function render1()
//	{
//		$output = $this->renderBegin();
//
//		foreach($this->getElements() as $element) {
//			$output .= $element->render();
//			echo vdump($element);
//		}
//
//		$output .= CHtml::submitButton('post',array('name'=>'post','value'=>"Post"));
//		$output .= $this->renderEnd();
//
//		return $output;
//	}
//
//	public function render2()
//	{
//		$output = $this->renderBegin();
//		$output .= "<div class='uniForm'>";
//		//var_dump($this->getModel()->getErrors());
//
//		foreach($this->getElements() as $element) {
//
//			$output .= '<div class="ctrlHolder">'.$element->render().'</div>';
//			if ($element->type == 'textarea') {
//				echo $element->attributes['WYSIWYG'];
//				if ($element->attributes['WYSIWYG']) {
//					FabForm::registerJsFile('xheditor-zh-cn.min.js');
//				}
//			}
//			//echo ($name);
//		}
//		//die;
//
//		$output .= CHtml::submitButton('post',array('name'=>'post','value'=>"Post"));
//		$output .= "</div>";
//		$output .= $this->renderEnd();
//
//		return $output;
//	}
//
}

?>
