<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php
    $txt = Loader::helper('text');
    $uh    = Loader::helper('concrete/urls');
    $fh	=	Loader::helper('form');
?>

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

    <?php  if ($searchType == 'DASHBOARD'): ?>
    <form action="<?php echo $this->url('/dashboard/cube_testimonials/manage') ?>" method="post">
     <?php endif ?>

<div id="ccm-list-wrapper"><a name="ccm-<?php echo $searchInstance?>-list-wrapper-anchor"></a>

    <div style="margin-bottom: 10px">
        <?php  $form = Loader::helper('form'); ?>

        <a href="<?php echo View::url('/dashboard/cube_testimonials/add')?>" style="float: right" class="btn primary"><?php echo t("Add Testimonial")?></a>

        <select name="testimonial-operation" id="ccm-<?php echo $searchInstance?>-list-multiple-operations" class="span3" disabled>
                    <option value="">** <?php echo t('With Selected')?></option>
                    <option value="delete"><?php echo t('Delete')?></option>
                <?php  if ($mode == 'choose_multiple') { ?>
                    <option value="choose"><?php echo t('Choose')?></option>
                <?php  } ?>
        </select>
        <?php echo $fh->submit('operate-testimonials','Go',array('disabled'=>'disabled'),'primary') ?>
    </div>

    <?php

    $keywords = $_REQUEST['keywords'];
    $uh->getToolsURL('search_results','cube_testimonials');

    if (count($testimonials) > 0) { ?>
        <table border="0" cellspacing="0" cellpadding="0" id="ccm-testimonial-list" class="ccm-results-list">
        <tr>
            <th width="1"><input id="ccm-testimonial-list-cb-all" type="checkbox" /></th>
            <?php  foreach ($columns->getColumns() as $col) { ?>
                <?php  if ($col->isColumnSortable()) { ?>
                    <th class="<?php echo $testimonialList->getSearchResultsClass($col->getColumnKey())?>"><a href="<?php echo $testimonialList->getSortByURL($col->getColumnKey(), $col->getColumnDefaultSortDirection(), $bu, $soargs)?>"><?php echo $col->getColumnName()?></a></th>
                <?php  } else { ?>
                    <th><?php echo $col->getColumnName()?></th>
                <?php  } ?>
            <?php  } ?>

        </tr>
    <?php
        foreach ($testimonials as $_t) {
            $action = View::url('/dashboard/cube_testimonials/add?tID=' . $_t->getTestimonialID());

            if ($mode == 'choose_one' || $mode == 'choose_multiple') {
                $action = 'javascript:void(0); ccm_triggerSelectTestimonial(' . $_t->getTestimonialID() . '); jQuery.fn.dialog.closeTop();';
            }

            if (!isset($striped) || $striped == 'ccm-list-record-alt') {
                $striped = '';
            } elseif ($striped == '') {
                $striped = 'ccm-list-record-alt';
            }

            ?>

            <tr class="ccm-list-record <?php echo $striped?>">
            <td class="ccm-testimonial-list-cb" style="vertical-align: middle !important"><input name="tID[]" type="checkbox" value="<?php echo $_t->getTestimonialID() ?>" /></td>
            <?php  foreach ($columns->getColumns() as $col) { ?>
                <?php  if ($col->getColumnKey() == 'title') { ?>
                    <td><a href="<?php echo $action?>"><?php echo $_t->getTitle()?></a></td>
                               <?php  } elseif ($col->getColumnKey() == 'display_order') { ?>
                                        <td><input name="tDisplayOrder[<?php echo $_t->getTestimonialID() ?>]" type="text" value="<?php echo $_t->getDisplayOrder() ?>" /></td>
                <?php  } else { ?>
                    <td><?php echo $col->getColumnValue($_t)?></td>
                <?php  } ?>
            <?php  } ?>

            </tr>
            <?php
        }

    ?>

    </table>
    <?php echo $fh->submit('save-testimonials','Save',array(),'success') ?>

    <?php  } else { ?>

        <div id="ccm-list-none"><?php echo t('No testimonials found.')?></div>

    <?php  }  ?>

</div>

    <?php  if ($searchType == 'DASHBOARD'): ?>
    </form>
    <?php endif ?>

<?php
    $testimonialList->displaySummary();
?>

<?php  if ($searchType == 'DASHBOARD') { ?>
</div>

<div class="ccm-pane-footer">
    <?php  	$testimonialList->displayPagingV2($bu, false, $soargs); ?>
</div>

<?php  } else { ?>
    <div class="ccm-pane-dialog-pagination">
        <?php  	$testimonialList->displayPagingV2($bu, false, $soargs); ?>
    </div>
<?php  } ?>

</div>

<script type="text/javascript">
var testimonialSearchURL	=	'<?php echo $uh->getToolsURL('search_results','cube_testimonials');  ?>';
var testimonialURLParams	=	{};
<?php foreach ($_GET as $k => $v): ?>
    testimonialURLParams['<?php echo $k ?>']	=	'<?php echo $v ?>';
<?php endforeach; ?>
$(function() {
    ccm_setupTestimonialSearch();
});
</script>
