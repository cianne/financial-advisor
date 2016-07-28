jQuery(document).ready(function($){
	function rangeSlider() {
		$('.rangeslider').rangeslider();

		var $document = $(document),
		selector = '[data-rangeslider]',
		$element = $(selector);

		// Example functionality to demonstrate a value feedback
		function valueOutput(element) {
			var value = element.value,
			output = element.parentNode.getElementsByTagName('output')[0];
			output.innerHTML = value;
		}

		for (var i = $element.length - 1; i >= 0; i--) {
			valueOutput($element[i]);
		}

		$document.on('change', '.rangeslider', function(e) {
			valueOutput(e.target);
		})
	}

	$(function(){
        rangeSlider();
    });

    $(document).ajaxSuccess(function(e, xhr, settings) {

        if(settings.data.search('action=save-widget') != -1 ) {
            rangeSlider();
        }
    });
});