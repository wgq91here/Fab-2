function datepicker_onshow(fieldID) {
  //alert(fieldID + "_field");
  var thisPicker = $("#" + fieldID + "_field");
  thisPicker.attr('readonly',true);
  thisPicker.datePicker({startDate:'1950-01-01'});
  
  thisPicker.bind(
			'click',
			function()
			{
				$(this).dpDisplay();
				this.blur();
				return false;
			}
		);
    
}


