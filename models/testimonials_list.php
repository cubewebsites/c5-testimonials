<?php
Loader::model('testimonial','cube_testimonials');

class TestimonialsList extends DatabaseItemList {

	public $table   =   'cube_testimonials';
	public $primary =   'testimonial_id';
	public $keys    =   array('title','author','department','url','quote','display_order');

	/*
	 * METHODS FOR MANAGING A SINGLE TESTIMONIAL
	 */

	public function createTestimonial(array $data) {
		$data    =   $this->createRow($data);
		return $this->saveTestimonial($data);
	}

	// Create an testimonial object, can be populated with data if provided
	public function createRow($data=array()) {
		$testimonial	=	new Testimonial();
		foreach($this->keys as $key) {
			if(!$testimonial->hasData($key))
				$testimonial->setData ($key);
		}		
		return $testimonial;
	}
	
	/**
	 *
	 * @param type $id
	 * @return Testimonial 
	 */
	public function fetchByID($id) {
		return Testimonial::getByTestimonialID($id);
	}

	
	protected function _validate($data) {
		foreach($this->keys as $key)
			if(!array_key_exists($key,$data))
				return false;

		if(!isset($data['title']))
			return false;

		if(!isset($data['quote']))
			return false;
		// Validation successful
		return true;
	}

	/*
	 * METHODS TO EXTEND THE DATABASE_LIST CLASS
	 */

	protected function setBaseQuery() {
		$this->setQuery('SELECT DISTINCT t.testimonial_id
		FROM '.$this->table.' t
		');
	}

	//this was added because calling both getTotal() and get() was duplicating some of the query components
	protected function createQuery(){
		if(!$this->queryCreated){
			$this->setBaseQuery();
			$this->queryCreated=1;
		}
	}

	/**
	 * Returns an array of file objects based on current settings
	 */
	public function get($itemsToGet = 0, $offset = 0) {
		$testimonials = array();
		$this->createQuery();
		$r = parent::get($itemsToGet, $offset);
		foreach($r as $row) {
			$t  =   Testimonial::getByTestimonialID($row['testimonial_id']);
			$testimonials[] = $t;
		}
		return $testimonials;
	}
}

class TestimonialSearchDefaultColumnSet extends DatabaseItemListColumnSet {
	//protected $attributeClass = 'UserAttributeKey';
public function __construct() {
		$this->addColumn(new DatabaseItemListColumn('title', t('Title'),'getTitle'));
		$this->addColumn(new DatabaseItemListColumn('author', t('Author'),  'getAuthor'));
		$this->addColumn(new DatabaseItemListColumn('department', t('Department'), 'getDepartment'));
		//$this->addColumn(new DatabaseItemListColumn('quote', t('Quote'), 'getQuote'));
		$this->addColumn(new DatabaseItemListColumn('display_order', t('Display Order'), 'getDisplayOrder'));
		$do = $this->getColumnByKey('display_order');
		$this->setDefaultSortColumn($do, 'desc');
	}
}

class TestimonialSearchColumnSet extends DatabaseItemListColumnSet {
	protected $attributeClass = 'UserAttributeKey';
	public function getCurrent() {
		$fldc = new TestimonialSearchDefaultColumnSet();
		return $fldc;
	}
}