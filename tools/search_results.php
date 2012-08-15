<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$th	=	Loader::helper('text');
Loader::model('testimonials_list','cube_testimonials');
$list	=	new TestimonialsList();


$tIDs	=	array();
$response	=	array('success'=>1,'tID'=>$tIDs,'message'=>'Save successful','results'=>'');

if(isset($_REQUEST['tID']) && is_array($_REQUEST['tID'])) {	
	foreach($_REQUEST['tID'] as $tID)
		$tIDs[]	=	(int)$tID;
	
	if(isset($_REQUEST['action'])) {
		$action	=	$th->sanitize($_REQUEST['action']);		
		switch($action) {
			case 'delete' :				
				
				break;
		}
	}
	$response['tID']	=	$tIDs;
}


$cnt = Loader::controller('/dashboard/cube_testimonials/manage');
$testimonialList = $cnt->getRequestedSearchResults();
$columns = $cnt->get('columns');

$testimonials = $testimonialList->getPage();
$pagination = $testimonialList->getPagination();
ob_start();
Loader::packageElement('search_results', 'cube_testimonials' , array('columns' => $columns, 'testimonials' => $testimonials, 'testimonialList' => $testimonialList, 'searchType' => $_REQUEST['searchType'], 'pagination' => $pagination));
$response['results']	= ob_get_contents();
ob_end_clean();
echo json_encode($response);exit();