<?php
		
	// Featured image 
	//$featured_image = do_feature_picturefill(get_post_thumbnail_id(), $link = NULL, $size1="0", $size2="600", $size3="600", $size4="600");
	
	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'profile-thumb');
	$alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
	
	// Title
	$get_title = get_the_title();
	
	$c_title = get_field('counsellor_title');
?>

<article class="col-sm-6 col-md-4 big_margin_bottom grid_item">
	
	<div <?php post_class(); ?>>
		<?php if(get_the_post_thumbnail($post->ID)): ?>
			<div class="small_margin_bottom">
				<a href="<?php the_permalink(); ?>" title="Information about <?php echo $get_title; ?>">
					<img src="<?php echo $featured_image[0]; ?>" alt="<?php echo $alt; ?>">
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
