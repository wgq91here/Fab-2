<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <title><?php echo $this->pageTitle; ?>&nbsp;<?php echo Yii::app()->controller->module->siteName; ?></title>
</head>
<style>
    html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, code, del, dfn, em, img, q, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {
        margin: 0;
        padding: 0;
        border: 0;
        font-weight: inherit;
        font-style: inherit;
        font-size: 100%;
        font-family: Tahoma;
        vertical-align: baseline;
    }

    body {
        line-height: 1.5;
    }

    table {
        border-collapse: separate;
        border-spacing: 0;
    }

    caption, th, td {
        text-align: left;
        font-weight: normal;
    }

    table, td, th {
        vertical-align: middle;
    }

    blockquote:before, blockquote:after, q:before, q:after {
        content: "";
    }

    blockquote, q {
        quotes: "" "";
    }

    a img {
        border: none;
    }

    a {
        color: black
    }

    a:link {
        text-decoration: none
    }

    a:visited {
        text-decoration: none
    }

    a:active {
        text-decoration: none
    }

    a:hover {
        text-decoration: underline
    }

    a.title {
        font-weight: bold;
    }

    body {
        font-size: 75%;
        color: #222;
        background: #fff;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    body {
        margin: 0;
    }
</style>

<body class="body_adminpage" style="text-align:center;">

<center>
    <div style="width:350px;padding:5px;background-color: #808080;color:white;margin-top: 10%;font-weight:bold;">提示窗口
    </div>
    <div style="width:350px;border-bottom:2px solid #8F8F8F; padding:10px;background-color: white;text-align: left;">
        <table width="100%">
            <tr>
                <td style="text-align:left;" id="message"><?php echo $message; ?>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:right;padding-right:10px;" id="doit">

                    <a href="javascript:void(null);" onclick="jumpurl();">[确定]</a>&nbsp;


                </td>
            </tr>
        </table>
    </div>
</center>

<SCRIPT LANGUAGE="JavaScript">
    <!--
    function jumpurl() {
        window.location.href = '<?php echo $url?$url:Yii::app()->homeurl; ?>';
    }
    <?php if ($second>0) { ?>
    setTimeout("jumpurl()", <?php echo isset($second)?$second:1000; ?>);
    <?php }	?>
    //-->
</SCRIPT>

</body>
</html>