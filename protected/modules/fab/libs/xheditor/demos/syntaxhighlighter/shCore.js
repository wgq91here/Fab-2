var a, dp = {sh: {Toolbar: {}, Utils: {}, RegexLib: {}, Brushes: {}, Strings: {AboutDialog: '<html><head><title>About...</title></head><body class="dp-about"><table cellspacing="0"><tr><td class="copy"><p class="title">dp.SyntaxHighlighter</div><div class="para">Version: {V}</p><p><a href="http://www.dreamprojections.com/syntaxhighlighter/?ref=about" target="_blank">http://www.dreamprojections.com/syntaxhighlighter</a></p>&copy;2004-2007 Alex Gorbatchev.</td></tr><tr><td class="footer"><input type="button" class="close" value="OK" onClick="window.close()"/></td></tr></table></body></html>'},
    ClipboardSwf: null, Version: "1.5.1"}};
dp.SyntaxHighlighter = dp.sh;
dp.sh.Toolbar.Commands = {ExpandSource: {label: "+ expand source", check: function (b) {
    return b.collapse
}, func: function (b, c) {
    b.parentNode.removeChild(b);
    c.div.className = c.div.className.replace("collapsed", "")
}}, ViewSource: {label: "view plain", func: function (b, c) {
    b = dp.sh.Utils.FixForBlogger(c.originalCode).replace(/</g, "&lt;");
    c = window.open("", "_blank", "width=750, height=400, location=0, resizable=1, menubar=0, scrollbars=0");
    c.document.write('<textarea style="width:99%;height:99%">' + b + "</textarea>");
    c.document.close()
}},
    CopyToClipboard: {label: "copy to clipboard", check: function () {
        return window.clipboardData != null || dp.sh.ClipboardSwf != null
    }, func: function (b, c) {
        b = dp.sh.Utils.FixForBlogger(c.originalCode).replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&");
        if (window.clipboardData)window.clipboardData.setData("text", b); else if (dp.sh.ClipboardSwf != null) {
            var d = c.flashCopier;
            if (d == null) {
                d = document.createElement("div");
                c.flashCopier = d;
                c.div.appendChild(d)
            }
            d.innerHTML = '<embed src="' + dp.sh.ClipboardSwf + '" FlashVars="clipboard=' +
                encodeURIComponent(b) + '" width="0" height="0" type="application/x-shockwave-flash"></embed>'
        }
        alert("The code is in your clipboard now")
    }}, PrintSource: {label: "print", func: function (b, c) {
        b = document.createElement("IFRAME");
        var d = null;
        b.style.cssText = "position:absolute;width:0px;height:0px;left:-500px;top:-500px;";
        document.body.appendChild(b);
        d = b.contentWindow.document;
        dp.sh.Utils.CopyStyles(d, window.document);
        d.write('<div class="' + c.div.className.replace("collapsed", "") + ' printing">' + c.div.innerHTML +
            "</div>");
        d.close();
        b.contentWindow.focus();
        b.contentWindow.print();
        alert("Printing...");
        document.body.removeChild(b)
    }}, About: {label: "?", func: function () {
        var b = window.open("", "_blank", "dialog,width=300,height=150,scrollbars=0"), c = b.document;
        dp.sh.Utils.CopyStyles(c, window.document);
        c.write(dp.sh.Strings.AboutDialog.replace("{V}", dp.sh.Version));
        c.close();
        b.focus()
    }}};
dp.sh.Toolbar.Create = function (b) {
    var c = document.createElement("DIV");
    c.className = "tools";
    for (var d in dp.sh.Toolbar.Commands) {
        var f = dp.sh.Toolbar.Commands[d];
        f.check != null && !f.check(b) || (c.innerHTML += '<a href="#" onclick="dp.sh.Toolbar.Command(\'' + d + "',this);return false;\">" + f.label + "</a>")
    }
    return c
};
dp.sh.Toolbar.Command = function (b, c) {
    for (var d = c; d != null && d.className.indexOf("dp-highlighter") == -1;)d = d.parentNode;
    d != null && dp.sh.Toolbar.Commands[b].func(c, d.highlighter)
};
dp.sh.Utils.CopyStyles = function (b, c) {
    c = c.getElementsByTagName("link");
    for (var d = 0; d < c.length; d++)c[d].rel.toLowerCase() == "stylesheet" && b.write('<link type="text/css" rel="stylesheet" href="' + c[d].href + '"></link>')
};
dp.sh.Utils.FixForBlogger = function (b) {
    return dp.sh.isBloggerMode == true ? b.replace(/<br\s*\/?>|&lt;br\s*\/?&gt;/gi, "\n") : b
};
dp.sh.RegexLib = {MultiLineCComments: new RegExp("/\\*[\\s\\S]*?\\*/", "gm"), SingleLineCComments: new RegExp("//.*$", "gm"), SingleLinePerlComments: new RegExp("#.*$", "gm"), DoubleQuotedString: new RegExp('"(?:\\.|(\\\\\\")|[^\\""\\n])*"', "g"), SingleQuotedString: new RegExp("'(?:\\.|(\\\\\\')|[^\\''\\n])*'", "g")};
dp.sh.Match = function (b, c, d) {
    this.value = b;
    this.index = c;
    this.length = b.length;
    this.css = d
};
dp.sh.Highlighter = function () {
    this.noGutter = false;
    this.addControls = true;
    this.collapse = false;
    this.tabsToSpaces = true;
    this.wrapColumn = 80;
    this.showColumns = true
};
dp.sh.Highlighter.SortCallback = function (b, c) {
    if (b.index < c.index)return-1; else if (b.index > c.index)return 1; else if (b.length < c.length)return-1; else if (b.length > c.length)return 1;
    return 0
};
a = dp.sh.Highlighter.prototype;
a.CreateElement = function (b) {
    b = document.createElement(b);
    b.highlighter = this;
    return b
};
a.GetMatches = function (b, c) {
    for (var d = null; (d = b.exec(this.code)) != null;)this.matches[this.matches.length] = new dp.sh.Match(d[0], d.index, c)
};
a.AddBit = function (b, c) {
    if (!(b == null || b.length == 0)) {
        var d = this.CreateElement("SPAN");
        b = b.replace(/ /g, "&nbsp;");
        b = b.replace(/</g, "&lt;");
        b = b.replace(/\n/gm, "&nbsp;<br>");
        if (c != null)if (/br/gi.test(b)) {
            b = b.split("&nbsp;<br>");
            for (var f = 0; f < b.length; f++) {
                d = this.CreateElement("SPAN");
                d.className = c;
                d.innerHTML = b[f];
                this.div.appendChild(d);
                f + 1 < b.length && this.div.appendChild(this.CreateElement("BR"))
            }
        } else {
            d.className = c;
            d.innerHTML = b;
            this.div.appendChild(d)
        } else {
            d.innerHTML = b;
            this.div.appendChild(d)
        }
    }
};
a.IsInside = function (b) {
    if (b == null || b.length == 0)return false;
    for (var c = 0; c < this.matches.length; c++) {
        var d = this.matches[c];
        if (d != null)if (b.index > d.index && b.index < d.index + d.length)return true
    }
    return false
};
a.ProcessRegexList = function () {
    for (var b = 0; b < this.regexList.length; b++)this.GetMatches(this.regexList[b].regex, this.regexList[b].css)
};
a.ProcessSmartTabs = function (b) {
    function c(h, e, l) {
        var m = h.substr(0, e);
        h = h.substr(e + 1, h.length);
        e = "";
        for (var i = 0; i < l; i++)e += " ";
        return m + e + h
    }

    function d(h, e) {
        if (h.indexOf(p) == -1)return h;
        for (var l = 0; (l = h.indexOf(p)) != -1;)h = c(h, l, e - l % e);
        return h
    }

    b = b.split("\n");
    for (var f = "", p = "\t", q = 0; q < b.length; q++)f += d(b[q], 4) + "\n";
    return f
};
a.SwitchToList = function () {
    var b = this.div.innerHTML.replace(/<(br)\/?>/gi, "\n").split("\n");
    this.addControls == true && this.bar.appendChild(dp.sh.Toolbar.Create(this));
    if (this.showColumns) {
        for (var c = this.CreateElement("div"), d = this.CreateElement("div"), f = 1; f <= 150;)if (f % 10 == 0) {
            c.innerHTML += f;
            f += (f + "").length
        } else {
            c.innerHTML += "&middot;";
            f++
        }
        d.className = "columns";
        d.appendChild(c);
        this.bar.appendChild(d)
    }
    f = 0;
    for (c = this.firstLine; f < b.length - 1; f++, c++) {
        d = this.CreateElement("LI");
        var p = this.CreateElement("SPAN");
        d.className = f % 2 == 0 ? "alt" : "";
        p.innerHTML = b[f] + "&nbsp;";
        d.appendChild(p);
        this.ol.appendChild(d)
    }
    this.div.innerHTML = ""
};
a.Highlight = function (b) {
    function c(e) {
        return e.replace(/^\s*(.*?)[\s\n]*$/g, "$1")
    }

    function d(e) {
        return e.replace(/\n*$/, "").replace(/^\n*/, "")
    }

    function f(e) {
        e = dp.sh.Utils.FixForBlogger(e).split("\n");
        for (var l = new RegExp("^\\s*", "g"), m = 1E3, i = 0; i < e.length && m > 0; i++)if (c(e[i]).length != 0) {
            var g = l.exec(e[i]);
            if (g != null && g.length > 0)m = Math.min(g[0].length, m)
        }
        if (m > 0)for (i = 0; i < e.length; i++)e[i] = e[i].substr(m);
        return e.join("\n")
    }

    function p(e, l, m) {
        return e.substr(l, m - l)
    }

    var q = 0;
    if (b == null)b = "";
    this.originalCode =
        b;
    this.code = d(f(b));
    this.div = this.CreateElement("DIV");
    this.bar = this.CreateElement("DIV");
    this.ol = this.CreateElement("OL");
    this.matches = [];
    this.div.className = "dp-highlighter";
    this.div.highlighter = this;
    this.bar.className = "bar";
    this.ol.start = this.firstLine;
    if (this.CssClass != null)this.ol.className = this.CssClass;
    if (this.collapse)this.div.className += " collapsed";
    if (this.noGutter)this.div.className += " nogutter";
    if (this.tabsToSpaces == true)this.code = this.ProcessSmartTabs(this.code);
    this.ProcessRegexList();
    if (this.matches.length == 0)this.AddBit(this.code, null); else {
        this.matches = this.matches.sort(dp.sh.Highlighter.SortCallback);
        for (b = 0; b < this.matches.length; b++)if (this.IsInside(this.matches[b]))this.matches[b] = null;
        for (b = 0; b < this.matches.length; b++) {
            var h = this.matches[b];
            if (!(h == null || h.length == 0)) {
                this.AddBit(p(this.code, q, h.index), null);
                this.AddBit(h.value, h.css);
                q = h.index + h.length
            }
        }
        this.AddBit(this.code.substr(q), null)
    }
    this.SwitchToList();
    this.div.appendChild(this.bar);
    this.div.appendChild(this.ol)
};
a.GetKeywords = function (b) {
    return"\\b" + b.replace(/ /g, "\\b|\\b") + "\\b"
};
dp.sh.BloggerMode = function () {
    dp.sh.isBloggerMode = true
};
dp.sh.HighlightAll = function (b, c, d, f, p, q) {
    function h() {
        for (var k = arguments, j = 0; j < k.length; j++)if (k[j] != null) {
            if (typeof k[j] == "string" && k[j] != "")return k[j] + "";
            if (typeof k[j] == "object" && k[j].value != "")return k[j].value + ""
        }
        return null
    }

    function e(k, j) {
        for (var o = 0; o < j.length; o++)if (j[o] == k)return true;
        return false
    }

    function l(k, j, o) {
        k = new RegExp("^" + k + "\\[(\\w+)\\]$", "gi");
        for (var s = null, u = 0; u < j.length; u++)if ((s = k.exec(j[u])) != null)return s[1];
        return o
    }

    function m(k, j, o) {
        o = document.getElementsByTagName(o);
        for (var s = 0; s < o.length; s++)o[s].getAttribute("name") == j && k.push(o[s])
    }

    var i = [], g = null, v = {};
    m(i, b, "pre");
    m(i, b, "textarea");
    if (i.length != 0) {
        for (var n in dp.sh.Brushes) {
            g = dp.sh.Brushes[n].Aliases;
            if (g != null)for (b = 0; b < g.length; b++)v[g[b]] = n
        }
        for (b = 0; b < i.length; b++) {
            n = i[b];
            var r = h(n.attributes["class"], n.className, n.attributes.language, n.language);
            g = "";
            if (r != null) {
                r = r.split(":");
                g = r[0].toLowerCase();
                if (v[g] != null) {
                    g = new dp.sh.Brushes[v[g]];
                    n.style.display = "none";
                    g.noGutter = c == null ? e("nogutter", r) : !c;
                    g.addControls =
                        d == null ? !e("nocontrols", r) : d;
                    g.collapse = f == null ? e("collapse", r) : f;
                    g.showColumns = q == null ? e("showcolumns", r) : q;
                    var w = document.getElementsByTagName("head")[0];
                    if (g.Style && w) {
                        var t = document.createElement("style");
                        t.setAttribute("type", "text/css");
                        if (t.styleSheet)t.styleSheet.cssText = g.Style; else {
                            var x = document.createTextNode(g.Style);
                            t.appendChild(x)
                        }
                        w.appendChild(t)
                    }
                    g.firstLine = p == null ? parseInt(l("firstline", r, 1)) : p;
                    g.Highlight(n.innerHTML);
                    g.source = n;
                    n.parentNode.insertBefore(g.div, n)
                }
            }
        }
    }
};
