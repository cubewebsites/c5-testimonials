<?php
defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('testimonials_list','cube_testimonials');
class DashboardCubeTestimonialsAddController extends Controller
{
    public function on_start()
    {
        // Assign helpers
        $this->set('ih',Loader::helper('concrete/interface'));
        $this->set('fh',Loader::helper('form'));

        // Track errors
        $this->error = Loader::helper('validation/error');
    }

    public function view()
    {
        $fh =   Loader::helper('form');

        $testimonials   =   new TestimonialsList();
        // Fetch testimonial if ID specified
        if ($fh->getRequestValue('tID')) {
            $testimonial    =   $testimonials->fetchByID($fh->getRequestValue('tID'));
            if ($testimonial) {
                $this->set('tID',$testimonial->getTestimonialID());
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
        if ($_POST['save']) {

            // Handle deletion
            if ($fh->getRequestValue('ccm-submit-ccm-testimonial-delete','post')) {
                if ($testimonial->getID()) {
                    $testimonial->delete();
                    $this->redirect('/dashboard/cube_testimonials/manage?t-deleted=1');
                }
            }

            // Fetch post values
            $title      =   $fh->getRequestValue('title');
            $author     =   $fh->getRequestValue('author');
            $department =   $fh->getRequestValue('department');
            $url        =   $fh->getRequestValue('url');
            $quote      =   $fh->getRequestValue('quote');
            $date		=	$fh->getRequestValue('testimonial_date');
            $date		=   $date ? date('Y-m-d H:i:s',strtotime($date)) : null;

            $data   =   array(
                    'title'				=>  $title,
                    'author'			=>  $author,
                    'department'		=>  $department,
                    'url'				=>  $url,
                    'quote'				=>  $quote,
                    'display_order'		=>  $testimonial->getDisplayOrder() ? $testimonial->getDisplayOrder() : 0,
                    'testimonial_date'	=>	$date
            );
            foreach($data as $k=>$v)
                $testimonial->setData($k,$v);

            // Save successful
            if ($testimonial->save()) {

                // See if we need to add another
                if ($fh->getRequestValue('ccm-submit-ccm-testimonial-add-another')) {
                    $this->redirect('/dashboard/cube_testimonials/add?t-saved=1');
                }

                // Redirect to the saved testimonial
                $this->redirect('/dashboard/cube_testimonials/add?tID=' . $testimonial->getID() . '&t-saved=1');
            }
            // Save fail
            else {
                // Display error
                foreach ($testimonial->getErrors() as $k => $v) {
                    $this->error->add($v);
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
