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

                                    if(val.photo_url == 'company'){
                                        result +=
                                            "<div id='search__result'>" +
                                            "<span class='search__link company--link'><a href='company.php?company="+ id +"'>"+val.name+"</span> " +
                                            "<i class='fa fa-external-link-square' aria-hidden='true'></i></a>" +
                                            "</div>";
                                    } else {
                                        result +=
                                            "<div id='search__result'>" +
                                            "<span class='search__img-wrapper'><img class='search__img' src='" + imgRoot + val.photo_url+"'></span> " +
                                            "<span class='search__link'><a href='tiping_2.php?employeeId="+ id +"'>"+firstname[0]+"</a></span> " +
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
