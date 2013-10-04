function model_ajax(url, d) {
	$.ajax({
		url: url,
		beforeSend: function() { loadAjaxMessage('Loading...',0); },
		cache: true,
		type: "POST",
		data: d,
		dataType: "json",
		complete : function() {
			hideAjaxMessage(10);
		},
		success: function(data){
			if (data.error)
			{
				eval(data.html);
				return ;
			}
			add_model_field(data.id, data.data, data.field, data.tool);
		}
		});
}

function Field_add_data(id, data)
{
	jQuery.data(document.body , id, data);
}

function Field_update_data(id,key,value)
{
	t = Field_get_data(id);
	t[key] = value;
  //alert( JSON.stringify( jQuery.data( document.body, id) ));
	jQuery.data(document.body , id, t);
}

function Field_remove_data(id)
{
	jQuery.removeData(document.body , id );
}

function Field_get_data(id)
{
	return jQuery.data(document.body , id);
}

var fieldSort = 1;

function add_model_field(id, data, field, tool)
{
	$("#modelContent ul.ui-sortable").append(field);
  $("#"+id).fadeIn(500);
  
	$("#"+id).mouseleave(function() { 
		$('.modelfield').removeClass('fouceclickfield');
		//$('.fieldtool').fadeOut('slow');
		});

      
	new_tool = $('<div id="'+id+'_tool" style="display:none;"></div>');
	//$("#fieldcontent").append(new_tool);
  
	new_tool.addClass('fieldtool');
	//new_tool.addClass('grid_10');
	//new_tool.css('left',screenWidth*0.66);
	//new_tool.width($("#fieldmenu").width());
	new_tool.hide();
	new_tool.html(tool);

    
  // add finish button & event
  var finishDiv = $("<div onclick=\"finishField('"+id+"');\">[OK]</div>");
  finishDiv.css('padding-top','3px');
  finishDiv.css('color','green');
  finishDiv.css('font-weight','bold');
  new_tool.append(finishDiv);  
  
  $("#"+id).append(new_tool);

	data['sort'] = fieldSort++;
	$("#sortTitle_"+id).html(data['sort']);
  
	Field_add_data(id, data);

	// Jump to bottom
	$('#wrapper').animate({scrollTop:$('#wrapperfooter').offset().top}, 'slow');
}

function finishField(id)
{
  $("#"+id+' .fieldtool').fadeOut('slow');
}

function showfieldmodels()
{
	//hidetools();
  //alert($("#addField").parent().css('top'));
  //$('#fieldmenu').css('top',$("#addField").parent().css('top'));
  //$('#fieldmenu').css('left','10'+$("#addField").parent().css('left'));
	$('#fieldmenu').show(10);
}

function hidefieldmodels()
{
	$('#fieldmenu').hide(10);
}

function fadeOutfieldmodels()
{
	$('#fieldmenu').animate({"opacity":"0.4"});
}

function fadeInfieldmodels()
{
	$('#fieldmenu').animate({"opacity":"1"});
}

function hidefieldmodels()
{
	$('#fieldmenu').hide(10);
}

function hidetools()
{
	$('.fieldtool').hide();
	$('#fieldtool').hide();
}

function remove_fields(fieldId)
{
	hidetools();
	Field_remove_data(fieldId);
	$('#'+fieldId).remove();
	FieldSort();
}

function showtool_fields(fieldId, typeID, url)
{
	// 判断此字段是否存在
	if ($('#'+fieldId).html() == null)
	{
		return ;
	}

	var toolid = $('#'+fieldId+"_tool");
  //alert(toolid.css('display'));
  if (toolid.css('display') == 'block' || toolid.css('display') == null ) {
    return ;
  }
	// 隐含其它工具窗口
	//hidefieldmodels();
	hidetools();

	$('.modelfield').removeClass('foucemouseoverfield');
	$('.modelfield').removeClass('fouceclickfield');

	// 定位工具栏位置
	var fid = $('#'+fieldId);
	fid.addClass('fouceclickfield');
	var field = fid.offset();

	toolid.css('top',field.top);
	/*
	alert(field.top);
	alert($("#myscreen").height());
	alert($("#myscreen").height() - field.top);
	if (($("#myscreen").height() - field.top) > 100)
	{
		$("#myscreen").height($("#myscreen").height()+100);
	}
	*/
	toolid.fadeTo('slow', 1);



  //var ff = eval(typeID+ '_onshow');
  //alert(ff);

  //alert(jQuery.isFunction(simpletext_onshow));
  //alert(jQuery.isFunction(eval(typeID+ '_onshow')));
  
  if ( jQuery.isFunction(eval(typeID+ '_onshow')) ) {
    eval(typeID + '_onshow("'+fieldId+'")');
    //alert(f);
    //eval(f);
  }
	//toolid.show(10);
}

function copy_fields(fieldId)
{
	alert(fieldId);
}

function changeLabel(fieldId,value)
{
	$("#"+fieldId + "_title").html(value);
	Field_update_data(fieldId, 'Label', value);
}

function logField(fieldId)
{
	var filedIdAll = "";
	if (!(typeof(Field_get_data(fieldId)) === 'object'))
	{
		alert(fieldId + ' is null!');
		return ;
	}
	//var encoded = $.toJSON(ModelFieldData[fieldId]['data']); 
	//console.log("Model Fields Serialize: ",encoded);
	//var filedIdAll = JSON.stringify(ModelFieldData);

/*
$.each(
	ModelFields,
	function( intIndex, objValue ){
		FieldJSON =JSON.stringify(ModelFieldData[objValue]['data']) + "\n";
		filedIdAll = filedIdAll  + objValue + ":" + FieldJSON;
	}
);
*/
	//alert($("#sortable").sortable("toArray"));

	//alert(filedIdAll);
	alert( JSON.stringify( jQuery.data( document.body) ));

}

function FieldSort()
{
	//console.log("Reset Sort: ");
	var fieldSort = 0;
	$('.modelfield').each(function(value) {
		//console.log(fieldSort +":"+ $(this).attr('id'));
		fieldSort = fieldSort + 1;
		Field_update_data($(this).attr('id'), 'sort', fieldSort);
		$("#sortTitle_"+$(this).attr('id')).html(fieldSort);
	});
	//console.log("===============");
}

function CloseModelPreview() {
  $("#ajaxDiv a").remove();
  $("#ajaxDiv iframe").remove();
  $("#ajaxDiv").remove();
  $("#hideDiv").remove();
  $('body').css('overflow','auto');
}

// 将数据归入表单中
function _modelData() {
  $("#FAttr_Data").val(JSON.stringify( jQuery.data( document.body) ));
  return ;
}

function modelFinish(url) {
	_modelData();
	$('#FormAttr').attr('action',url);
	$('#FormAttr').submit();
	return ;
}

function modelPreview(url) {
	_modelData();
	$('#FormAttr').attr('action',url);
	$('#FormAttr').attr('target','FabPreview');
	$('#FormAttr').submit();
	return ;
}

function modelSave(url) {
	$("#ajaxstatus").show();
	$("#ajaxstatus").html('Saving...');

	_modelData();

	$('#FormAttr').attr('action',url);
	$('#FormAttr').attr('target','');

	var options = { 
		url: url, 
		dataType: 'script',
		success: function(scripts) { 
			//alert( "Data Saved: " + scripts );
		} 
	}; 
	 
	$('#FormAttr').ajaxSubmit(options);

}

function resiztewrapper() {
  var wrapperHeight = $(window).height() - $("#navigation").height() - $(".gutter").height() - $("#footer").height() - 60 ;
  loadAjaxMessage(wrapperHeight + ":" + $("#navigation").height() + ":"  + $(".gutter").height(),2000);
  $("#wrapper").height(wrapperHeight);
}

$(function() {
		$("#sortable").sortable({
		   update: function(event, ui) {FieldSort();}
		});
		$("#sortable").disableSelection();

    var resizeTimer = null;
    resiztewrapper();
    $(window).bind('resize', function() {
        if (resizeTimer) clearTimeout(resizeTimer);
            resizeTimer = setTimeout(resiztewrapper, 100);
    });

});