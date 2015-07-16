<?php use Roots\Sage\Titles; ?>

<?php if((is_page() || is_single()) && !is_home()) : 
	
	if(is_page()):
		$featured_image = do_page_feature_picturefill(get_post_thumbnail_id());
	endif;
	
	if(get_the_post_thumbnail($post->ID)): ?>
	
		<div class="featured_header_wrapper">
			
			<?php echo $featured_image; ?>
			
			<div class="wrap container">
		    	<div class="content row">
					<div class="page-header">
						<h1><?= Titles\title(); ?></h1>
					</div>
		    	</div>
			</div>
		</div>
		
	<?php else: ?>
		
		<div class="page_header_wrapper coloured_background_2 margin_bottom">
			<div class="wrap container">
		    	<div class="content row">
					<div class="page-header">
						<h1><?= Titles\title(); ?></h1>
					</div>
		    	</div>
			</div>
		</div>
		
	<?php endif;
	
elseif(!is_home()): ?>
	
	<div class="pageheader">
	  <h1><?= Titles\title(); ?></h1>
	</div>
		
<?php endif; ?>