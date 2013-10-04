/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function TextArea_cols_change(fieldId, key, value) {
    if (value > 30) return;
    var field = $("#" + fieldId + "_field");
    field.attr(key, value);
    Field_update_data(fieldId, key, value);
}

function textarea_onshow() {
}