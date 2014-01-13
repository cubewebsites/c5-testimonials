<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('cube_object','cube_testimonials');
Loader::model('testimonials_list','cube_testimonials');

class Testimonial extends Cube_Object {

	protected$_table   =   'cube_testimonials';
	protected $_primaryKey = 'testimonial_id';
	
	public static function getByTestimonialID($tID) {		
		$testimonial    =   new Testimonial();		
		$db     =   Loader::db();
		$qry    =   "SELECT * FROM ". $testimonial->getTableName() ." WHERE ". $testimonial->getIdFieldName() ."=?";
		                
                $row	=	 $db->GetRow($qry,array($tID));		
		
		if(!$row)
			return $testimonial;
		foreach($row as $k=>$v)
			$testimonial->setData ($k, $v);
		return $testimonial;
	}

	public function getDate() {
		return $this->getTestimonialDate();
	}
	
	public function getTestimonialID() {
		return $this->getId();
	}
	
	protected function _validate() {		
		if(!$this->getTitle())	$this->addError(t('Please enter a title'),'title');
		if(!$this->getQuote())	$this->addError(t('Please enter a testimonial'),'testimonial');
		if(!$this->getTestimonialDate())	$this->addError(t('Please enter a date'),'testimonial_date');
	}

	
}