/**
 * Created by clstrfvck on 01/01/2017.
 */
$(document).ready(function(){
    $('.granular-rating-body').hide();
    $('.granular-rating-title').click(function(){
       $('.granular-rating-body').slideToggle(300);
       $('.mainRating').slideToggle(300);
    });
});