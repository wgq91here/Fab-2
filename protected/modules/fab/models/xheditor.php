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
class xheditor
{
    var $xheditorDir = '';

    function init()
    {
        $assetDir = Yii::getPathOfAlias('application.modules.fab.libs.xheditor');
        $cssDir = 'xheditor_skin' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR;

        $cs = Yii::app()->getClientScript();
        $am = Yii::app()->getAssetManager();

        $this->xheditorDir = $am->publish($assetDir);
        $cs->registerCssFile($this->xheditorDir . DIRECTORY_SEPARATOR . $cssDir . 'ui.css');
        $cs->registerScriptFile($this->xheditorDir . DIRECTORY_SEPARATOR . 'xheditor-zh-cn.min.js');
    }
}

?>
