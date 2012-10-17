ccm_setupTestimonialSearch = function() {
	
	$("#ccm-testimonial-list-cb-all").click(function() {
		if ($(this).attr('checked') == true) {
			$('.ccm-list-record td.ccm-testimonial-list-cb input[type=checkbox]').attr('checked', true);
			$("#ccm-testimonial-list-multiple-operations").attr('disabled', false);
		} else {
			$('.ccm-list-record td.ccm-testimonial-list-cb input[type=checkbox]').attr('checked', false);
			$("#ccm-testimonial-list-multiple-operations").val('').attr('disabled', true);
			$('#operate-testimonials').attr('disabled',true);	
		}
	});
	$("td.ccm-testimonial-list-cb input[type=checkbox]").click(function(e) {
		if ($("td.ccm-testimonial-list-cb input[type=checkbox]:checked").length > 0) {
			$("#ccm-testimonial-list-multiple-operations").attr('disabled', false);
		} else {
			$("#ccm-testimonial-list-multiple-operations").val('').attr('disabled', true);
			$('#operate-testimonials').attr('disabled',true);	
		}
	});

	// if we're not in the dashboard, add to the multiple operations select menu

	$("#ccm-testimonial-list-multiple-operations").change(function() {
		$this	=	$(this);
		var action = $this.val();
		
		// get the ids of the testimonials to operate on
		tIDstring = '';
		tIDobj	=	[];
		$("td.ccm-testimonial-list-cb input[type=checkbox]:checked").each(function() {
			tIDstring=tIDstring+'&tID[]='+$(this).val();
			tIDobj.push($(this).val());
		});
		
		var dataForRequest		=	testimonialURLParams;
		dataForRequest['action']	=	action;
		dataForRequest['tID']		=	tIDobj;
		
		// perform an action
		switch(action) {
			case 'delete':								
				// enable the submit button			                                
				$('#operate-testimonials').removeAttr('disabled');
				break;
			
			default:
				$('#operate-testimonials').attr('disabled',true);	
		}
		return false;		
	});


}