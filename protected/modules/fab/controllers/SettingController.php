<?php
class SettingController extends FController
{
	private $_model;

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('main', 'topmenu', 'leftmenu', 'firstmenu', 'profile', 'edit', 'logout', 'changepassword'),
				'users'=>array('@'),
				 ),
			array('deny',
				'users'=>array('*'),
				 ),
			);
	}

	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	public function actionIndex()
	{
		$this->redirect($this->createurl('admin/login'));
	}

	public function actionLeftmenu()
	{
		$_menu = array(
			Yii::t('FabModule.fab', 'Setting')=>array(
				Yii::t('FabModule.fab', 'System setting')=>$this->createurl('list'),
				),
			Yii::t('FabModule.fab', 'Database')=>array(
				Yii::t('FabModule.fab', 'Database backup')=>$this->createurl('dbbackup'),
				),
			);
		$this->render('/common/leftmenu',array('menus'=>$_menu));
	}

}