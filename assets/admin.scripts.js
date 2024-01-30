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