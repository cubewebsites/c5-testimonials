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
                
                // Form processing
                $this->_processTestimonials();
                
		$tl             = $this->getRequestedSearchResults();
		$testimonials   = $tl->getPage();

		$this->set('testimonialList', $tl);
		$this->set('testimonials', $testimonials);
		$this->set('pagination', $tl->getPagination());
		
		if($form->getRequestValue('t-deleted')) {
                    if($form->getRequestValue('t-multiple'))
                        $this->set('message', t('%d testimonial(s) deleted successfully',$form->getRequestValue('t-multiple')));
                    else {
                        $this->set('message', t('Testimonial deleted successfully.'));
                    }
                }
		
	}
        
        protected function _processTestimonials() {
            $fh =   Loader::helper('form');
            $tl =   new TestimonialsList();
            
            // Batch operations
            if($fh->getRequestValue('operate-testimonials') && isset($_POST['tID']) && is_array($_POST['tID']) && count($_POST['tID'])) {
                
                $tids   =   $_POST['tID'];                               
                               
                switch(strtolower($fh->getRequestValue('testimonial-operation'))) {
                    case 'delete':                       
                        foreach($tids as $tid) {
                            $testimonial    =   $tl->fetchByID($tid);                
                            $testimonial->delete();
                        }
                        $this->redirect('/dashboard/cube_testimonials/manage?t-deleted=1&t-multiple='.count($tids));                
                        break;    
                }
            }
            
            // Save operation
            if($fh->getRequestValue('save-testimonials')) {
                // save display order
                if(isset($_POST['tDisplayOrder'])&&is_array($_POST['tDisplayOrder']) && count($_POST['tDisplayOrder'])) {
                    $tids   =   $_POST['tDisplayOrder'];
                    foreach($tids as $tid => $do) {
                        $testimonial = $tl->fetchByID($tid);
                        $testimonial->setDisplayOrder($do);
                        $testimonial->save();
                    }
                    
                }
            }
        }

        /**
	 * @return TestimonialsList
	 */
	public function getRequestedSearchResults() {
            $fh =   Loader::helper('form');
            
		$tl =   new TestimonialsList();
		$tl->setItemsPerPage(20);
        $sortcolumn     =   $fh->getRequestValue('ccm_order_by') ? $fh->getRequestValue('ccm_order_by') : 'display_order';
        $sortdir        =   $fh->getRequestValue('ccm_order_dir') ? $fh->getRequestValue('ccm_order_dir') : 'asc';                                
        // Validate the column
        $sortcolumn = 'display_order';
                
		$tl->sortBy($sortcolumn,$sortdir);
//		$columns = TestimonialSearchColumnSet::getCurrent();
//		$this->set('columns', $columns);

		// Additional filtering to go here
		return $tl;
	}
}