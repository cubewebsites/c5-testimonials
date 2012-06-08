<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('testimonials_list','cube_testimonials');

class DashboardCubeTestimonialsController extends Controller {
	public function on_start() {

	}

	public function view() {

		$html = Loader::helper('html');
		$form = Loader::helper('form');
		$this->set('form', $form);
		//$this->addHeaderItem('<script type="text/javascript">$(function() { ccm_setupAdvancedSearch(\'user\'); });</script>');
		$tl             = $this->getRequestedSearchResults();
		$testimonials   = $tl->getPage();

		$this->set('testimonialList', $tl);
		$this->set('testimonials', $testimonials);
		$this->set('pagination', $tl->getPagination());
	}

	/**
	 * @return TestimonialsList
	 */
	public function getRequestedSearchResults() {

		$tl =   new TestimonialsList();
		$tl->sortBy('display_order','desc');

		$columns = TestimonialSearchColumnSet::getCurrent();
		$this->set('columns', $columns);

		// Additional filtering to go here
		return $tl;
	}
}