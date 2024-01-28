jQuery(function($) {
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        showTime: true, // You can customize this based on your requirements
        controlType: 'select',
        oneLine: true,
        timeFormat: 'HH:mm',
        stepMinute: 5
    });
});
jQuery(document).ready(function($) {
    $("#_will_expire").change(function(){
        if ($(this).prop('checked')) {
            $('.picker_container').show();
        } else {
            $('.picker_container').hide();
        }
    });
    if ($('#_will_expire').prop('checked')) {
        $('.picker_container').show();
    } else {
        $('.picker_container').hide();
    }
});