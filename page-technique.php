<?php
/**
 * Template Name: Technique Archive Home
 */
?>

<?php while (have_posts()) : the_post(); ?>
	<?php //get_template_part('templates/page', 'header'); ?>
	<?php get_template_part('templates/content', 'page'); ?>
<?php endwhile;
	
$terms = get_terms( 'technique' );
	 
	 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		$counter = 0;

		echo '<div class="blocks big_margin_bottom big_margin_top">';
			echo '<div class="flex_row">';
		    foreach ( $terms as $term ) {
			    
					$title = $term->name;
					$term_id = $term->taxonomy.'_'.$term->term_id;
					
					if(function_exists('get_field')):
						$excerpt = get_field('taxonomy_excerpt', $term_id);
					endif;
					//$excerpt = get_the_excerpt(); ?>
					
					<section class="page_child_grid_item">
						<div class="wrap container">
					    	<div class="content big_margin_top big_margin_bottom">
								<h2> <a href="<?php get_term_link( $term )?>" title="Continue reading about <?php echo $title; ?>"><?php echo $title; ?> </a></h2>
								<?php echo $excerpt; ?>
					    	</div>
						</div>
							
					</section>
				<?php 
				
				$counter++;
				if ($counter%2 == 0) echo '</div><div class="flex_row">';
		        
		     }
	     echo '</div>';
	 }
?>