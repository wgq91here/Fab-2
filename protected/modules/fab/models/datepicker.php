<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of xheditor
 *
 * @author wugangqiang
 */
class datepicker
{
    var $Dir = '';

    function init()
    {
        $assetDir = Yii::getPathOfAlias('application.modules.fab.libs.datePicker');
        $cs = Yii::app()->getClientScript();
        $am = Yii::app()->getAssetManager();

        $this->Dir = $am->publish($assetDir);
        $cs->registerCssFile($this->Dir . DIRECTORY_SEPARATOR . 'datePicker.css');
        $cs->registerScriptFile($this->Dir . DIRECTORY_SEPARATOR . 'datePicker.date.js');
        $cs->registerScriptFile($this->Dir . DIRECTORY_SEPARATOR . 'jquery.dataPicker.js');
    }

    function run()
    {
        echo CHtml::activeTextField($this->model, $this->attribute);

        $datepicker = <<<EOF
  var thisPicker_{$this->attribute} = $("#FgModel_{$this->attribute}");
  thisPicker_{$this->attribute}.attr('readonly',true);
  thisPicker_{$this->attribute}.datePicker({startDate:'1950-01-01'});
  thisPicker_{$this->attribute}.bind(
			'click',
			function()
			{
				$(this).dpDisplay();
				this.blur();
				return false;
			}
		);
EOF;
        $cs = Yii::app()->getClientScript();
        $cs->registerScript($this->attribute, $datepicker, CClientScript::POS_READY);
    }
}

?>