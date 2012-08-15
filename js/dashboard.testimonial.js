ccm_setupTestimonialSearch = function() {
	$(".chosen-select").chosen();

	$("#ccm-testimonial-list-cb-all").click(function() {
		if ($(this).prop('checked') == true) {
			$('.ccm-list-record td.ccm-testimonial-list-cb input[type=checkbox]').attr('checked', true);
			$("#ccm-testimonial-list-multiple-operations").attr('disabled', false);
		} else {
			$('.ccm-list-record td.ccm-testimonial-list-cb input[type=checkbox]').attr('checked', false);
			$("#ccm-testimonial-list-multiple-operations").attr('disabled', true);
		}
	});
	$("td.ccm-testimonial-list-cb input[type=checkbox]").click(function(e) {
		if ($("td.ccm-testimonial-list-cb input[type=checkbox]:checked").length > 0) {
			$("#ccm-testimonial-list-multiple-operations").attr('disabled', false);
		} else {
			$("#ccm-testimonial-list-multiple-operations").attr('disabled', true);
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
				// submit a delete request
				$.ajax({
					url		:	testimonialSearchURL,
					cache		:	false,
					dataType	:	'json',
					data		:	dataForRequest,
					success	:	function(data) {
						ccmAlert.hud(data.message,2000, 'add', data.message);
						alert(data.tID[0]);
						for(var tid in data.tID) {
							
						}
						$('#ccm-user-search-results').replaceWith(data.results);
					},
					error		:	function(data) {
						
					}
				})
				
				// if it works out then out with the old. in with the new
				
				// it doesn't, well it's nice to let people know :)'
				
				
				$(this).parents('form').hide().submit();
				
				break;
		}
		return false;		
	});


}