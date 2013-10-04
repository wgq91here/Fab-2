<?php

class FormMenu extends CWidget
{
    public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
		/*
      $_js = <<<EOF
  $("#newFormMenu").click(function() {
	var p = $('#newFormMenu').position();
	$("#submenu").css('left',p.left + 3);
	$("#submenu").show();
  });
  $("#submenu").mouseleave(function() {
   $("#submenu").hide();
  });
EOF;
		$cs = Yii::app()->getClientScript();
		$cs->registerScript('FormMenu',$_js,CClientScript::POS_READY);

      
    $customUrl = Yii::app()->createurl("fab/model/create");
    $advanceUrl = Yii::app()->createurl("fab/model/advancecreate");
    $myformsUrl = Yii::app()->createurl("fab/model/myforms");
    $mypostsUrl = Yii::app()->createurl("fab/post/mine");

		$_js_function = <<<EOF
function customForm() {
  $.jqURL.loc('{$customUrl}');
  return ;
  }
function advanceForm() {
  $.jqURL.loc('{$advanceUrl}');
  return ;
  }
function myformsUrl() {
  $.jqURL.loc('{$myformsUrl}');
  return ;
  }
function mypostsUrl() {
  $.jqURL.loc('{$mypostsUrl}');
  return ;
  }
EOF;
		$cs = Yii::app()->getClientScript();
		$cs->registerScript('FormMenu',$_js_function,CClientScript::POS_BEGIN);
    */
        $this->render('FormMenu');
    }
}