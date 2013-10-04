<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <TITLE><?php echo $this->pageTitle; ?>&nbsp;<?php echo Yii::app()->controller->module->siteName; ?></TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <META NAME="Author" CONTENT="wwwwgq">
    <META NAME="Keywords" CONTENT="Fabcms">
    <script type="text/javascript">
        <!--

        function close_left_iframe(linkobject) {
            var ciFrame = window.parent.document.getElementById('ciframe');
            if (ciFrame.cols == '0,*') {
                ciFrame.cols = '200,*';
                linkobject.innerHTML = "关闭侧栏";
                linkobject.className = 'opened';
            } else {
                ciFrame.cols = '0,*';
                linkobject.innerHTML = '打开侧栏';
                linkobject.className = 'closed';
            }

            //alert($(window.frames["topmenu_iframe"].document).find("a:first").html());

        }

        function iframeContentURL(_url) {
            var ciFrame = window.parent.document.getElementById('content_iframe');
            ciFrame.src = _url;
        }

        function iframeLeftURL(_url) {
            var ciFrame = window.parent.document.getElementById('left_iframe');
            ciFrame.src = _url;
        }

        //-->
    </script>
</HEAD>

<frameset rows="80,*" frameborder="0" border="0">

    <frame noresize="noresize" src="<?php echo Yii::app()->createurl('/fab/admin/topmenu'); ?>" name="topmenu_iframe"
           id="topmenu_iframe" scrolling="NO">

    <frameset cols="200,*" frameborder="0" name="ciframe" id="ciframe">
        <frame noresize="noresize" src="<?php echo Yii::app()->createurl('/fab/help/leftmenu'); ?>" name="left_iframe"
               id="left_iframe" scrolling="scroll" style="overflow-x: hidden;">
        <frame noresize="noresize" src="<?php echo $content; ?>" name="content_iframe" id="content_iframe"
               scrolling="scroll" style="overflow-x: hidden;">
    </frameset>

</frameset>

</HTML>