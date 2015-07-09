<?php if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.
	
// Pull the Icon Blocks Flexible content
if( have_rows('icon_blocks', 'option') ):
	
	while ( have_rows('icon_blocks', 'option') ) : the_row();	
		
		if( (get_row_layout() == 'icon_block')):
			
			$block_title = get_sub_field('block_title');
			$blocks = get_sub_field('blocks');
			
			if($block_title): ?>
				<div class="row big_margin_bottom">
					<h2 class="home_title"><?php echo $block_title; ?></h2>
				</div>
			<?php endif;
				
			if(get_sub_field('blocks')):
		
				$counter = 1;
				while(has_sub_field('blocks')):
					
					//variables
					$title = get_sub_field('title');
					$text = get_sub_field('text');
					$image = get_sub_field('image');
					
					 // if else on odds and evens
					if($counter == 1 || $counter == 4 || $counter == 7 ) : ?>
						<div class="row big_margin_bottom icon_block_row">
					<?php endif; ?>
						<div class="col-sm-4 big_margin_bottom">
							<?php echo '<div class="very_small_image margin_bottom">'.do_free_height_picturefill($image, $link, 'margin_auto').'</div>'; ?>
							<?php echo '<h3 class="centre_text margin_bottom">'.$title.'</h3>'; ?>
							<?php echo '<p class="centre_text">'.$text.'</p>'; ?>
						</div>
					<?php if($counter == 3 || $counter == 6 || $counter == 9 ) : ?>
						</div>
					<?php endif; ?>
					
				<?php $counter++; endwhile;
			endif;?>
      
	<?php endif; //get_layout_row
		
	endwhile; //have_rows
	
endif;  // have_rows?>