<?php

class Updateie extends CWidget
{
	public function run()
	{
	 
	 $cs = Yii::app()->getClientScript();
   
    //update ie6
    $updateIe6_js = <<<EOF
if($.browser.msie && $.browser.version == 6.0){
  var IE6toDead = $("<div id='IE6toDead'><span style='color:red;'>你使用的浏览器版本(Internet Explorer 6)，它存在非常多的漏洞，微软已不再支持。</span><br/><br/>请选择以下其他浏览器安装，并访问本站。<br/><br/><a href='http://www.google.com/chrome' target='blank'>[谷歌浏览器 推荐]</a> <a href='http://www.mozillaonline.com/' target='blank'>[火狐浏览器]</a> <a href='http://www.apple.com.cn/safari/download/' target='blank'>[苹果 safari]</a> <a href='http://www.microsoft.com/china/windows/internet-explorer/worldwide-sites.aspx' target='blank'>[Internet Explorer 8]</a> <a href='#' onclick='$(\"#IE6toDead\").hide();'>[关闭]</a></div>");
  IE6toDead.css('background-color','#E7E6E1');
  IE6toDead.css('color','#2E433E');
  IE6toDead.css('position','absolute');
  IE6toDead.css('z-index','9999');
  IE6toDead.css('height','50px');
  IE6toDead.css('width','500px');
  IE6toDead.css('font-weight','bold');  
  IE6toDead.css('text-align','center');
  IE6toDead.css('border','3px solid #BFCDBF');
  IE6toDead.css('padding','10px');
  IE6toDead.css('left',($(window).width() - 500)/2 +'px');
  IE6toDead.css('top',($(window).height() - 210)/2+'px');
  $('body').append(IE6toDead);
  $("#IE6toDead").show();
}else{
$("#IE6toDead").hide();
}
EOF;
    $cs->registerScript('IE6toDead',$updateIe6_js,CClientScript::POS_READY);
    
	}
}