<?php
//此程序为UBB模式下的服务端显示测试程序
header('Content-Type: text/html; charset=utf-8');
require_once '../serverscript/php/ubb2html.php';
$sHtml = ubb2html($_POST['elm1']);//htmlspecialchars
function showCode($match)
{
    $match[1] = strtolower($match[1]);
    if (!$match[1]) $match[1] = 'plain';
    $match[2] = preg_replace("/</", '&lt;', $match[2]);
    $match[2] = preg_replace("/>/", '&gt;', $match[2]);
    return '<pre name="code" class="' . $match[1] . '">' . $match[2] . '</pre>';
}
$sHtml = preg_replace_callback('/\[code\s*(?:=\s*((?:(?!")[\s\S])+?)(?:"[\s\S]*?)?)?\]([\s\S]*?)\[\/code\]/i', 'showCode', $sHtml);
function showFlv($match)
{
    $w = $match[1];
    $h = $match[2];
    $url = $match[3];
    if (!$w) $w = 480;
    if (!$h) $h = 400;
    return '<embed type="application/x-shockwave-flash" src="mediaplayer/player.swf" wmode="transparent" allowscriptaccess="always" allowfullscreen="true" quality="high" bgcolor="#ffffff" width="' . $w . '" height="' . $h . '" flashvars="file=' . $url . '" />';
}
$sHtml = preg_replace_callback('/\[flv\s*(?:=\s*(\d+)\s*,\s*(\d+)\s*)?\]\s*(((?!")[\s\S])+?)(?:"[\s\S]*?)?\s*\[\/flv\]/i', 'showFlv', $sHtml);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>UBB文章显示测试页</title>
    <style type="text/css">
        body {
            margin: 5px;
            border: 2px solid #ccc;
            padding: 5px;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/SyntaxHighlighter.css"/>
    <script type="text/javascript" src="syntaxhighlighter/shCore.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushXml.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushJScript.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushCss.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushPhp.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushCSharp.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushCpp.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushJava.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushPython.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushRuby.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushVb.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushDelphi.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushSql.js"></script>
    <script type="text/javascript" src="syntaxhighlighter/shBrushPlain.js"></script>
    <script type="text/javascript">
        window.onload = function () {
            dp.SyntaxHighlighter.HighlightAll('code');
        }
    </script>
<body>
<?php echo $sHtml ?>
</body>
</html>