<?php
defined('C5_EXECUTE') or die("Access Denied.");
$form = Loader::helper('form');
?>

<div style="padding: 10px">

    <strong><?php echo t('Title')?></strong><br/>
    <?php echo $form->text('title',$title) ?>
    <br/><br/>

    <strong><?php echo t('Select all testimonials?')?></strong><br/>
    <?php echo $form->select('show_all',array(0=>'No',1=>'Yes'),$show_all) ?>
    <br/><br/>

    <div id="testimonial_selector">
    <strong><?php echo t('Select testimonials')?></strong><br/>
        <div class="inputs-list">
        <?php foreach($testimonial_objs as $_t): ?>
        <label clas="checkbox" for="testimonial<?php echo $_t->getID() ?>">
            <input<?php echo in_array($_t->getID(),$testimonial_ids)?' checked="checked"':'' ?> type="checkbox" value="<?php echo $_t->getID() ?>" name="testimonials[]" id="testimonial<?php echo $_t->getID() ?>" />
            <?php echo $_t->getTitle() ?>
        </label>
        <?php endforeach ?>
        </div>
    </div>

    <strong><?php echo t('Number of testimonials to display (0 for all)')?></strong><br/>
    <?php echo $form->text('testimonial_limit',$testimonial_limit) ?>
    <br/><br/>

    <strong><?php echo t('Randomise')?></strong><br/>
    <?php echo $form->select('random',array(0=>'No',1=>'Yes'),$random) ?>
    <br/><br/>

</div>
