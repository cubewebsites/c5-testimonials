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
		var action = $(this).val();
		switch(action) {
			case "delete":
				uIDstring = '';
				$("td.ccm-testimonial-list-cb input[type=checkbox]:checked").each(function() {
					uIDstring=uIDstring+'&uID[]='+$(this).val();
				});
				if(confirm('Are you sure?')) {
					jQuery.fn.dialog.open({
						width: 630,
						height: 450,
						modal: false,
						href: CCM_TOOLS_PATH + '/testimonials/bulk_properties?' + uIDstring,
						title: ccmi18n.properties
					});
				}
				break;
		}

		$(this).get(0).selectedIndex = 0;
	});


}