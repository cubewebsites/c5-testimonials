<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<h1><span><?php echo t('Cube Testimonials')?></span></h1>

<div class="ccm-dashboard-inner">

	<table id="ccm-search-form-table" >
		<tr>

			<td valign="top" width="100%">	
				
				<div id="ccm-search-advanced-results-wrapper">
					
					<div id="ccm-testimonial-search-results">

						<?php  Loader::packageElement('search_results', 'cube_testimonials' ,array('searchInstance' => $searchInstance, 'searchType' => 'DASHBOARD', 'testimonials' => $testimonials, 'testimonialList' => $testimonialList, 'pagination' => $pagination)); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>