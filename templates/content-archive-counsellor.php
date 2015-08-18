<?php
		
	// Featured image 
	$featured_image = do_free_height_picturefill(get_post_thumbnail_id());
	
	// Title
	$get_title = get_the_title();
	
	$c_title = get_field('counsellor_title');
?>

<article class="col-sm-6 col-md-4 col-lg-3 big_margin_bottom grid_item">
	
	<div <?php post_class(); ?>>
		<?php if(get_the_post_thumbnail($post->ID)): ?>
			<div class="small_margin_bottom">
				<a href="<?php the_permalink(); ?>" title="Information about <?php echo $get_title; ?>">
					<?php echo $featured_image; ?>
				</a>
			</div>
		<?php endif; ?>
		<header>
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="Information about <?php echo $get_title; ?>"><?php echo $get_title; ?></a></h3>
			<?php if($c_title):?><h4><?php echo $c_title; ?></h4><?php endif; ?>
		</header>
		<div class="entry-summary">
			<small><?php the_excerpt(); ?></small>
		</div>
	</div> <!-- post_class -->
	
</article>
