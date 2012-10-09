<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('testimonials_list','cube_testimonials');

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
        
        public function view() {
            
            // Set the title
            $this->set('title',$this->get('title'));            
            
            $tl =   new TestimonialsList();
            
            // Set the order of resultss            
            $this->get('random') ? $tl->sortBy ('RAND()', 'asc') : $tl->sortBy ('display_order','asc');
            
            // Filter by ID if needed
            if(!$this->get('show_all')) {
				// Make sure testimonials are selected
				// If none selected then they are all displayed
				$ids	=	$this->_getSelectedTestimonialIDs ();
				if(count($ids))
					$tl->filter ('testimonial_id',$ids, 'IN');
				
			}
            $this->set('testimonials',$tl->get());
            
        }

	public function save($data) {
        $args['show_all']       =   $data['show_all']==1?1:0;                            
		$args['testimonials']   =   is_array($data['testimonials']) ?   $data['testimonials']   :   array();
        $args['testimonials']   =   serialize($args['testimonials']);
		$args['title']          =   (String)$data['title'];
		$args['random']         =   $data['random']==1  ?   1   :   0;
		parent::save($args);
	}
        
        public function add() {
            $this->_setupForm();
        }
        
        public function edit() {
            $this->_setupForm();
        }
        
        protected function _setupForm() {
            $tl = new TestimonialsList();            
            $this->set('testimonial_objs',$tl->get());
            $this->set('testimonial_ids',$this->_getSelectedTestimonialIDs());
        }
        
        protected function _getSelectedTestimonialIDs() {
            // Set the testimonial ids
            $ts = $this->get('testimonials');
            $ts = unserialize($ts);
            if(is_array($ts))
                return $ts;                
            return array();                
        }

}