dp.sh.Brushes.Xml = function () {
    this.CssClass = "dp-xml";
    this.Style = ".dp-xml .cdata { color: #ff1493; }.dp-xml .tag, .dp-xml .tag-name { color: #069; font-weight: bold; }.dp-xml .attribute { color: red; }.dp-xml .attribute-value { color: blue; }"
};
dp.sh.Brushes.Xml.prototype = new dp.sh.Highlighter;
dp.sh.Brushes.Xml.Aliases = ["xml", "xhtml", "xslt", "html", "xhtml"];
dp.sh.Brushes.Xml.prototype.ProcessRegexList = function () {
    function c(d, e) {
        d[d.length] = e
    }

    var a = null, b = null;
    this.GetMatches(new RegExp("(&lt;|<)\\!\\[[\\w\\s]*?\\[(.|\\s)*?\\]\\](&gt;|>)", "gm"), "cdata");
    this.GetMatches(new RegExp("(&lt;|<)!--\\s*.*?\\s*--(&gt;|>)", "gm"), "comments");
    for (b = new RegExp("([:\\w-.]+)\\s*=\\s*(\".*?\"|'.*?'|\\w+)*|(\\w+)", "gm"); (a = b.exec(this.code)) != null;)if (a[1] != null) {
        c(this.matches, new dp.sh.Match(a[1], a.index, "attribute"));
        a[2] != undefined && c(this.matches, new dp.sh.Match(a[2],
            a.index + a[0].indexOf(a[2]), "attribute-value"))
    }
    this.GetMatches(new RegExp("(&lt;|<)/*\\?*(?!\\!)|/*\\?*(&gt;|>)", "gm"), "tag");
    for (b = new RegExp("(?:&lt;|<)/*\\?*\\s*([:\\w-.]+)", "gm"); (a = b.exec(this.code)) != null;)c(this.matches, new dp.sh.Match(a[1], a.index + a[0].indexOf(a[1]), "tag-name"))
};
