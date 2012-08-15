<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('testimonials_list','cube_testimonials');

class DashboardCubeTestimonialsManageController extends Controller {
	public function on_start() {

	}

	public function view() {

		$html = Loader::helper('html');
		$form = Loader::helper('form');
		$urls = Loader::helper('concrete/urls');
		$this->set('form', $form);
        $this->addHeaderItem('<script type="text/javascript">
            var CUBE_TESTIMONIALS_TOOLS_DIR =   "'.$urls->getToolsUrl('','cube_testimonials').'";
			var cube_testimonials_i18n	=    {
				delete_dialog_title : "'.t('Delete Testimonials').'"
			};
        </script>');
		$this->addHeaderItem($html->javascript('dashboard.testimonial.js','cube_testimonials'));
		$tl             = $this->getRequestedSearchResults();
		$testimonials   = $tl->getPage();

		$this->set('testimonialList', $tl);
		$this->set('testimonials', $testimonials);
		$this->set('pagination', $tl->getPagination());
		
		if($form->getRequestValue('t-deleted'))
			$this->set('message', t('Testimonial deleted successfully.'));
		
	}

	/**
	 * @return TestimonialsList
	 */
	public function getRequestedSearchResults() {

		$tl =   new TestimonialsList();
		$tl->setItemsPerPage(20);
		$tl->sortBy('display_order','desc');

		$columns = TestimonialSearchColumnSet::getCurrent();
		$this->set('columns', $columns);

		// Additional filtering to go here
		return $tl;
	}
}