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
class Datatables_model extends Datatables
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
        $createFormUrl = CHtml::link('建立表单', Yii::app()->createurl("/fab/model/advancecreate"));

        $_js_function = <<<EOF
    
			jQuery.fn.dataTableExt.oSort['numeric-comma-asc']  = function(a,b) {
				var x = (a == "-") ? 0 : a.replace( /,/, "." );
				var y = (b == "-") ? 0 : b.replace( /,/, "." );
				x = parseFloat( x );
				y = parseFloat( y );
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['numeric-comma-desc'] = function(a,b) {
				var x = (a == "-") ? 0 : a.replace( /,/, "." );
				var y = (b == "-") ? 0 : b.replace( /,/, "." );
				x = parseFloat( x );
				y = parseFloat( y );
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};
          
    oTable = $('#datatables{$this->ID}').dataTable({
    "bAutoWidth": false,
    "aaSorting": [[ 0, "desc" ]],
    "aoColumns": [      
      null,
      { "sType": "html" },
      { "sType": "html" },
      null,
      { "bSortable": false },
      { "bSortable": false },
      { "bSortable": false }
      ],
		"sPaginationType": "full_numbers",
    "iDisplayLength": 15,
    "bProcessing": true,  
    "oLanguage": {
			"sLengthMenu": "每页 _MENU_ 条记录数",
			"sZeroRecords": '未找到您创建的任何表单，请{$createFormUrl}',
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

        $this->render('dt_' . $this->viewfile,
            array('ID' => $this->ID, 'data' => $this->data, 'ajaxurl' => $this->ajaxurl)
        );
    }
}