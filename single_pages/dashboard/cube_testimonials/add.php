<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
?>

<?php if($editmode): ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Edit Testimonial'), false, false, false);?>
<?php else: ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Add Testimonial'), false, false, false);?>
<?php endif ?>

<form method="post" enctype="multipart/form-data" id="ccm-testimonial-form" action="<?php echo $this->url('/dashboard/cube_testimonials/add')?>">


	<div class="ccm-pane-body">

		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<thead>
			<tr>
				<th colspan="2"><?php echo t('Testimonial Information')?></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><?php echo t('Title')?> <span class="required">*</span></td>
				<td><?php echo t('Author')?></td>
			</tr>
			<tr>
				<td><input type="text" name="title" autocomplete="off" value="<?php echo $th->entities($testimonial['title'])?>" style="width: 95%"></td>
				<td><input type="text" autocomplete="off" name="author" value="<?php echo $th->entities($testimonial['author'])?>" style="width: 95%"></td>
			</tr>

			<tr>
				<td><?php echo t('Department')?></td>
				<td><?php echo t('URL')?></td>
			</tr>
			<tr>
				<td><input type="text" name="department" autocomplete="off" value="<?php echo $th->entities($testimonial['department'])?>" style="width: 95%"></td>
				<td><input type="text" autocomplete="off" name="url" value="<?php echo $th->entities($testimonial['url'])?>" style="width: 95%"></td>
			</tr>

			<tr>
				<td colspan="2"><?php echo t('Testimonial')?> <span class="required">*</span></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="quote" style="width: 95%" cols="=100" rows="5"><?php echo $th->entities($testimonial['quote'])?></textarea></td>
			</tr>


			</tbody>
		</table>
	</div>

	<div class="ccm-pane-footer">
		<div class="ccm-buttons">
			<?php if($tID): ?>
			<input type="hidden" name="tID" value="<?php echo $tID ?>" />
			<?php endif ?>
			<input type="hidden" name="save" value="1" />
			<?php  print $ih->submit(t('Save Testimonial'), 'ccm-testimonial-form', 'right', 'primary'); ?>
		</div>
	</div>

</form>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);?>