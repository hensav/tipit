$(document).ready(function(){

    if($('select').val()=='client'){
        $('#sel-fName, #sel-lName, #sel-phone').hide();
    };

    $('select').change(function () {
        if($(this).val() !== 'client') {
            $('#sel-fName, #sel-lName, #sel-phone').show();
        }
        else {
            $('#sel-fName, #sel-lName, #sel-phone').hide();
        }
    });
});