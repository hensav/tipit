$(document).ready(function(){
    $('#sel-fName').hide();
    $('#sel-lName').hide();
    $('#sel-phone').hide();


    $('select').change(function () {

            if($(this).val() === '1') {
            $('#sel-fName').show();
            $('#sel-lName').show();
            $('#sel-phone').show();    }
        else {
            $('#sel-fName').hide();
            $('#sel-lName').hide();
            $('#sel-phone').hide();    }
    });
});