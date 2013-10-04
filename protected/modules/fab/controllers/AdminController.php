<?php
class AdminController extends FController
{

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
				'actions'=>array('login'),
				'users'=>array('*'),
				 ),
			array('allow',
				'actions'=>array('index','main','logout','topmenu'),
				'users'=>array('@'),
				 ),
			array('deny',  // deny all other users
				'users'=>array('*'),
				 ),
			);
	}

	/*
	  *  用户登陆后 内容页链接
	  *
	  */
	public function actionAdmin()
	{
		$this->layout = $this->layout_iframe;
		$this->renderText(Yii::app()->createurl('/fab/help'));
	}

	/*
	  *  用户登陆后 内容页链接
	  *
	  */
	public function actionmain()
	{
		$this->redirect($this->createurl('model/create'));
		return ;
	}

	public function actionTopmenu()
	{
		$this->render('/common/topmenu',array('menus'=>Yii::app()->User->getTopMenu()));
	}

	public function actionIndex()
	{
		$this->redirect($this->createurl('admin/main'));
	}

	public function actionLogin()
	{
		$this->layout = $this->layout_center;
		$this->render('/user/login');
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->User->loginUrl);
	}
}