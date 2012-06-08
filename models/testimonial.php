<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('testimonials_list','cube_testimonials');

class Testimonial extends Object {

	public static function getByTestimonialID($tID) {
		$list   =   new TestimonialsList();
		$row    =   $list->fetchByID($tID);
		$testimonial    =   new Testimonial();
		if(!$row)
			return $testimonial;
		foreach($row as $k=>$v)
			$testimonial->$k    =   $v;
		return $testimonial;
	}

	public function getTestimonialID() {
		return $this->testimonial_id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getAuthor() {
		return $this->author;
	}

	public function getDepartment() {
		return $this->department;
	}

	public function getQuote() {
		return $this->quote;
	}

	public function getDisplayOrder() {
		return $this->display_order;
	}
}