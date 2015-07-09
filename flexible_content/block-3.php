<?php if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.
	
// Pull Flexible content that appears at the bottom of the content
if( have_rows('bottom_content_block', 'option') ):
	
	while ( have_rows('bottom_content_block', 'option') ) : the_row();	
		
		if( (get_row_layout() == 'video')):
			
			$block_title = get_sub_field('title');
			$video = get_sub_field('video_url'); ?>
			
			<div class="coloured_background_2 big_margin_bottom">
				<div class="container">
					<div class="big_margin_top">
				
						<?php if($block_title): ?>
							<div class="row big_margin_bottom">
								<h2 class="home_title"><?php echo $block_title; ?></h2>
							</div>
						<?php endif;
							
						if($video): ?>
							<div class="row big_margin_bottom">
								<div class="col-lg-8 no_padding margin_auto">
									<div class="embed_container">
										<?php echo $video; ?>
									</div>
								</div>
							</div>
						<?php endif;?>
						<div class="clearfix"></div>
					</div>
				</div> <!-- container -->
			</div> <!-- coloured_background_2 -->
      
		<?php endif; //get_layout_row
			
		if( (get_row_layout() == 'cta_button')):
			
			$block_title = get_sub_field('title');
			$url = get_sub_field('url');
			$cta_button = get_cta_link_big($block_title,$url); ?>
			
				<div class="container">				
					<?php if($block_title): ?>
						<div class="row big_margin_bottom">
							<div class="col-sm-4 no_padding margin_auto">
								<?php echo $cta_button; ?>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php endif;?>
				</div> <!-- container -->
      
		<?php endif; //get_layout_row
		
	endwhile; //have_rows
	
endif;  // have_rows?>