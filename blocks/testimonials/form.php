<?php
defined('C5_EXECUTE') or die("Access Denied.");
$form = Loader::helper('form');
?>

<div style="padding: 10px">


	<strong><?php echo t('Title')?></strong><br/>
	<?php echo $form->text('title') ?>
	<br/><br/>

	<strong><?php echo t('Show All')?></strong><br/>
	<?php echo $form->text('show_all',array(0=>'No',1=>'Yes')) ?>
	<br/><br/>

	<strong><?php echo t('Randomise')?></strong><br/>
	<?php echo $form->text('random',array(0=>'No',1=>'Yes')) ?>
	<br/><br/>

	<div id="testimonial_selector">
	<strong><?php echo t('Testimonials to Display')?></strong><br/>
		<?php foreach($testimonials as $_t): ?>

		<?php endforeach ?>
	</div>

</div>