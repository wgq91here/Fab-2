<style type="text/css">
  #sortable {
    list-style-type: none;
  }

  body {
    /* background: url("<?php echo FController::getAssetImagePath(); ?>bg.png");
    background-repeat:repeat-y;*/
  }

  .modelfield {
    margin-bottom: 8px;
    margin-left: 10px;
    padding:10px;
    border: 2px solid #E0E0E0;
    height: auto;
  }

  .fieldtools {
    position: relative;
    text-align: right;
    width: 80px;
    left: 80%;
    top: -5px;
    height: 20px;
  }

  .fieldcontent {
    margin-top: -20px;
  }

  .fieldcontent span {
    font-weight:bold;
}

  .foucemouseoverfield {
    border: 2px dashed #B3B2B4;
  }

  .fouceclickfield {
    border: 1px dashed #B3B2B4;
  }

  .ftool {
    /* background:url("<?php echo FController::getAssetImagePath(); ?>fieldstoolbg.png") no-repeat scroll center top transparent; */
   margin-top:3px;
   padding-bottom: 5px;
    display: none;
    border: 1px solid #C8C8C8;
    position:absolute;
    top:113px;
  }

  #fieldtool {
    /* position: absolute;
    overflow: hidden; */
    background-color: yellow;
    border: 2px solid #B3B2B4;
  }

  .fieldtool {
    margin-top: 10px;
    padding: 5px;
    /* position: absolute;
    overflow: hidden; */
    background-color: #F7F7F7;
    border-top: 1px solid #96B710;
  }

  .addField {
    padding-top: 5px;
  }

  fieldset {
    border:1px solid #CCCCCC;
  }

  fieldset legend {
    font-weight: bold;
    padding: 0 5px 0 5px;
  }

  fieldset.choices {
    padding: 8px;
  }

  #modelContent ul {
    list-style: none outside none;
  }

  /*
  .buttons #saveField span {
background-image: url('<?php //echo FController::getAssetImagePath(); ?>2008070304-01.png');
background-position: -477px -3px;
padding-left:16px;
margin:0 5px -3px 0 !important;
}

  .buttons #previewField span {
background-image: url('<?php //echo FController::getAssetImagePath(); ?>2008070304-01.png');
background-position: -377px -88px;
padding-left:16px;
margin-right:5px;
}

  .buttons #submitField span {
background-image: url('<?php // echo FController::getAssetImagePath(); ?>2008070304-01.png');
background-position: -341px -53px;
padding-left:16px;
margin-right:5px;
}
*/

#submenu {
background-color: #DFDFDF;
position:absolute;
top:112px;
display:none;
padding:3px;
border-bottom:1px solid #C9C9C9;
border-left:1px solid #C9C9C9;
border-right:1px solid #C9C9C9;
}

#submenu a {
	font-weight:normal;
	color:black;
}

#submenu a:hover {
	font-weight:bold;
	color:#336699;
}
</style>

  <div id="navigation">
    <div class="container_24" style="height:25px;padding-top:5px;">
	<div class="grid_20">
    
<div style="text-align:left;padding-right: 5px;">
  <?php
		$this->widget('fab.components.FormMenu');
		?>
</div>

    </div>

	<div class="grid_4">
      <div style="text-align:right;padding-right: 5px;">
      <?php echo CHtml::link('表单属性','javascript:void(null);',array('id'=>'attrField','class'=>'button wide')); ?>
      <?php echo CHtml::link('表单控件','javascript:void(null);',array('id'=>'addField','class'=>'button wide')); ?>
      </div>
	</div>

	</div>

	<div class="clear"></div>

  </div>

  <div id="wrapper" style="overflow: auto;">
    <div class="container_24">

<div id="fieldtool" style="display:none;">fieldtool</div>

<div id="modelContent" class="grid_14">
  <div style="padding:6px;margin-top:5px;background-color:yellow;">
  递交地址: <strong><?php echo 'http://'.$_SERVER['HTTP_HOST'].Yii::app()->createUrl('fab/model/submit',array('id'=>$_Form_UniqueId)); ?></strong>
  </div>
  <div style="height:30px;padding:3px;font-size:14px;margin-top: 8px;">
    <div style="display:none;" id="FormTitleDIV">
    <?php echo CHtml::TextField('FormTitle',$FAttr->FormTitle,array('style'=>'font-size:14px;width:90%;'));?>
    <?php echo CHtml::button('OK',array('onclick'=>"FormTitleFinish();")); ?>
    </div>
    <span id="Formtitle_lable" onclick="$(this).hide();$('#FormTitleDIV').show();" style="font-weight:bold;"></span>
  </div>
  <ul id="sortable"></ul>
   <hr/>
  <div class="buttons">
      <?php echo CHtml::link(CHtml::image(FController::getAssetImagePath().'preview_button.png').' 预览表单','javascript:void(null);',array('onclick'=>'modelPreview("'.$_previewUrl.'");','id'=>'previewField','class'=>'button wide')); ?>
      <?php echo CHtml::link(CHtml::image(FController::getAssetImagePath().'save_button.png').'保存表单','javascript:void(null);',array('onclick'=>'modelSave("'.$_saveUrl.'");','id'=>'saveField','class'=>'button wide')); ?>
      <?php echo CHtml::link(CHtml::image(FController::getAssetImagePath().'submit_button.png').'完成表单','javascript:void(null);',array('onclick'=>'modelFinish("'.$_submitUrl.'");','id'=>'submitField','class'=>'button wide')); ?>
  </div>
</div>

<div id="fieldcontent" class="grid_10">
  
  <div id="attrtool" class="ftool grid_10">

    <div style="padding:3px 8px;color:white;height:20px;background-color: #5B5B5B;">
      表单属性 - </div>
    <div style="padding:10px;" class="buttons">
            <?php
            $FAttr->UniqueId = $_Form_UniqueId;
            echo CHtml::beginForm('','post',array('id'=>'FormAttr'));

            echo CHtml::activeLabel($FAttr,'postID',array('style'=>'font-weight:bold;')).":<br/>";
            echo CHtml::activeRadioButtonList($FAttr, 'postID', $FAttr->postOptions,$FAttr->postHtmlOptions);

            echo CHtml::openTag("div",array("id"=>"postPasswordDiv","style"=>"display:none;padding:6px 0 3px 10px;"));
            echo CHtml::activeLabel($FAttr,'postPassword',array('style'=>'font-weight:bold;')).": ";
            echo CHtml::activeTextField($FAttr, 'postPassword',array("style"=>"font-size:11px;width:60px;","maxlength"=>"20"));
            echo CHtml::closeTag("div");

            echo '<hr/>';
            echo CHtml::activeLabel($FAttr,'themeID',array('style'=>'font-weight:bold;')).":<br/>";
            echo CHtml::activeRadioButtonList($FAttr, 'themeID', $FAttr->themeOptions);

            echo CHtml::activeHiddenField($FAttr, 'Data');
            echo CHtml::activeHiddenField($FAttr, 'FormTitle');
            echo CHtml::activeHiddenField($FAttr, 'UniqueId');
            echo CHtml::endForm();
            ?>
    </div>
  </div>

  <div id="fieldmenu" class="ftool grid_10">
    <div style="padding:3px 8px;color:white;height:20px;background-color: #5B5B5B;">
      表单控件 - <?php echo Yii::t('FabModule.fab','Click to Add a Field');?></div>
    <div style="padding:10px;" class="buttons">
      您可以选择表单。
	  <hr/>
    <ul style="">
      <?php foreach ($fieldModels as $field): ?>
      <LI style="float: left;margin-bottom: 5px; cursor: pointer;text-align:left;" class='button wide' onclick="model_ajax('<?php echo $this->createurl('loadfield',array('ajax'=>true,'modelFieldType'=>$field['nameID'])); ?>');">
          <?php echo CHtml::image(FController::getAssetImagePath().$field['nameID'].'.png','',array('width'=>'18','height'=>'18')); ?>
		      <?php echo $field['name']; ?>
      </LI>
      <?php endforeach; ?>
    </ul>
    
    </div>
      
  </div>
  
  
</div>      
      <div class="clear" id="wrapperfooter"></div>
      <div style="height:30px;">&nbsp;</div>
    </div>
  </div>


<SCRIPT type="text/javascript" LANGUAGE="JavaScript">
  <!--

  $("#attrField").mousemove(function() {
    hidefieldmodels();
    $("#wizardtool").hide();
    $("#attrtool").show();
  });

  $("#wizardField").mousemove(function() {
    hidefieldmodels();
    $("#attrtool").hide();
    $("#wizardtool").show();
  });

  $("#addField").mouseover(function() {
    loadAjaxMessage($("#wrapper").scrollTop());
    $("#wizardtool").hide();
    $("#attrtool").hide();
    showfieldmodels();
  });


  $('#Formtitle_lable').html($("#FAttr_FormTitle").val());

  function FormTitleFinish() {
   $('#FormTitleDIV').hide();
   $('#FAttr_FormTitle').val($('#FormTitle').val());
   $('#Formtitle_lable').html($('#FormTitle').val());
   $('#Formtitle_lable').show();
  }
  
  // ---------------------

  $("#fieldmenu").show();
  
  <?php if (!$_updateFields) { ?>
  model_ajax('<?php echo $this->createurl('loadfield',array('ajax'=>true,'modelFieldType'=>'simpletext')); ?>');
  <?php } ?>
  
  //-->
</SCRIPT>