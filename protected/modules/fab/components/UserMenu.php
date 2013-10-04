<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserMenu
 *
 * @author wugangqiang
 */
class UserMenu extends Portlet
{
    public $profile; // profile is show;

    public function init()
    {
        $this->title = CHtml::encode(Yii::app()->user->name);
        parent::init();
    }

    protected function renderContent()
    {
        $this->render('userMenu');
    }
}
