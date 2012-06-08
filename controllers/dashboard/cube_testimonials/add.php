<?php
defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('testimonials_list','cube_testimonials');
class DashboardCubeTestimonialsAddController extends Controller {

	public function on_start() {
		// Assign helpers
		$this->set('ih',Loader::helper('concrete/interface'));
		$this->set('fh',Loader::helper('form'));

		// Track errors
		$this->error = Loader::helper('validation/error');
	}

	public function view() {
		$fh =   Loader::helper('form');

		$testimonials   =   new TestimonialsList();
		// Fetch testimonial if ID specified
		if($fh->getRequestValue('tID')) {
			$testimonial    =   $testimonials->fetchByID($fh->getRequestValue('tID'));
			if($testimonial) {
				$this->set('tID',$testimonial['testimonial_id']);
			}
			// Exit if not found
			else {
				$this->redirect('/dashboard/cube_testimonials/add?t-unavailable=1');
			}
		}
		// Create new testimonial if none specified
		else {
			$testimonial    =   $testimonials->createRow();
		}

		// Handle form submission
		if($_POST['save']) {

			// Fetch post values
			$title      =   $fh->getRequestValue('title');
			$author     =   $fh->getRequestValue('author');
			$department =   $fh->getRequestValue('department');
			$url        =   $fh->getRequestValue('url');
			$quote      =   $fh->getRequestValue('quote');

			// Validation
			if(!$title)			$this->error->add(t('Please enter a title'));
			if(!$quote)         $this->error->add(t('Please enter a testimonial'));

			// Save if validation passed
			if(!$this->error->has()) {
				$data   =   array(
					'title'         =>  $title,
					'author'        =>  $author,
					'department'    =>  $department,
					'url'           =>  $url,
					'quote'         =>  $quote,
					'display_order' =>  0
				);
				foreach($data as $k=>$v)
					$testimonial[$k]    =   $v;
				// Save
				$testimonial    =   $testimonials->saveTestimonial($testimonial);
				// Save successful
				if($testimonial) {
					// Redirect to the saved testimonial
					$this->redirect('/dashboard/cube_testimonials/add?tID=' . $testimonial['testimonial_id'] . '&t-saved=1');
				}
				// Save fail
				else {
					// Display error
					$this->error->add(t('An error occured when saving the testimonial.  Please try again.'));
				}
			}

		}

		// Show save message
		if($fh->getRequestValue('t-saved'))
			$this->set('message', t('Testimonial saved successfully.'));
		// Show not found message
		elseif($fh->getRequestValue('t-unavailable'))
			$this->error->add(t('Unable to find the selected testimonial'));

		// Setup view
		$this->set('testimonial',$testimonial);
		$this->set('error',$this->error);
	}

}
