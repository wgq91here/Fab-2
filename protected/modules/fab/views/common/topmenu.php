<table height="60" width="100%" cellspacing="0" style="border-bottom:3px #112233 solid;">
<tr>
	<td colspan="2" height="48" style="padding-left:55px;">
		<div style="float: right;padding-right:20px;">欢迎, <?php echo Yii::app()->user->username; ?>&nbsp;&nbsp;
			&nbsp;<a href="{:$_F['urlPath']}{:$_F['adminFilename']}/MySetting" target="content_iframe" style="color:white;">[设置]</a>
			&nbsp;<a href="<?php echo $this->createurl('/fab/admin/logout'); ?>" target="_top" style="color:white;">[退出]</a>
		</div>
		<span style="font-size:18px;"><B><?php echo CHtml::encode(Yii::app()->name); ?>&nbsp;-&nbsp;<?php echo Yii::app()->controller->module->siteName; ?></B></span>
	</td>
<TR>	
	<td height="30" width="200" style="text-align:center;"><A HREF="#" onclick="self.parent.close_left_iframe(this);" id="sideswitch" class="closeside"><?php echo Yii::t('FabModule.fab', 'Close Left Menu.'); ?></A></td>
	<TD>	

<div id="topmenu">
<ul>
	<li id="selected_topmenu"><A HREF="<?php echo $this->createurl('/fab/help/leftmenu'); ?>" target="left_iframe">Fabcms帮助</A></li>
	<?php
	foreach ($menus as $name=>$url) { ?>
	<li id="no_selected_topmenu"><a href="<?php echo $url;?>" target="left_iframe">
	<?php echo $name; ?></a>
	</li>
	<?php } ?>
</ul>
</div>

</TD>
</TR>
</TABLE>

<SCRIPT LANGUAGE="JavaScript">
	$("div li a").attr("target","left_iframe");

	$("div li").bind("click", function() {
		$("#selected_topmenu").attr("id","no_selected_topmenu");
		this.id = "selected_topmenu";
		return ;
	});
	$('body').addClass('body_topmenu');
</SCRIPT>

</BODY>
</HTML>