<?php $do_not_duplicate[] = $post->ID;
				
$title = get_the_title();
//$excerpt = get_the_excerpt(); ?>

<section class="page_child_grid_item">
	<div class="wrap container">
    	<div class="content big_margin_top big_margin_bottom">
			
			<h2> <a href="<?php the_permalink(); ?>" title="Continue reading about <?php the_title(); ?>"><?php echo $title; ?> </a></h2>
			
			<?php the_excerpt(); ?>
    	</div>
	</div>
		
</section>