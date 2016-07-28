jQuery(document).ready(function($){
  //$('.of-color').wpColorPicker();
    function updateColorPickers(){
        $('.of-color').each(function(){
            $(this).wpColorPicker({
                // you can declare a default color here,
                // or in the data-default-color attribute on the input
                defaultColor: false,
                // a callback to fire whenever the color changes to a valid color
                change: function(event, ui){},
                // a callback to fire when the input is emptied or an invalid color
                clear: function() {},
                // hide the color picker controls on load
                hide: true,
                // show a group of common colors beneath the square
                // or, supply an array of colors to customize further
                //palettes: ['#ffffff','#000000','#ff7c0b']
            });
        });
    }

    $(function(){
        updateColorPickers();
    });

    /*$(document).ajaxSuccess(function(e, xhr, settings) {

        if(settings.data.search('action=save-widget') != -1 ) {
            updateColorPickers();
        }
    });*/
    /* $(document).ajaxSuccess(function(e, xhr, settings) {
        // var widget_id_base = 'ra_sample';
        if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
            updateColorPickers();
        }
    }); */

    $(document).ajaxSuccess(function(e, xhr, settings) {

        if(settings.data.search('action=save-widget') != -1 ) {
            updateColorPickers();
        }
    });
});

/*var elems = jQuery('#widgets-right .of-color, .inactive-sidebar .of-color');
var widget_id = 'widget';
jQuery(document).ready(function($) {
    elems.wpColorPicker();
}).ajaxComplete(function(e, xhr, settings) {
    if( settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id) != -1 ) {
        elems.wpColorPicker();
    }
});*/