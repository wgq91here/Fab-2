<?php

/**
 * Datatables
 *
 * @package fab
 * @author Fabcms wwwwgq
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class Datatables_post extends Datatables
{
    var $ID;
    var $data;
    var $fields;
    var $ajaxurl;
    var $viewfile = 'default';
    var $datatableDir;

    var $fields_num = 3;

    public function run()
    {
        $firstRecord = current($this->data);
        $ReLoadUrl = CHtml::button(Yii::t('FabModule.fab', 'Reload'), array('onclick' => 'history.go(0);'));
        $EmptyFormButton = CHtml::button(Yii::t('FabModule.fab', 'Empty'), array('onclick' => "EmptyFormData_{$this->ID}();"));
        $EmptyFormUrl = Yii::app()->createurl('/fab/post/empty', array('id' => $firstRecord['mid']));
        $ExportExcelFormUrl = CHtml::button(Yii::t('FabModule.fab', 'Export Excel'), array('onclick' => 'window.open("' . Yii::app()->createurl('/fab/post/exportexcel', array('id' => $firstRecord['mid'])) . '");'));

        $_init_js = <<<EOF
var oTable;
    function EmptyFormData_{$this->ID}()
    {
      var answer = confirm("删除全部已递交表单数据吗？(无法恢复)");
      if (answer) {
        $.ajax({
        		url: '{$EmptyFormUrl}',
        		beforeSend: function() { loadAjaxMessage('Delete...',0); },
        		type: "POST",
            data: ({id:'{$firstRecord['mid']}'}),
        		dataType: "json",
        		complete : function() {
        			hideAjaxMessage(10);
        		},
        		success: function(data){
        			eval(data.html);
        		}
        		});        
      }
    }   
EOF;

        $_js_function = <<<EOF
    oTable = $('#datatables{$this->ID}').dataTable({
    "bAutoWidth": false,
    "aaSorting": [[ 0, "desc" ]],
		"sPaginationType": "full_numbers",
    "iDisplayLength": 15,
    "bProcessing": true,  
    "oLanguage": {
			"sLengthMenu": '每页 _MENU_ 条记录数 {$ReLoadUrl}  {$EmptyFormButton}  {$ExportExcelFormUrl}',
			"sZeroRecords": "此表单还没有任何人填写过",
			"sInfo": "从 _START_ 到 _END_ 共 _TOTAL_ 记录",
			"sInfoEmpty": "未查询找到任何记录",
			"sInfoFiltered": "(filtered from _MAX_ total records)",
      "sSearch": "搜索:",
      "oPaginate": {
        "sFirst": "首页",
        "sLast": "最后页",
        "sNext": "下一页",
        "sPrevious": "前一页"
      }
		}
	   });
    $('#datatables{$this->ID}').css('margin-top','5px');
    $('#datatables{$this->ID}').css('margin-bottom','5px');
    $('#datatables{$this->ID}').css('border-bottom','1px solid #A19B9E');
    $('#datatables{$this->ID}').css('width','100%');
    
    $('#datatables{$this->ID}_wrapper').css('margin-top','16px');
    $('#datatables{$this->ID}_wrapper').css('margin-bottom','30px');
    
 
EOF;
        $cs = Yii::app()->getClientScript();
        $cs->registerScript('Datatables' . $this->ID, $_init_js, CClientScript::POS_END);
        $cs->registerScript('Datatables' . $this->ID, $_js_function, CClientScript::POS_READY);

        $this->render(
            'dt_post_' . $this->viewfile,
            array(
                'ID' => $this->ID,
                'data' => $this->data,
                'fields' => array_slice($this->fields, 0, $this->fields_num),
                'ajaxurl' => $this->ajaxurl
            )
        );
    }
}