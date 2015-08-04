<?php
/**
 * Template Name: Search
 */
?>

<?php while (have_posts()) : the_post(); ?>
	<?php //get_template_part('templates/page', 'header'); ?>
	<?php get_template_part('templates/content', 'page'); ?>
	<?php get_search_form(); ?>
<?php endwhile; ?>
