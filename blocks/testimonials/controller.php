<?php

class TestimonialsBlockController extends BlockController {

	protected $btInterfaceWidth = 320;
	protected $btInterfaceHeight = 220;
	protected $btTable = 'btTestimonials';
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btExportFileColumns = array('fID');
	protected $btWrapperClass = 'ccm-ui';

	/**
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Displays testimonials.  Allows specific testimonials, or all testimonials to be displayed");
	}

	public function getBlockTypeName() {
		return t("Testimonials");
	}

	function save($data) {
		$args['testimonials']   =   is_array($data['testimonials']) ?   $data['testimonials']   :   array();
		$args['title']          =   (String)$data['title'];
		$args['random']         =   $data['random']==1  ?   1   :   0;
		parent::save($args);
	}

}