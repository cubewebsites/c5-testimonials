<?php 
defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('testimonial','cube_testimonials');

$u = new Testimonial();
$cnt = Loader::controller('/dashboard/cube_testimonials');
$userList = $cnt->getRequestedSearchResults();
$columns = $cnt->get('columns');

$users = $userList->getPage();
$pagination = $userList->getPagination();

Loader::element('users/search_results', array('columns' => $columns, 'users' => $users, 'userList' => $userList, 'searchType' => $_REQUEST['searchType'], 'pagination' => $pagination));
