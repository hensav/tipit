/**
 * Created by clstrfvck on 1.12.16.
 */

$(document).ready(function(){

    function regHide(){
        console.log('Hide/show');
        var viewType = $('#sel-role').val();
        if(viewType=="client"){
           // $('#sel-fName').hide();
            //$('#sel-lName').hide();
            //$('#sel-phone').hide();
        } else {
            $('#sel-fName').show();
            $('#sel-lName').show();
            $('#sel-phone').show();
        }
    };

    regHide();
    $('#sel-role').on('change', regHide());


});


