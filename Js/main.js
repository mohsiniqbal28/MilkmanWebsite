
      $('#from').datepicker(
         { 
            minDate: 0,
            beforeShow: function() {
            $(this).datepicker('option', 'maxDate', $('#to').val());
          }
       });
$('#to').datepicker(
         {
            defaultDate: "+1w",
            beforeShow: function() {
            $(this).datepicker('option', 'minDate', $('#from').val());
if ($('#from').val() === '') $(this).datepicker('option', 'minDate', 0);                             
         }
       });
    