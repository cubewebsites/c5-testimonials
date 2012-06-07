<?php

class Testimonials extends DatabaseItemList {

	public $table   =   'cube_testimonials';
	public $primary =   'testimonial_id';
	public $keys    =   array('title','author','department','url','quote','display_order');

	public function createTestimonial(array $data) {
		$data    =   $this->createRow($data);
		return $this->saveTestimonial($data);
	}

	// Create an testimonial object, can be populated with data if provided
	public function createRow($data=array()) {
		$testimonial    =   array();
		foreach($this->keys as $key) {
			if(array_key_exists($key,$data)) {
				$testimonial[$key]  =   $data;
			}
		}
		if(array_key_exists($this->primary,$data))
			$testimonial[$this->primary]    =   $data[$this->primary];
		return $testimonial;
	}

	public function saveTestimonial($data) {
		// Make sure a complete record is provied
		if(!$this->_validate($data))
			return false;

		// Get the database object and save the data
		$db         =   Loader::db();

		// See whether we're creating a new row or updating an existing one
		if(array_key_exists($this->primary,$data) && isset($data[$this->primary])) {
			$updates    =   array();
			$values     =   array();
			foreach($this->keys as $key) {
				$updates[]  =   "`".$key."`=?";
				$values[]   =   $data[$key];
			}
			$updates    =   implode(', ',$updates);
			$values[]   =   $data[$this->primary];

			$qry    =   "UPDATE {$this->table} SET {$updates} WHERE {$this->primary} = ?";
			$db->Execute($qry,$values);
			if($db->Affected_Rows())
				return $this->fetchByID($data[$this->primary]);
		}
		else {

			// Get a db-friendly string representation of the columns
			$fields     =   "`".implode('`,`',$this->keys)."`";

			// Get a db-friendly string representation of the column values
			$values     =   array();
			$valuephs   =   array();
			foreach($this->keys as $key) {
				$values[]   =   $data[$key];
				$valuephs[] =   '?';
			}
			$valuephs     =   implode(',',$valuephs);

			// Form a query and save
			$qry    =   "INSERT INTO {$this->table} ({$fields}) VALUES ({$valuephs})";
			$db->Execute($qry,$values);
			// Make sure that the object was saved correctly
			if($db->Insert_ID())
				return $this->fetchByID($db->Insert_ID());
		}
		return false;

	}


	public function fetchByID($id) {
		$db     =   Loader::db();
		$qry    =   "SELECT * FROM {$this->table} WHERE {$this->primary}=?";
		return $db->GetRow($qry,array($id));
	}

	public function fetchByIDs(array $ids) {

	}

	public function fetchAll($order='display_order') {

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


}