<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Cube Testimonials'), t('Manage testimonials on your site and perform bulk actions on them.'), false, false);?>

<?php  Loader::packageElement('search_results', 'cube_testimonials' ,array('columns' => $columns, 'searchInstance' => $searchInstance, 'searchType' => 'DASHBOARD', 'users' => $testimonials, 'userList' => $testimonialList, 'pagination' => $pagination)); ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>