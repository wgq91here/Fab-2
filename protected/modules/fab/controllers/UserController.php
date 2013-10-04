<?php
class UserController extends FController
{
	private $_model;
	public $breadcrumbs;
	public $menu;

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
				'actions'=>array('index','view','registration','captcha','login', 'recovery', 'activation'),
				'users'=>array('*'),
				 ),
			array('allow',
				'actions'=>array('main', 'topmenu', 'leftmenu', 'profile', 'edit', 'logout', 'changepassword', 'manageleftmenu'),
				'users'=>array('@'),
				 ),
			array('deny',  // deny all other users
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

	/*
	  *  用户功能左侧菜单
	  *
	  */
	public function actionLeftmenu()
	{
		$_menu = array(
			'我的资料'=>array(
				Yii::t('FabModule.fab', 'Profile')=>$this->createurl('profile'),
				Yii::t('FabModule.fab', 'Edit')=>$this->createurl('edit'),
				Yii::t('FabModule.fab', 'Change password')=>$this->createurl('changepassword'),
				),
			);
		$this->render('/common/leftmenu',array('menus'=>$_menu));
	}

	/*
	  *  
	  *
	  */
	public function actionManageleftmenu()
	{
		$_menu = array(
			'用户管理'=>array(
				Yii::t('FabModule.fab', 'Create User')=>$this->createurl('list'),
				Yii::t('FabModule.fab', 'List User')=>$this->createurl('list'),
				Yii::t('FabModule.fab', 'Search User')=>$this->createurl('search'),
				),
			Yii::t('FabModule.fab', 'Manage User Groups')=>array(
				Yii::t('FabModule.fab', 'Create User Groups')=>$this->createurl('edit'),
				Yii::t('FabModule.fab', 'List User Groups')=>$this->createurl('profile'),
				Yii::t('FabModule.fab', 'Search User Groups')=>$this->createurl('edit'),
				),
			Yii::t('FabModule.fab', 'Manage Roles')=>array(
				Yii::t('FabModule.fab', 'List Roles')=>$this->createurl('profile'),
				Yii::t('FabModule.fab', 'Create Role')=>$this->createurl('edit'),
				),
			);
		$this->render('/common/leftmenu',array('menus'=>$_menu));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new UserLogin;
		// collect user input data
		if(isset($_POST['UserLogin']))
		{
			$model->attributes = $_POST['UserLogin'];
			// validate user input and redirect to previous page if valid
			if($model->validate()) 
			{
				$lastVisit = User::model()->findByPk(Yii::app()->user->id);
				$lastVisit->lastvisit = time();
				$lastVisit->save();
				//$this->redirect(Yii::app()->User->returnUrl);
        $this->redirect($this->createUrl('model/advancecreate'));        
			}
		}
		// display the login form
		$this->layout = $this->layout_center;
		$this->render('login',array('model'=>$model,));
	}

	public function actionProfile()
	{
		// Display my own profile:
		if(!isset($_GET['id'])) {
			if (Yii::app()->user->id) {
				$model = $this->loadUser($uid = Yii::app()->user->id);
				
				$this->render('/user/myprofile',array(
					'model'=>$model,
					'profile'=>$model->profile,
				));
			}
		}
		else 
		{ // Display a foreign profile:
			$model = $this->loadUser($uid = $_GET['id']);
			$this->render('/user/foreignprofile',array(
				'model'=>$model,
				'profile'=>$model->profile,
			));
		}
	}

	/**
	 * Logout the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect($this->createUrl('user/login'));
	}
  
	public function loadUser($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=User::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}