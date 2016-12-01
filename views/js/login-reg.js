/**
 * Created by clstrfvck on 1.12.16.
 */

$(document).ready(function(){


    var regHide = function(){
        var viewType = $('#sel-role').val();
        if(viewType=="Client"){
            $('#sel-name').hide();
            $('#sel-phone').hide();
            $('#sel-name').hide;
        } else {
            $('#sel-name').show();
            $('#sel-phone').show();
            $('#sel-name').show()
        }
    }
    regHide();
    $('#sel-role').on('change', regHide);

});


