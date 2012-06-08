<?php  defined('C5_EXECUTE') or die("Access Denied."); ?> 

<div id="ccm-user-search-results">

<?php  if ($searchType == 'DASHBOARD') { ?>

<div class="ccm-pane-body">

<?php  } ?>

<?php

	if (!$searchType) {
		$searchType = $_REQUEST['searchType'];
	}
	
	$soargs = array();
	$soargs['searchType'] = $searchType;
	$searchInstance = 'testimonial';

	?>

<div id="ccm-list-wrapper"><a name="ccm-<?php echo $searchInstance?>-list-wrapper-anchor"></a>

	<div style="margin-bottom: 10px">
		<?php  $form = Loader::helper('form'); ?>

		<a href="<?php echo View::url('/dashboard/cube_testimonials/add')?>" style="float: right" class="btn primary"><?php echo t("Add Testimonial")?></a>
		<select id="ccm-<?php echo $searchInstance?>-list-multiple-operations" class="span3" disabled>
					<option value="">** <?php echo t('With Selected')?></option>
					<option value="properties"><?php echo t('Edit Properties')?></option>
				<?php  if ($mode == 'choose_multiple') { ?>
					<option value="choose"><?php echo t('Choose')?></option>
				<?php  } ?>
				</select>

	</div>

	<?php 
	$txt = Loader::helper('text');
	$uh    = Loader::helper('concrete/urls');

	$keywords = $_REQUEST['keywords'];
	$uh->getToolsURL('search_results','cube_testimonials');
	
	if (count($users) > 0) { ?>	
		<table border="0" cellspacing="0" cellpadding="0" id="ccm-user-list" class="ccm-results-list">
		<tr>
			<th width="1"><input id="ccm-user-list-cb-all" type="checkbox" /></th>
			<?php  foreach($columns->getColumns() as $col) { ?>
				<?php  if ($col->isColumnSortable()) { ?>
					<th class="<?php echo $userList->getSearchResultsClass($col->getColumnKey())?>"><a href="<?php echo $userList->getSortByURL($col->getColumnKey(), $col->getColumnDefaultSortDirection(), $bu, $soargs)?>"><?php echo $col->getColumnName()?></a></th>
				<?php  } else { ?>
					<th><?php echo $col->getColumnName()?></th>
				<?php  } ?>
			<?php  } ?>

		</tr>
	<?php 
		foreach($users as $ui) { 
			$action = View::url('/dashboard/cube_testimonials/add?tID=' . $ui->getTestimonialID());
			
			if ($mode == 'choose_one' || $mode == 'choose_multiple') {
				$action = 'javascript:void(0); ccm_triggerSelectUser(' . $ui->getTestimonialID() . '); jQuery.fn.dialog.closeTop();';
			}
			
			if (!isset($striped) || $striped == 'ccm-list-record-alt') {
				$striped = '';
			} else if ($striped == '') { 
				$striped = 'ccm-list-record-alt';
			}

			?>
		
			<tr class="ccm-list-record <?php echo $striped?>">
			<td class="ccm-user-list-cb" style="vertical-align: middle !important"><input type="checkbox" value="<?php echo $ui->getTestimonialID() ?>" /></td>
			<?php  foreach($columns->getColumns() as $col) { ?>
				<?php  if ($col->getColumnKey() == 'title') { ?>
					<td><a href="<?php echo $action?>"><?php echo $ui->getTitle()?></a></td>
				<?php  } else { ?>
					<td><?php echo $col->getColumnValue($ui)?></td>
				<?php  } ?>
			<?php  } ?>

			</tr>
			<?php 
		}

	?>
	
	</table>
	
	

	<?php  } else { ?>
		
		<div id="ccm-list-none"><?php echo t('No users found.')?></div>
		
	
	<?php  }  ?>

</div>

<?php 
	$userList->displaySummary();
?>

<?php  if ($searchType == 'DASHBOARD') { ?>
</div>

<div class="ccm-pane-footer">
	<?php  	$userList->displayPagingV2($bu, false, $soargs); ?>
</div>

<?php  } else { ?>
	<div class="ccm-pane-dialog-pagination">
		<?php  	$userList->displayPagingV2($bu, false, $soargs); ?>
	</div>
<?php  } ?>

</div>

<script type="text/javascript">
$(function() { 
	ccm_setupUserSearch(); 
});
</script>