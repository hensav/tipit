/**
 * Created by clstrfvck on 05/01/2017.
 */
/**
 * Created by clstrfvck on 04/01/2017.
 */
$(document).ready(function(){
    var $gcode = $('#goodcode');
    $gcode.keyup(function(){
        var strval = $gcode.val();
        if( strval.length >= 3){
            $.getJSON( 'http://naturaalmajand.us/tipit/api/request.php/apikey/123/search/byGoodcode/goodcode/'+strval,
                function( data ) {
                    var result = "";
                    $.each( data, function( key, val ) {
                        try {
                            if(val.name !== undefined){
                                var firstname = val.name.split("_");
                                var id = val.id;
                                var imgRoot = "http://naturaalmajand.us/tipit/uploads/";

                                if(val.photo_url !== 'company'){
                                    result +=/*
                                        "<div id='search__result'>" +
                                        "<a class='employeeName' href='manageWorkforce.php?addId="+ val.goodcode +"'>" +
                                        "<span class='search__img-wrapper'><img class='employeeThumbnail' src='" + imgRoot + val.photo_url+"'></span> " +
                                        "<span class='search__link'><a class='employeeName' href='manageWorkforce.php?addId="+ val.goodcode +"'>"+firstname[0]+"</a></span> " +
                                        "</div>";*/
                                        "<div class='container__employee'>"+
                                            "<div class='employeeThumbnail'><img class='employeeThumbnail' src='" + imgRoot + val.photo_url+"'></div>" +
                                            "<div class='employeeName'>"+firstname[0]+"</div>" +
                                            "<a href='manageWorkforce.php?addId="+ val.goodcode +"'>" +
                                            "<div class='employeeRating'>Add</a></div>" +
                                        "</div>";
                                }
                            }
                        } catch(err){
                            result = '<div class="search__result"><span class="search-error">Not found</span></div>';
                        }
                    });
                    $('#suggest').html(result);
                });
        } else {
            $('#suggest').html('');
        }
    });
});
