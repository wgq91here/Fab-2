function checkboxlist_onshow() {
}

function changeCheckboxOption(fieldId, key, value) {
    var optionText = $("label[for=" + fieldId + "_option_" + key + "]");
    optionText.html(value);

    key = parseInt(key);

    var optionData = Field_get_data(fieldId);
    optionData['Data'][key + 1] = value;

    Field_update_data(fieldId, 'Data', optionData['Data']);
}

function insertCheckbox(fieldId, obj) {
    //复制当前父对象
    var newOption = obj.parent().clone();

    // 修改其相关属性
    var newId = parseInt(obj.parent().attr("id")) + 1;
    newOption.attr('id', newId);
    newOption.find('input').attr('id', 'option_' + newId);
    newOption.find('input').attr('value', 'Option X');
    newOption.find("a[name='checkboxSelect']").html('[select]');
    newOption.find("a[name='checkboxSelect']").attr('class', 'unselect');

    // 插入到当前对象的后面
    obj.parent().after(newOption);

    // 计算最新编号
    var optionData = Field_get_data(fieldId);

    // 重新判断选择项
    // 从头算起
    var ii = 0;
    optionData['Select'] = {};
    $('#' + fieldId + '_options div a[name="checkboxSelect"]').each(function () {
        ii++;
        if ($(this).attr('class') === 'selected') {
            optionData['Select'][ii] = true;
        } else {
            optionData['Select'][ii] = false;
        }
    })

    var newInsertId = newId + 1;
    optionData['Select'][newInsertId] = false;
    Field_update_data(fieldId, 'Select', optionData['Select']);

    // 将复制对象后面的所有对象的id属性增加
    newOption.nextAll('div').each(function () {
        newId++;
        //console.log(newId + '=>' + optionData['Select'][newId] + ' change ' + optionData['Select'][newId-1]);
        //optionData['Select'][newId+1] = optionData['Select'][newId-1];
        $(this).attr('id', newId);
        $(this).find('input').attr('id', 'option_' + newId);
        $(this).find('input').attr('name', 'option_' + newId);
    });

    // 刷新实际checkbox列表
    relistCheckbox(fieldId);
}

function deleteCheckbox(fieldId, obj) {
    //取得当前父对象
    var thisOption = obj.parent();
    // 判断是否是最后一个选项
    var optionData = Field_get_data(fieldId);

    if (thisOption.parent().find('div:last').attr('id') == 0) {
        loadAjaxMessage('Last Option. Can\'t move it.', 1000);
        return;
    }

    // 取得其ID属性
    var thisId = parseInt(thisOption.attr("id"));

// 将复制对象后面的所有对象的id属性增加
    thisOption.nextAll('div').each(function () {
        $(this).attr('id', thisId);
        $(this).find('input').attr('id', 'option_' + thisId);
        $(this).find('input').attr('name', 'option_' + thisId);
        //optionData['Select'][thisId+1] = optionData['Select'][thisId+2];
        thisId++;
    });

    thisOption.remove();

    // 重新判断选择项
    // 从头算起
    // var optionData = Field_get_data(fieldId);
    var ii = 0;
    optionData['Select'] = {};
    $('#' + fieldId + '_options div a[name="checkboxSelect"]').each(function () {
        ii++;
        if ($(this).attr('class') === 'selected') {
            optionData['Select'][ii] = true;
        } else {
            optionData['Select'][ii] = false;
        }
    })

    Field_update_data(fieldId, 'Select', optionData['Select']);

    // 刷新实际checkbox列表
    relistCheckbox(fieldId);
}

function selectedCheckbox(fieldId, obj) {
    //取得当前父对象
    var thisOption = obj.parent();
    // 取得其ID属性
    var thisId = parseInt(thisOption.attr("id"));
    var optionCheckbox = $("#" + fieldId + "_option_" + thisId);

    var optionData = Field_get_data(fieldId);
    if (optionCheckbox.attr('checked')) {
        obj.text('[select]');
        obj.attr('class', 'unselect');
        optionCheckbox.removeAttr("checked");
        optionData['Select'][thisId + 1] = false;
    } else {
        obj.text('[unselect]');
        obj.attr('class', 'selected');
        optionCheckbox.attr('checked', 'true');
        optionData['Select'][thisId + 1] = true;
    }
    Field_update_data(fieldId, 'Select', optionData['Select']);
}

function relistCheckbox(fieldId) {
    var optionData = Field_get_data(fieldId);
    optionData['Data'] = {};

    $('#' + fieldId + '_options div').each(function () {
        key = parseInt($(this).attr('id')) + 1;
        optionData['Data'][key] = $(this).find('input').attr('value');
        optionData['Select'][key] = (optionData['Select'][key] == null) ? false : optionData['Select'][key];
    })
    Field_update_data(fieldId, 'Data', optionData['Data']);

    //$('#'+fieldId+' ul input').remove();
    //$('#'+fieldId+' ul label').remove();
    $('#' + fieldId + ' ul br').remove();
    $('#' + fieldId + ' ul li').remove();

    //$('#'+fieldId+' .fieldcontent').append('<br/>');

    // 重新获得
    optionData = Field_get_data(fieldId);

    $.each(optionData['Data'], function (index, value) {
        index--;
        isChecked = (optionData['Select'][index + 1]) ? 'checked' : '';
        newInput = $('<input type="checkbox" name="' + fieldId + '_option[]" id="' + fieldId + '_option_' + index + '" value="' + index + '" ' + isChecked + ' disabled>');
        newLabel = $('<label for="' + fieldId + '_option_' + index + '">' + value + '</label>');
        newLi = $('<li style="display:inline;padding-right:46px"></li>');
        newLi.append(newInput);
        newLi.append('&nbsp;');
        newLi.append(newLabel);
        $('#' + fieldId + ' ul').append(newLi);

        //$('#'+fieldId+' ul').append(newInput);
        //$('#'+fieldId+' ul').append('&nbsp;');
        //$('#'+fieldId+' ul').append(newLabel);
        //$('#'+fieldId+' .fieldcontent').append('<br/>');
    })
    //$('.modelfield input:checkbox').hide();
    /*
     $('.modelfield input:checkbox').click(function() {
     alert('click');
     return ;
     });
     */

    $('.modelfield input:checkbox').bind('change', function () {
        $(this).removeAttr("checked");
        return;
    });

}