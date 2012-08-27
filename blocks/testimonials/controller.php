<?php
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
            
            // Set the testimonial ids
            $ts = $this->get('testimonials');
            $ts = unserialize($ts);
            if(is_array($ts))
                $this->set('testimonial_ids',$ts);
            else
                $this->set('testimonial_ids',array());
            
        }

}