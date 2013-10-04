<?php

class FabModule extends CWebModule
{
	public $version = '0.1';
	public $debug = true;
	
	public $usersTable = "users";
	public $messagesTable = "messages";
	public $profileFieldsTable = "profile_fields";
	public $profileTable = "profiles";
	public $rolesTable = "roles";
	public $userRoleTable = "user_has_role";

	public $siteName = 'Fabcms';
	public $layout = 'main';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'fab.models.*',
			'fab.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
  
  
}

class FController extends CController
{
	public $layout_center = 'center';
	public $layout_iframe = 'mainframe';
	public $assetImagePath = '';

	static public function getAssetImagePath() {
		$assetDir = Yii::app()->controller->module->basePath.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
		return Yii::app()->getAssetManager()->getPublishedUrl($assetDir.'images').'/';
	}

	public function beforeAction() 
	{
		if (isset($_GET['ajax']) || isset($_POST['ajax'])) {
			$this->layout = 'ajax';
		}
		else
		{
			$this->initAssets();
			$this->layout = Yii::app()->controller->module->layout;
		}
		return true;
	}

	function initAssets()
	{
		$assetDir = Yii::app()->controller->module->basePath.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
		$JsFiles = array('common.js','jquery.jqURL.js');
		$Images = array();
		$CssFiles = array('reset.css','960.css','960_24_col.css','text.css','960fab.css'); //'uni-form.css'

		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');

		$am = Yii::app()->getAssetManager();
    $am->setbaseUrl(Yii::app()->params->cachesite.'/assets/');

//    foreach($JsFiles as $jsFile)
//      $cs->scriptMap[$jsFile] = '/js/site.min.js';
    
    //$cs->registerScriptFile('site.min.js');
    
//    echo vdump($cs->scriptMap);
//    die;
		foreach($JsFiles as $jsFile)
			$cs->registerScriptFile($am->publish($assetDir.'js'.DIRECTORY_SEPARATOR.$jsFile));

		foreach($CssFiles as $cssFile)
			$cs->registerCssFile($am->publish($assetDir.'css'.DIRECTORY_SEPARATOR.$cssFile));

		$am->publish($assetDir.'images',true);
		$this->assetImagePath = $am->getPublishedUrl($assetDir.'images');
    

	}

	function registerJsFile($jsFile)
	{
//    $cs = Yii::app()->getClientScript();
//    $cs->scriptMap[$jsFile] = 'form.fab.js';
    	 
		$assetDir = Yii::app()->controller->module->basePath.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$cs->registerScriptFile($am->publish($assetDir.'js'.DIRECTORY_SEPARATOR.$jsFile));
	}
  
  function registerCssFile($CssFile)
  {
    $assetDir = Yii::app()->controller->module->basePath.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
    $cs = Yii::app()->getClientScript();
    $am = Yii::app()->getAssetManager();
    $cs->registerCssFile($am->publish($assetDir.'css'.DIRECTORY_SEPARATOR.$CssFile));
  }

	public function initRenderBody()
	{
		//$_js = "$('body').addClass('body_adminpage'); ";
		//$cs = Yii::app()->getClientScript();
		//$cs->registerScript('fab_admin_body_ready', $_js, CClientScript::POS_LOAD);
	}

	function webMessage($message,$url,$second=0)
	{
		$viewFile = Yii::app()->controller->module->basePath.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'webmessage.php';
		$this->renderFile($viewFile,array(
			'message'=>$message,
			'url'=>$url,
			'second'=>$second,
		));
		return ;	
	}

	function ajaxHtmlMessage($message,$url='',$second=0)
	{
		$this->layout = 'ajax';
		exit("<SCRIPT LANGUAGE=\"JavaScript\">
		<!--
			alert({$message});
		//-->
		</SCRIPT>");
		return ;	
	}

	public static function FabRand($limit = 10)
	{
		$thisRand = '';
		$randpools1 = 'abcdefghijklABCDEFGHIJKLMNOQRSTUVWXYZmnoqrstuvwxyz';
		$randpools2 = '1234567890_';
		for ($i=1;$i<=$limit;$i++) {
			if (($i%2)==1) {
				$r1 = rand(0,47);
				$getRandString = substr($randpools1,$r1,1);
			} else {
				$r2 = rand(0,9);
				$getRandString = substr($randpools2,$r2,1);
			}
			$thisRand .= $getRandString;
		}
		return $thisRand;
	}
  
}

function FabDate($time,$format='Y-m-d')
  {
    $todaytime = date($format,$time);
    
    $srttime=date("w",$time);
    $array=array('日','一','二','三','四','五','六');
    $week = $array[$srttime];
    return str_replace("*",$week,$todaytime);
  }
  
function FabStrlen($string,$length=10)
{
  return mb_substr($string,0,$length).(mb_strlen($string)<=$length?'':'...');
}

function vdump($value, $title = "PLATS", $debug_plat_temp = "")
{
	$debug_plat_temp.= '<TABLE align="center" width="95%" cellpadding="0" cellspacing="0" style="margin-top: 5px;margin-bottom: 5px; border-right: 1px #a8a8a8 solid; border-left: 1px #A8A8A8 solid; border-top: 1px #A8A8A8 solid;">';
	while (list($key, $val) = each($value)) {
		$debug_plat_temp.= '<TR><TD width="20%" height="26" align="right" bgcolor="#DBDBDB" style="font-family: Tahoma;font-size: 12px; border-right: 1px solid White;border-bottom: 1px #a8a8a8 solid;border-right: 1px #A8A8A8 solid;">&nbsp;<B>'.$key.'</B>:&nbsp;</TD>';

		if (is_array($val) || is_object($val)) {
			$debug_plat_temp.= '<TD style="background-color: white;border-bottom: 1px #a8a8a8 solid;">';
			$debug_plat_temp = vdump($val, $key, $debug_plat_temp);
			$debug_plat_temp.= '</TD></TR>';
		} else {
			$debug_plat_temp.= '<TD style="background-color: #D0D2FD;font-family: Tahoma;font-size: 11px; border-bottom: 1px #a8a8a8 solid;padding-left:8px;text-align:left;">'.nl2br(ereg_replace("\n|\r|\r\n|\n|\r", "", htmlspecialchars($val))) .'&nbsp;</TD></TR>';
		}
	}
	$debug_plat_temp.= '</TABLE>';
	return $debug_plat_temp;
}