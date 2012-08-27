<?php
defined('C5_EXECUTE') or die("Access Denied.");
$form = Loader::helper('form');
?>

<div style="padding: 10px">


	<strong><?php echo t('Title')?></strong><br/>
	<?php echo $form->text('title',$title) ?>
	<br/><br/>

	<strong><?php echo t('Show All')?></strong><br/>
	<?php echo $form->select('show_all',array(0=>'No',1=>'Yes'),$show_all) ?>
	<br/><br/>

	<strong><?php echo t('Randomise')?></strong><br/>
	<?php echo $form->select('random',array(0=>'No',1=>'Yes'),$random) ?>
	<br/><br/>

	<div id="testimonial_selector">
	<strong><?php echo t('Testimonials to Display')?></strong><br/>
        <div class="inputs-list">
        <?php foreach($testimonial_objs as $_t): ?>
        <label clas="checkbox" for="testimonial<?php echo $_t->getID() ?>">
            <input<?php echo in_array($_t->getID(),$testimonial_ids)?' checked="checked"':'' ?> type="checkbox" value="<?php echo $_t->getID() ?>" name="testimonials[]" id="testimonial<?php echo $_t->getID() ?>" />
            <?php echo $_t->getTitle() ?>
        </label>
        <?php endforeach ?>
        </div>
	</div>

</div>