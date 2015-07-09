<?php if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.
	
// Pull the content block flexible content
if( have_rows('content_blocks', 'option') ):
	
	while ( have_rows('content_blocks', 'option') ) : the_row();	
		
		if( (get_row_layout() == 'step_block')):

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
					$small_image =  null;
					$small_image = get_sub_field('small_image');
					if($small_image):
						$small_image_open = '<div class="small_image margin_auto">';
						$small_image_close = '</div>';
					else :
						$small_image_open = '<div class="margin_auto">';
						$small_image_close = '</div>';
					endif;
					$add_cta_button = get_sub_field('add_cta_button');
					if($add_cta_button):
						$button_title = get_sub_field('cta_button_title');
						$button_url = get_sub_field('cta_button_url');
						$button = '<p><a class="cta_button" href="'.$button_url.'">'.$button_title.'</a></p>';
					endif; 
					$get_meta = get_post_meta($image);
					?>
					
					<div class="row block_row big_margin_bottom">
						<?php // if else on odds and evens
						if($counter % 2 == 0) : ?>
							<div class="col-sm-6 block_text">
<!-- 								<div class="col-md-9 col-lg-8"> -->
									<?php echo '<h3 class="step_title margin_bottom">'.$title.'</h3>'; ?>
									<?php echo '<p>'.$text.'</p>'; ?>
<!-- 								</div> -->
							</div>
							<div class="col-sm-6 block_image margin_bottom">
								<?php echo $small_image_open.do_free_height_picturefill($image).$small_image_close; ?>
							</div>
						<?php else : ?>
							<div class="col-sm-6 block_image margin_bottom">
								<?php echo $small_image_open.do_free_height_picturefill($image).$small_image_close;  ?>
							</div>
							<div class="col-sm-6 block_text">
<!-- 								<div class="col-md-9 col-lg-8"> -->
									<?php echo '<h3 class="step_title margin_bottom">'.$title.'</h3>'; ?>
									<?php echo '<p>'.$text.'</p>'; ?>
									<?php if($add_cta_button) echo $button; ?>
<!-- 								</div> -->
							</div>
						<?php endif; ?>
					</div>
					
				<?php $counter++; endwhile;
			endif;
      
		endif; //get_layout_row
		
	endwhile; //have_rows
	
endif;  // have_rows?>