/**
 * Created by clstrfvck on 1.12.16.
 */

$(document).ready(function(){


    var regHide = function(){
        var viewType = $('#sel-role').val();
        if(viewType=="Client"){
            $('#sel-fName, #sel-lName, #sel-phone').hide();
        } else {
            $('#sel-fName, #sel-lName, #sel-phone').show();
        }
    }
    regHide();
    $('#sel-role').on('change', regHide);

});


