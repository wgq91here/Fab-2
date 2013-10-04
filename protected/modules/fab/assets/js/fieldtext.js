function text_onshow() {
}

function changeFieldSize(fieldId, value) {
    var field = $('#' + fieldId + '_field');
    field.css('width', value);
    Field_update_data(fieldId, 'Size', value);
}