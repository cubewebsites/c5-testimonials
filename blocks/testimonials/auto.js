$(document).ready(function(){
	function setupTestimonialSelector() {
		var showall =   $('#show_all').val();
		if(showall) {
			$('#testimonial_selector').hide();
		}
		else {
			$('#testimonial_selector').hide();
		}
	}

	$('#show_all').change(function(){
		setupTestimonialSelector();
		return true;
	})
	setupTestimonialSelector();

});