<?php

class ModelController extends FController
{
	private $_model;

	// 定义已经确定使用的字段
	private $_models = array('A01' => 'simpletext', 'A02' => 'datepicker', 'S11' =>
    'text', 'S12' => 'textarea', 'S17' => 'radiolist', 'S18' => 'checkboxlist',
    'S19' => 'dropdownlist', //'S17'=>'file',
	//'S18'=>'radio',
	//'S15'=>'password',
	/*
	 'S12'=>'image',
	 'S14'=>'email',
	 'S15'=>'number',
	 'S16'=>'simplefileupload',
	 'S17'=>'checkbox',
	 'S18'=>'radio',
	 'S19'=>'list',
	 'S20'=>'textarea',
	 */
	);

	private $_pravteModels = array('Y11' => 'username', 'Y20' => 'hidden', );


	var $PostFormError = array(0 => 'UniqueId数据不正确', 1 => '未递交数据信息', 2 => '递交数据无法解析', );

	/**
	 * ModelController::filters()
	 *
	 * @return
	 */
	public function filters()
	{
		return array('accessControl', );
	}

	/**
	 * ModelController::accessRules()
	 *
	 * @return
	 */
	public function accessRules()
	{
		return array(array('allow', 'actions' => array('main', 'leftmenu', 'edit',
      'create','advancecreate', 'advancegeneration', 'update', 'preview', 'save', 'finish', 'myforms', 'lock', 'delete', 'loadfield',
      'addfield', 'fieldupdaterender', 'test', ), 'users' => array('@'), ), array('allow',
      'actions' => array('submit'), 'users' => array('*'), ), array('deny', 'users' =>
		array('*'), ), );
	}

	/**
	 * ModelController::actionMyForms()
	 *
	 * @return
	 */
	public function actionMyForms()
	{
		//$myforms = models::model()->myforms()->findAll();

		//		$criteria=new CDbCriteria(array(
		//			'condition'=>'userid=' . Yii::app()->user->id,
		//			'order'=>'created DESC',
		//			//'with'=>'commentCount',
		//		));

		//		$pages=new CPagination(models::model()->count($criteria));
		//		$pages->pageSize=models::PAGE_SIZE;
		//		$pages->applyLimit($criteria);

		$myforms = models::model()->myforms()->findAll();
		//echo vdump($myforms);

		$this->render('myforms', array('myforms' => $myforms));
	}

	public function actionAdvancecreate()
	{
    Yii::import('application.modules.fab.libs.*');
		$advanceForms = include('advanceForm.array.php');
    
    
		$this->render('advancecreate',array('advanceForms'=>$advanceForms));
	}

  public function actionAdvancegeneration()
  {
    Yii::import('application.modules.fab.libs.*');
		$advanceForms = include('advanceForm.array.php');
        
    if (!isset($_GET['formid']) || !isset($advanceForms[$_GET['formid']])) {
      throw new CHttpException(404,'The Aadvance former is not exist.');
    }
    
    $advanceForm = $advanceForms[$_GET['formid']];    
    $advanceForm['UniqueId'] = FController::FabRand(20);
    //$key = (is_numeric($key))?FController::FabRand():$key;
    
    $ClassFabForm = new FabForm();
    $ClassFabForm->initForm(array('FAttr'=>$advanceForm),false);
    //echo vdump($advanceForm);
    
    // $this->redirect($this->createUrl('update', array('id' => $advanceForm['UniqueId'])));
    
    // $this->redirect($this->createUrl('submit', array('id' => $advanceForm['UniqueId'])));
    
		$this->initRenderBody();
		$this->registerJsFile('modelCreate.js');
		$this->registerJsFile('json2.js');
		$this->registerJsFile('..' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR .
      'js' . DIRECTORY_SEPARATOR . 'jquery-ui-1.7.2.custom.min.js');
		$this->registerJsFile('floatdiv' . DIRECTORY_SEPARATOR . 'jquery.floatDiv.js');

		// 获取定义的字段模型
		$fieldModels = array();
		foreach ($this->_models as $KEY => $_modelFieldType)
		{
			$FModelTpyeClassName = "FModel" . $_modelFieldType;
			$FModelClass = new $FModelTpyeClassName();
			$init = $FModelClass->init();
			if (isset($init['jsFiles']) && is_array($init['jsFiles']))
			{
				foreach ($init['jsFiles'] as $jsfile)
				{
					$this->registerJsFile($jsfile);
				}
			}
			array_push($fieldModels, 
        array(
          'typeID' => $FModelClass->typeID, 
          'nameID' => $FModelClass->nameID,
          'name' => $FModelClass->name)
      );
		}

		$this->registerJsFile("jquery.form.js");

		$_previewUrl = $this->createUrl('preview');
		$_saveUrl = $this->createUrl('save');
		$_submitUrl = $this->createUrl('finish');

    //echo vdump($ClassFabForm->PostData);
    //die;
    $_update_js = "";
    
    //echo vdump($ClassFabForm);
    $runtime = 100;
    foreach ($ClassFabForm->PostData['Data'] as $uniqueID=>$attr) {
      $typeID = $attr['typeID'];
      unset($attr['typeID'],$attr['nameID']);
      $_t_url = $this->createurl('loadfield',array('ajax'=>true,'modelFieldType'=>$typeID,'uniqueID'=>$uniqueID, 'attrs'=>serialize($attr)));
      $runtime = $runtime + 300;     
      $_t_string = <<<EOF
var _load_{$runtime} = function() { model_ajax('{$_t_url}'); }      
setTimeout(_load_{$runtime},{$runtime});\n
EOF;
      $_update_js .= $_t_string;
    }    
    
    $cs = Yii::app()->getClientScript();
    $AdvanceForm_js = $_update_js;
    
    $cs->registerScript('AdvanceForm',$AdvanceForm_js,CClientScript::POS_READY);    

    $Fattr_init_array = array(
      'FormTitle'=>$ClassFabForm->attr['FormTitle'],
      'themeID'=>$ClassFabForm->attr['themeID'],
      );
     
		$this->render('create', 
      array(
        'FAttr' => new FAttr($Fattr_init_array), 
        '_Form_UniqueId' => $ClassFabForm->UniqueId, 
        'fieldModels' => $fieldModels, 
        '_previewUrl' => $_previewUrl,
        '_saveUrl' => $_saveUrl, 
        '_submitUrl' => $_submitUrl,
        '_updateFields' => true,
        )
      );
          
  }
    
	/**
	 * ModelController::actionUpdate()
	 *
	 * @return
	 */
	public function actionUpdate()
	{
    $ClassFabForm = new FabForm();
    if ($ClassFabForm->load($_GET['id']) == false) {
      throw new CHttpException(404,'The former is not exist. So do not update.');
    }

    // $this->redirect($this->createUrl('update', array('id' => $advanceForm['UniqueId'])));
    
    // $this->redirect($this->createUrl('submit', array('id' => $advanceForm['UniqueId'])));
    
		$this->initRenderBody();
		$this->registerJsFile('modelCreate.js');
		$this->registerJsFile('json2.js');
		$this->registerJsFile('..' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR .
      'js' . DIRECTORY_SEPARATOR . 'jquery-ui-1.7.2.custom.min.js');
		$this->registerJsFile('floatdiv' . DIRECTORY_SEPARATOR . 'jquery.floatDiv.js');

		// 获取定义的字段模型
		$fieldModels = array();
		foreach ($this->_models as $KEY => $_modelFieldType)
		{
			$FModelTpyeClassName = "FModel" . $_modelFieldType;
			$FModelClass = new $FModelTpyeClassName();
			$init = $FModelClass->init();
			if (isset($init['jsFiles']) && is_array($init['jsFiles']))
			{
				foreach ($init['jsFiles'] as $jsfile)
				{
					$this->registerJsFile($jsfile);
				}
			}
			array_push($fieldModels, 
        array(
          'typeID' => $FModelClass->typeID, 
          'nameID' => $FModelClass->nameID,
          'name' => $FModelClass->name)
      );
		}

		$this->registerJsFile("jquery.form.js");

		$_previewUrl = $this->createUrl('preview');
		$_saveUrl = $this->createUrl('save');
		$_submitUrl = $this->createUrl('finish');

    //echo vdump($ClassFabForm->PostData);
    //die;
    $_update_js = "";
    
    if (!is_array($ClassFabForm->PostData['Data'])) {
      $ClassFabForm->PostData['Data'] = json_decode($ClassFabForm->PostData['Data']);
    }
    //echo vdump($ClassFabForm);
    $runtime = 100;
    foreach ($ClassFabForm->PostData['Data'] as $uniqueID=>$attr) {
      settype($attr,'array');
      $typeID = $attr['typeID'];
      unset($attr['typeID'],$attr['nameID']);
      $_t_url = $this->createurl('loadfield',array('ajax'=>true,'modelFieldType'=>$typeID,'uniqueID'=>$uniqueID, 'attrs'=>serialize($attr)));
      $runtime = $runtime + 300;     
      $_t_string = <<<EOF
var _load_{$runtime} = function() { model_ajax('{$_t_url}'); }      
setTimeout(_load_{$runtime},{$runtime});\n
EOF;
      $_update_js .= $_t_string;
    }    
    
    $cs = Yii::app()->getClientScript();
    $AdvanceForm_js = $_update_js;
    
    $cs->registerScript('AdvanceForm',$AdvanceForm_js,CClientScript::POS_READY);    

    $Fattr_init_array = array(
      'FormTitle'=>$ClassFabForm->attr['FormTitle'],
      'themeID'=>$ClassFabForm->attr['themeID'],
      );
     
		$this->render('create', 
      array(
        'FAttr' => new FAttr($Fattr_init_array), 
        '_Form_UniqueId' => $ClassFabForm->UniqueId, 
        'fieldModels' => $fieldModels, 
        '_previewUrl' => $_previewUrl,
        '_saveUrl' => $_saveUrl, 
        '_submitUrl' => $_submitUrl,
        '_updateFields' => true,
        )
      );
          
      
	}
      
	/**
	 * ModelController::actionSubmit()
	 *
	 * @return
	 */
	public function actionSubmit()
	{
		$PreViewForm = null;

		if (isset($_GET['id']))
		{
//			$CacheForm = Yii::app()->cache->get($_GET['id']);
//			$PreViewForm = new CForm($CacheForm['_form'], $CacheForm['PForm']);
//      
//      echo '<pre><code>';
//      echo vdump($PreViewForm);
      //echo vdump($CacheForm['_form']);
      //echo vdump($CacheForm['PForm']);
      //die;
//      
		  $ClassFabcms = new FabForm();
      if (!$ClassFabcms->load($_GET['id'])) throw new CHttpException(404,'The former is not exist.'); 

          
      $PreViewForm = $ClassFabcms->CForm();
      
      $model = models::model()->with('user')->findByPk($ClassFabcms->UniqueId);
      if ($model->locked == 1) {
        $PreViewForm->setButtons(array('post' => array('disabled'=>true, 'type' => 'button', 'label' => Yii::t('FabModule.fab','Locked') ) ));
      }      
      
      $PreViewForm->attributes = array('UniqueId'=>$ClassFabcms->UniqueId);			
			$PreViewForm->action = $this->createUrl('submit', array('id' => $ClassFabcms->UniqueId));
			$PreViewForm->inputElementClass = 'c';
      
//      echo '<pre><code>';
//      echo vdump($PreViewForm);
//      echo vdump($ClassFabcms->config);
//      echo vdump($ClassFabcms->model);
//      die;
      //echo vdump($PreViewForm->getElements());
		} else
		{
			throw new CHttpException(404,'The evil intention submits.'); 
		}
		//echo vdump($PreViewForm);
		// var_dump($PreViewForm->validate());

		if (!empty($_POST))
		{ 
      if ($model->locked == 1) {
        throw new CHttpException(404,'The former is locked. 已经被创建人锁定，请不要递交此表单。'); 
      }
      		  
			$value = array();
			//echo vdump($PreViewForm);
			if ($PreViewForm->submitted('post') && $PreViewForm->validate())
			{
			 
//				echo '获得表单<br/>';
//				echo vdump($_POST);
//				echo '正确结果<br/>';
				foreach ($PreViewForm->getElements() as $key => $element)
				{
					if (isset($element->name) && isset($element->type))
					{
						$fmodelname = 'FModel' . $element->type;
						$fmodel = new $fmodelname;
						$value[$element->name] = $fmodel->getValueByForm($element, $_POST['FgModel'][$element->name]);
						//echo vdump($element);
						/*
						 if (!empty($element->items)) {
						 // 将items对应key取出
						 echo vdump($element->items);
						 var_dump($_POST['FgModel'][$element->name]);
						 foreach ($_POST['FgModel'][$element->name] as $value) {
						 echo $element->items[$value].',';
						 }
						 }
						 */
					} else
					{
						$PreViewForm->removedElement($key, $element, true);
					}
					//echo vdump($element);
					//echo ($element->type);
					//echo vdump($element->name);

				}
//				echo vdump($value);
				$ClassPost = new posts;
				$ClassPost->setModelId($PreViewForm->attributes['UniqueId']);

				$newPost = array(
          'mid'=>$PreViewForm->attributes['UniqueId'],
          'pdata'=>$value,
				);
				$ClassPost->attributes = $newPost;
				$ClassPost->isNewRecord = true;
				$ClassPost->save($newPost);
        
        $this->layout = 'mainnone';
        $this->render('submited', array('labels' => $ClassFabcms->model->_labels,'data' => $value));
        return;
        
				//echo vdump($ClassPost->getErrors());
        
        
				//        Yii::import('application.modules.fab.libs.*');
				//        @require_once ('FMongoDB.php');
				//        $FMong = new FMongoDB();
				//        $FMong->setValue('posts', $_GET['id'], $value);
				//        echo vdump($FMong);

				
			}
      
		} 
    
    
		$editor = new xheditor;
		$editor->init();    
   
    $this->setPageTitle($PreViewForm->title);    
    $this->registerCssFile($ClassFabcms->attr->themeID.'.css');
    
		$this->layout = 'mainnone';
		$this->render('preview', array('PreViewForm' => $PreViewForm, 'model'=>$model));

	}

	/**
	 * ModelController::actionlockfrom()
	 *
	 * @return void
	 */
	public function actionlock()
	{
		$UniqueId = $_GET['id'];
		$model = models::model()->myforms()->findByPk($UniqueId);
		if ($model == null) // no found former
		{
			echo '<span style="color:red;">EER!</span>';
			return ;
		} else { // has former
			if ($model->locked == models::LOCK) {
				$updatedrow = $model->updateByPk($UniqueId,array('locked'=>models::UNLOCK));
				$returnValue = Yii::t('FabModule.fab','Lock');
			} else {
				$updatedrow = $model->updateByPk($UniqueId,array('locked'=>models::LOCK));
				$returnValue = Yii::t('FabModule.fab','Unlock');
			}
		}
		echo (($updatedrow>0)?(string)$returnValue:'<span style="color:red;">ER!</span>');
		return ;
	}

	public function actionDelete()
	{
    $UniqueId = $_GET['id'];
		$model = models::model()->myforms()->with('posts')->findByPk($UniqueId);
		if ($model == null) // no found former
		{
			echo json_encode(array('error'=>true,'html'=>'No Found!'));
      return;
		}
    
    if ($model->myforms()->deleteByPk($UniqueId)) {
      posts::model()->deleteAll('mid="'.$UniqueId.'"');     
      echo json_encode(array('n'=>$_GET['n'],'error'=>false,'html'=>'Delete finished.'));
      return ;
    }
		echo json_encode(array('error'=>true,'html'=>'Repeat Delete Error!'));
    return ;
	}

	/**
	 * ModelController::actionCreate()
	 *
	 * @return
	 */
	public function actionCreate()
	{
		$this->initRenderBody();
		$this->registerJsFile('modelCreate.js');
		//$this->registerJsFile('firebug-lite-compressed.js');
		//$this->registerJsFile('jquery.json-2.2.min.js');
		$this->registerJsFile('json2.js');
		$this->registerJsFile('..' . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR .
      'js' . DIRECTORY_SEPARATOR . 'jquery-ui-1.7.2.custom.min.js');
		$this->registerJsFile('floatdiv' . DIRECTORY_SEPARATOR . 'jquery.floatDiv.js');

		// 获取定义的字段模型
		$fieldModels = array();
		foreach ($this->_models as $KEY => $_modelFieldType)
		{
			$FModelTpyeClassName = "FModel" . $_modelFieldType;
			$FModelClass = new $FModelTpyeClassName();
			$init = $FModelClass->init();
			if (isset($init['jsFiles']) && is_array($init['jsFiles']))
			{
				foreach ($init['jsFiles'] as $jsfile)
				{
					$this->registerJsFile($jsfile);
				}
			}
			array_push($fieldModels, array('typeID' => $FModelClass->typeID, 'nameID' => $FModelClass->
			nameID, 'name' => $FModelClass->name));
		}

		$this->registerJsFile("jquery.form.js");

		$_previewUrl = $this->createUrl('preview');
		$_saveUrl = $this->createUrl('save');
		$_submitUrl = $this->createUrl('submit');

		$this->render('create', 
      array(
        'FAttr' => new FAttr(), 
        '_Form_UniqueId' => $this->FabRand(20), 
        'fieldModels' => $fieldModels, 
        '_previewUrl' => $_previewUrl,
        '_saveUrl' => $_saveUrl, 
        '_submitUrl' => $_submitUrl,
        '_updateFields' => false,
        )
      );
      
	}


	/*
	 public function actionaddField()
	 {
	 if (!in_array($_GET['modelFieldType'], $this->_models))
	 {
	 $renderJava = "alert('".Yii::t('FabModule.fab','No found this model.')."');";
	 echo CJSON::encode(array('error'=>TRUE,'html'=>$renderJava));
	 return ;
	 }

	 $modelFieldType = $_GET['modelFieldType'];
	 $FModelTpyeClassName = "FModel".$modelFieldType;
	 $FModelClass = new $FModelTpyeClassName;
	 $FModelClass->attributes();

	 $randerData = array(
	 'fieldID'=>FController::FabRand(10),
	 'fmClass'=>$FModelClass,
	 'fieldType'=>$modelFieldType,
	 );
	 $renderFieldHtml = $this->renderPartial('ajax_model_'.$modelFieldType, $randerData, true);
	 $renderMainHtml = $this->renderPartial('_model_main',$randerData + array('content'=>$renderFieldHtml),true);

	 // 暂存字段属性
	 Yii::app()->cache->set($randerData['fieldID'], $FModelClass);

	 // 返回 JSON
	 echo CJSON::encode(array('error'=>FALSE,'id'=>$randerData['fieldID'],'data'=>$FModelClass->getAttributes(),'html'=>$renderMainHtml));
	 return ;
	 }
	 */

	/**
	 * ModelController::_saveForm()
	 *
	 * @return
	 */
	private function _saveForm()
	{
		// 对于浏览者恶意输入UniqueId值未作处理 应该对所属用户拥有的UniqueId值进行判断 防止恶意输入其它表单的UniqueId值 造成数据破坏
		if (!isset($_POST['FAttr']['UniqueId']))
		{
			return FabForm::UNIQUEIDNOTEXIST;
		}
		
		$UniqueId = $_POST['FAttr']['UniqueId'];

		if (!isset($_POST['FAttr']['Data']))
		{
			return FabForm::FORMDATAERROR;
		}

		$ClassFabcms = new FabForm();
    $ClassFabcms->initForm($_POST);
    
    //echo vdump($ClassFabcms->initForm($_POST));

		return $UniqueId;

		//echo $PreViewForm->UniqueId;
		//echo vdump($PForm);
		//echo vdump($_form);
		//die;
		//echo $PreViewForm;
		//echo vdump($PreViewForm);
		//die;
	}

	/**
	 * ModelController::actionPreview()
	 *
	 * @return
	 */
	public function actionPreview()
	{
		$FormID = $this->_saveForm();

		if (is_numeric($FormID))
		{
			exit($this->PostFormError[$FormID]);
		}

		$this->redirect($this->createUrl('submit', array('id' => $FormID)));

		//echo $PreViewForm;

		//echo vdump($PreViewForm);

		//echo vdump($PreviewForm);
		//echo vdump($PreviewForm->attributeLabels());
	}
  
  public function actionFinish()
  {
		$FormID = $this->_saveForm();

		if (is_numeric($FormID))
		{
			exit($this->PostFormError[$FormID]);
		}
    
    $this->webMessage(Yii::t('FabModule.fab', 'Save this form is over.'), Yii::app()->createUrl('/fab/model/myforms'),1000);
  }

	/**
	 * ModelController::actionSave()
	 *
	 * @return
	 */
	public function actionSave()
	{
		$FormID = $this->_saveForm();
		exit('loadAjaxMessage("' . $FormID . (is_numeric($FormID) ? $this->
		PostFormError[$FormID] : " 已保存") . '",1000);');
	}

	/**
	 * ModelController::actionLoadfield()
	 *
	 * @return
	 */
	public function actionLoadfield()
	{
		if (!in_array($_GET['modelFieldType'], $this->_models))
		{
			$renderJava = "alert('" . Yii::t('FabModule.fab', 'No found this model.') .
        "');";
			echo CJSON::encode(array('error' => true, 'html' => $renderJava));
			return;
		}

		$modelFieldType = $_GET['modelFieldType'];
		$FModelTpyeClassName = "FModel" . $modelFieldType;
		$FModelClass = new $FModelTpyeClassName;    
    
    if (isset($_GET['attrs'])) {
      $modelFieldAttrs = array();
      @$modelFieldAttrs = unserialize($_GET['attrs']);      
      if (!empty($modelFieldAttrs)) $FModelClass->setAttributes($modelFieldAttrs);      
    }
    
		//$FModelClass->setController(&$this);
		//var_dump($FModelClass->getController());

		echo json_encode($FModelClass->front());
		return;
	}

	public function loadModel($mid = null)
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$condition='';
				$this->_model=models::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
			throw new CHttpException(404,'The former is not exist.');
		}
		return $this->_model;
	}

	/**
	 * ModelController::actionFieldUpdateRender()
	 *
	 * @return
	 */
	public function actionFieldUpdateRender()
	{
		$fieldID = $_GET['fieldId'];
		$FModelClass = Yii::app()->cache->get($fieldID);

		if ($FModelClass === false)
		{
			return 'No exist';
		}

		echo $FModelClass->update();
		return;
	}

	/**
	 * ModelController::actionIndex()
	 *
	 * @return
	 */
	public function actionIndex()
	{
		if (!Yii::app()->User->isAdmin)
		$this->redirect($this->createurl('admin/login'));
		$this->webMessage(Yii::t('FabModule.fab', 'Jump to add model'), Yii::app()->
		createUrl('/fab/admin'));
	}

	/**
	 * ModelController::actionLeftmenu()
	 *
	 * @return
	 */
	public function actionLeftmenu()
	{
		$_menu = array(Yii::t('FabModule.fab', 'Make Model') => array(Yii::t('FabModule.fab',
      'Create Model') => $this->createurl('create'), Yii::t('FabModule.fab',
      'List Model') => $this->createurl('list'), ), );
		$this->render('/common/leftmenu', array('menus' => $_menu));
	}

}
