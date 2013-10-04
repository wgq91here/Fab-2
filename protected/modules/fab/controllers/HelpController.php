<?php
class HelpController extends FController
{
	public function actionIndex()
	{
		$this->render('/help/index');
	}

	/*
	  *  左侧菜单
	  *
	  */
	public function actionLeftmenu()
	{
		$_menu = array(
			'Fabcms 帮助'=>array(
				'帮助说明'=>Yii::app()->createurl('/fab/help'),
				'操作向导'=>Yii::app()->createurl('/fab/help/wizard'),
				),
			);
		$this->render('/common/leftmenu',array('menus'=>$_menu));
	}

	public function actionwizard()
	{
		$this->render('/help/wizard');
	}
}