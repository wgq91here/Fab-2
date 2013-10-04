function gurl(url) {
    document.location.href = url;
}

function checkall(thisbox, form) {
    for (var i = 0; i < form.elements.length; i++) {
        var e = form.elements[i];
        if (e.type == 'checkbox' && e.disabled != true) {
            e.checked = thisbox.checked;
        }
    }
}

function checkhased(form) {
    for (var i = 0; i < form.elements.length; i++) {
        var e = form.elements[i];
        if (e.type == 'checkbox' && e.disabled != true) {
            if (e.checked) {
                return true;
            }
        }
    }
    return false;
}

function fNOpen(divname) {
    var u = $("#" + divname);
    if (u.css("display") == "none") {
        u.show(0);
    }
    else {
        u.hide(0);
    }
    ;
}

function checkedall(divname) {
    $("#" + divname + " > input[@type='checkbox']").check();
}

jQuery.fn.extend({
    check: function () {
        return this.each(function () {
            this.checked = true;
        });
    },
    uncheck: function () {
        return this.each(function () {
            this.checked = false;
        });
    }
});

function checkemail(idname) {
    var str = $("#" + idname).val();
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if (filter.test(str))
        return true
    else {
        return false
    }
}


function loadAjaxMessage(html, second) {
    $("#ajaxstatus").show();
    $("#ajaxstatus").html(html);
    if (second > 0) {
        setTimeout("hideAjaxMessage(10)", second);
    }
}


function hideAjaxMessage(second) {
    $("#ajaxstatus").hide(second);
}