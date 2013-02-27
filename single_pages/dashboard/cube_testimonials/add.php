<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$dh = Loader::helper('form/date_time');
?>

<?php if($tID): ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Edit Testimonial'), false, false, false);?>
<?php else: ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Add Testimonial'), false, false, false);?>
<?php endif ?>

<form method="post" enctype="multipart/form-data" id="ccm-testimonial-form" action="<?php echo $this->url('/dashboard/cube_testimonials/add')?>">


	<div class="ccm-pane-body">

		<table border="0" cellspacing="0" cellpadding="0" width="100%" class="table">
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
				<td><input type="text" name="title" autocomplete="off" value="<?php echo $th->entities($testimonial->getTitle())?>" style="width: 95%"></td>
				<td><input type="text" autocomplete="off" name="author" value="<?php echo $th->entities($testimonial->getAuthor())?>" style="width: 95%"></td>
			</tr>

			<tr>
				<td><?php echo t('Department')?></td>
				<td><?php echo t('URL')?></td>
			</tr>
			<tr>
				<td><input type="text" name="department" autocomplete="off" value="<?php echo $th->entities($testimonial->getDepartment())?>" style="width: 95%"></td>
				<td><input type="text" autocomplete="off" name="url" value="<?php echo $th->entities($testimonial->getUrl())?>" style="width: 95%"></td>
			</tr>

			<tr>
				<td><?php echo t('Date')?></td>
				<td></td>
			</tr>
			<?php echo $testimonial->getDate() ?>
			<tr>
				<td><?php echo $dh->date('testimonial_date',$testimonial->getDate()) ?></td>
				<td></td>
			</tr>
			
			<tr>
				<td colspan="2"><?php echo t('Testimonial')?> <span class="required">*</span></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="quote" style="width: 95%" cols="=100" rows="5"><?php echo $th->entities($testimonial->getQuote())?></textarea></td>
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
			<?php  print $ih->submit(t('Save &amp; Add Another'), 'ccm-testimonial-add-another', 'right', 'primary'); ?>
			<?php if($testimonial->getID()): ?>
			<?php  print $ih->submit(t('Delete Testimonial'), 'ccm-testimonial-delete', 'left', 'danger'); ?>
			<?php endif ?>
		</div>
	</div>

</form>


<script type="text/javascript">
	$(document).ready(function(){
		$('#ccm-submit-ccm-testimonial-delete').click(function(){
			return confirm("<?php echo t('Are you sure you want to delete this testimonial?') ?>");
		});
	});
</script>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);?>