jQuery(document).ready(function($){
	$('.widget-datepicker').datepicker();
	/*$(document).ajaxSuccess(function(e, xhr, settings) {
        var widget_id_base = 'ra_sample';
        if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
            $('.widget-datepicker').datepicker();
        }
    });*/
});