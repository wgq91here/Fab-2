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
class Datatables_mypost extends Datatables
{
  var $ID;
  var $data;
  var $ajaxurl;
  var $viewfile = 'default';
  var $datatableDir;
  
  public function run()
  {
    $_init_js = <<<EOF
var oTable;
EOF;
    
		$_js_function = <<<EOF
    oTable = $('#datatables{$this->ID}').dataTable({
    "bAutoWidth": false,
    "aaSorting": [[ 0, "desc" ]],
		"sPaginationType": "full_numbers",
    "iDisplayLength": 15,
    "bProcessing": true,  
    "oLanguage": {
			"sLengthMenu": "每页 _MENU_ 条记录数 <a href='#' onclick='history.go(0);'>[刷新]</a>  <a href='#' onclick='history.go(0);'>[下载Excel]</a>",
			"sZeroRecords": "您没有递交过任何表单",
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
    $cs->registerScript('Datatables'.$this->ID,$_init_js,CClientScript::POS_END);
		$cs->registerScript('Datatables'.$this->ID,$_js_function,CClientScript::POS_READY);
        
    $this->render(
      'dt_mypost_'.$this->viewfile, 
      array(
        'ID'=>$this->ID, 
        'data'=>$this->data,
        'ajaxurl'=>$this->ajaxurl
        )
      );
  }
}