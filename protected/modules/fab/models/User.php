<?php

class User extends CActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANNED=-1;
	
	public $username;
	public $password;
	public $email;
	public $id;

	public $hash='md5';
	public $sendActivationMail=true;
	public $loginNotActiv=false;
	public $autoLogin=true;

	public $registrationUrl = array("user/registration");
	public $recoveryUrl = array("user/recovery");
	public $loginUrl = array("user/login");
	public $returnUrl = array("admin/main");
	public $returnLogoutUrl = array("user/login");
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	public function behaviors() {
		return array( 'CAdvancedArBehavior' => array(
			'class' => 'application.modules.user.components.CAdvancedArBehavior'));
	}
	*/

	public function tableName()
	{
		return 'users';
	}

	public function getTopMenu()
	{
		$_menu = array();

		if (!Yii::app()->user->isGuest) {
			$_menu = array(
				'我的资料'=>Yii::app()->createurl('/fab/user/leftmenu'),
			);
		}

		if (Yii::app()->User->isAdmin()) {
			$_menu = $_menu + array(
				'系统设置'=>Yii::app()->createurl('/fab/setting/leftmenu'),
				Yii::t('FabModule.fab', 'Make Model')=>Yii::app()->createurl('/fab/model/leftmenu'),
				'用户管理'=>Yii::app()->createurl('/fab/user/manageleftmenu'),
				);
		}
		return $_menu;
	}

	public function rules()
	{
		return array(
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => Yii::t("FabModule.fab", "Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => Yii::t("FabModule.fab", "Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => Yii::t("FabModule.fab", "This user's name already exists.")),
			array('email', 'unique', 'message' => Yii::t("FabModule.fab", "This user's email adress already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => Yii::t("FabModule.fab", "Incorrect symbol's. (A-z0-9)")),
			array('status', 'in', 'range'=>array(0,1,-1)),
			array('superuser', 'in', 'range'=>array(0,1)),
			array('username, password, email, createtime, lastvisit, superuser, status', 'required'),
			array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations()
	{
		return array(
			'profile'=>array(self::HAS_ONE, 'Profile', 'user_id'),
			'roles'=>array(self::MANY_MANY, 'Role', 'user_has_role(user_id, role_id)'),
		);
	}

	public function hasRole($role)
	{
		$user = CActiveRecord::model('User')->findByPk(Yii::app()->user->getId());
		foreach($user->roles as $obj) 
		{
			if($role == $obj->title)
				return true;
		}
		return false;
	}


	public function attributeLabels()
	{
		return array(
			'username'=>Yii::t("FabModule.fab", "username"),
			'password'=>Yii::t("FabModule.fab", "password"),
			'verifyPassword'=>Yii::t("FabModule.fab", "Retype Password"),
			'email'=>Yii::t("FabModule.fab", "E-mail"),
			'verifyCode'=>Yii::t("FabModule.fab", "Verification Code"),
			'id' => 'Id',
			'activkey' => Yii::t("FabModule.fab", "activation key"),
			'createtime' => Yii::t("FabModule.fab", "Registration date"),
			'lastvisit' => Yii::t("FabModule.fab", "Last visit"),
			'superuser' => Yii::t("FabModule.fab", "Superuser"),
			'status' => Yii::t("FabModule.fab", "Status"),
		);
	}
	
	/**
	 * @return hash string.
	 */
	public function encrypting($string="") {
		$hash = Yii::app()->User->hash;
		if ($hash=="md5")
			return md5($string);
		if ($hash=="sha1")
			return sha1($string);
		else
			return hash($hash,$string);
	}
	
	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactvie'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANNED,
            ),
            'superuser'=>array(
                'condition'=>'superuser=1',
            ),
        );
    }
	
	public function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				'0' => Yii::t("FabModule.fab", 'Not active'),
				'1' => Yii::t("FabModule.fab", 'Active'),
				'-1'=> Yii::t("FabModule.fab", 'Banned'),
			),
			'AdminStatus' => array(
				'0' => Yii::t("FabModule.fab", 'No'),
				'1' => Yii::t("FabModule.fab", 'Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}

	/**
	 * Return admins.
	 * @return array syperusers names
	 */	
	public function getAdmins() {
		$admins = User::model()->active()->superuser()->findAll();
		$return_name = array();
		foreach ($admins as $admin)
			array_push($return_name,$admin->username);
		return $return_name;
	}
	
	/**
	 * Return admin status.
	 * @return boolean
	 */
	public function isAdmin() {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if(User::model()->active()->superuser()->findbyPk(Yii::app()->user->id))
				return true;
			else
				return false;
		}
	}
}
