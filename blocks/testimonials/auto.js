$(document).ready(function(){
	function setupTestimonialSelector() {
		var showall =   $('#show_all').val();                
		if(showall==1) {
			$('#testimonial_selector').hide();
		}
		else {
			$('#testimonial_selector').show();
		}
	}

	$('#show_all').change(function(){
		setupTestimonialSelector();
		return true;
	})
	setupTestimonialSelector();

});