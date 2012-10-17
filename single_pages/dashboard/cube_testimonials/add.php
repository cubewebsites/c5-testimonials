<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
?>

<?php if($tID): ?>
<h1><span><?php echo t('Edit Testimonial')?></span></h1>
<?php else: ?>
<h1><span><?php echo t('Add Testimonial')?></span></h1>
<?php endif ?>


	
	<div class="ccm-dashboard-inner"> 
	
	<div class="actions">
	<span class="required">*</span> - <?php echo t('required field')?>
	</div>

<form method="post" enctype="multipart/form-data" id="ccm-testimonial-form" action="<?php echo $this->url('/dashboard/cube_testimonials/add')?>">
		<h2><?php echo t('Testimonial Information')?></h2>
		<div style="margin:0px; padding:0px; width:100%; height:auto" >
				<table class="entry-form" border="0" cellspacing="1" cellpadding="0">				
			<tbody>
			<tr>
				<td class="subheader" width="50%"><?php echo t('Title')?> <span class="required">*</span></td>
				<td class="subheader" width="50%"><?php echo t('Author')?></td>
			</tr>			
			<tr>
				<td><input type="text" name="title" autocomplete="off" value="<?php echo $th->entities($testimonial->getTitle())?>" style="width: 95%"></td>
				<td><input type="text" autocomplete="off" name="author" value="<?php echo $th->entities($testimonial->getAuthor())?>" style="width: 95%"></td>
			</tr>
			<tr>
				<td class="subheader" width="50%"><?php echo t('Department')?></td>
				<td class="subheader" width="50%"><?php echo t('URL')?></td>
			</tr>	
			<tr>
				<td><input type="text" name="department" autocomplete="off" value="<?php echo $th->entities($testimonial->getDepartment())?>" style="width: 95%"></td>
				<td><input type="text" autocomplete="off" name="url" value="<?php echo $th->entities($testimonial->getUrl())?>" style="width: 95%"></td>
			</tr>

			<tr>
				<td class="subheader" colspan="2"><?php echo t('Testimonial')?> <span class="required">*</span></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="quote" style="width: 95%" cols="=100" rows="5"><?php echo $th->entities($testimonial->getQuote())?></textarea></td>
			</tr>


			</tbody>
		</table>
	</div>

	<div class="ccm-buttons">
		<?php if($tID): ?>
		<input type="hidden" name="tID" value="<?php echo $tID ?>" />
		<?php endif ?>
		<input type="hidden" name="save" value="1" />			
		<?php  print $ih->submit(t('Save Testimonial'), 'ccm-testimonial-form', 'right', 'primary'); ?>
		<?php if($testimonial->getID()): ?>
		<?php  print $ih->submit(t('Delete Testimonial'), 'ccm-testimonial-delete', 'right', 'danger'); ?>
		<?php endif ?>
	</div>
		<div class="ccm-spacer">&nbsp;</div>
</form>

	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#ccm-submit-ccm-testimonial-delete').click(function(){
			return confirm("<?php echo t('Are you sure you want to delete this testimonial?') ?>");
		});
	});
</script>