<?php

use Roots\Sage\Config;

?>

<?php if (!is_active_sidebar('sidebar-primary')) : ?>
	<div class="col-md-8 margin_auto">
<?php endif; ?>

	<?php if (!have_posts()) : ?>
		<div class="alert alert-warning">
			<?php _e('Sorry, no results were found.', 'sage'); ?>
		</div>
		<?php get_search_form(); ?>
	<?php endif; ?>
	
	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part('templates/content', 'search'); ?>
	<?php endwhile; ?>
	
	<?php the_posts_navigation(); ?>

<?php if (!(Config\display_sidebar())) : ?>
	</div>
<?php endif; ?>