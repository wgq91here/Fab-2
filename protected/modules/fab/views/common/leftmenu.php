<?php //var_dump($menus); ?>
<?php foreach ($menus as $key=>$menu) { ?>
<div class="leftmenu" style="display: block;">
	<h3><?php echo $key; ?></h3>
	<?php if (is_array($menu)) { ?>
		<ul>
		<?php foreach ($menu as $name=>$url) { ?>
			<li><a href="<?php echo $url; ?>"><?php echo $name; ?></a></li>
		<?php } ?>
		</ul>
	<?php } ?>
</div>
<?php } ?>

<div style="font-size:80%;text-align:center;"><?php $this->widget('fab.components.Usetime'); ?></div>

<SCRIPT LANGUAGE="JavaScript">
	$("div li a").attr("target","content_iframe");
	$("div li a").bind("click", function() {
		$("#selected_leftmenu").attr("id","no_selected_leftmenu");
		this.id = "selected_leftmenu";
		return ;
	});
	$('body').addClass('body_menu');

</SCRIPT>

</body>
</html>