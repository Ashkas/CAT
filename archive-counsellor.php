<?php if (!have_posts()) : ?>
	<div class="alert alert-warning">
		<?php _e('Sorry, no results were found.', 'sage'); ?>
	</div>
	<?php get_search_form(); ?>
<?php endif;

query_posts($query_string . '&orderby=title&order=ASC');

if (have_posts()) :
	
	$counter = 0;
	echo '<div class="row equal_height_items grid_items">';
	while (have_posts()) : the_post();
		
		get_template_part('templates/content-archive-counsellor', get_post_type() != 'post' ? get_post_type() : get_post_format());
		
		$counter++; 
		if ($counter%3 == 0) echo '</div><div class="row equal_height_items grid_items">';
		
	endwhile;
	echo '<div class="clearfix"></div>';
endif; ?>