<?php $title = get_the_title(); ?>

<section class="page_child_grid_item">
	<div class="wrap container">
    	<div class="content big_margin_top big_margin_bottom">
			<h2> <a href="<?php the_permalink(); ?>" title="Continue reading about <?php echo $title; ?>"><?php echo $title; ?> </a></h2>
			<?php the_excerpt(); ?>
    	</div>
	</div>
		
</section>