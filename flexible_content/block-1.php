<?php if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.

// This is used for all of the content blocks

// Pull the content block flexible content
if( have_rows('content_blocks', 'option') && is_home() ):
	
	while ( have_rows('content_blocks', 'option') ) : the_row();
		
		if( (get_row_layout() == 'step_block')):

			$block_title = get_sub_field('block_title');
			$block_title_link = get_sub_field('block_title_link');
			$blocks = get_sub_field('blocks');
				
			if(get_sub_field('blocks')): ?>
				<div class="coloured_background_1">
					<div class="container">
						<div class="big_margin_top">
							<?php if($block_title): ?>
								<div class="big_margin_bottom">
									<?php if($block_title_link): ?>
										<h2 class="home_title"><a href="<?php echo $block_title_link; ?>" title="<?php  echo $block_title; ?>" class="alt_white"><?php  echo $block_title; ?></a></h2>
									<?php else: ?>
										<h2 class="home_title"><?php  echo $block_title; ?></h2>
									<?php endif; ?>
								</div>
							<?php endif;
								
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
									$block_url = get_sub_field('cta_button_url');
								endif;
								$get_meta = get_post_meta($image); ?>
								
								<div class="row block_row big_margin_bottom">
									<?php // if else on odds and evens
									if($counter % 2 == 0) : ?>
										<div class="col-sm-6 block_text">
											<?php if($block_url):
												echo '<h3 class="step_title margin_bottom"><a href="'.$block_url.'" title="'.$title.'">'.$title.'</a></h3>';
											else :
												echo '<h3 class="step_title margin_bottom">'.$title.'</h3>';
											endif;
											echo '<p>'.$text.'</p>'; ?>
										</div>
										<div class="col-sm-6 block_image margin_bottom">
											<?php echo $small_image_open.do_free_height_picturefill($image).$small_image_close; ?>
										</div>
									<?php else : ?>
										<div class="col-sm-6 block_image margin_bottom">
											<?php echo $small_image_open.do_free_height_picturefill($image).$small_image_close;  ?>
										</div>
										<div class="col-sm-6 block_text">
											<?php if($block_url):
												echo '<h3 class="step_title margin_bottom"><a href="'.$block_url.'" title="'.$title.'">'.$title.'</a></h3>';
											else :
												echo '<h3 class="step_title margin_bottom">'.$title.'</h3>';
											endif;
											echo '<p>'.$text.'</p>'; ?>
										</div>
									<?php endif; ?>
								</div>
								
							<?php unset($block_url); $counter++; endwhile;?> 
						</div>
					</div>
				</div>
			<?php endif; // blocks
      
		elseif( (get_row_layout() == 'icon_block')):
							
			$block_title = get_sub_field('block_title');
			$blocks = get_sub_field('blocks');
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif;
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif;
			
				if($block_title): ?>
					<div class="container">
						<div class="big_margin_bottom">
							<h2 class="home_title"><?php echo $block_title; ?></h2>
						</div>
					</div>
				<?php endif;
					
				if(get_sub_field('blocks')): ?>
					<div class="container">
						<?php $counter = 1;
						while(has_sub_field('blocks')):
							
							//variables
							$title = get_sub_field('title');
							$text = get_sub_field('text');
							$image = get_sub_field('image');
							
							 // if else on odds and evens
							if($counter == 1 || $counter == 4 || $counter == 7 ) : ?>
								<div class="big_margin_bottom icon_block_row">
							<?php endif; ?>
								<div class="col-sm-4 big_margin_bottom">
									<?php if($image) echo '<div class="very_small_image margin_bottom">'.do_free_height_picturefill($image, $link, 'margin_auto').'</div>'; ?>
									<?php echo '<h3 class="centre_text margin_bottom">'.$title.'</h3>'; ?>
									<?php echo '<p class="centre_text">'.$text.'</p>'; ?>
								</div>
							<?php if($counter == 3 || $counter == 6 || $counter == 9 ) : ?>
								</div>
							<?php endif; ?>
							
						<?php $counter++; endwhile; ?>
					</div> <!-- container -->
				<?php endif;
					
			if($padding_above || $padding_below): echo '</div>'; endif;
				      
		elseif( (get_row_layout() == 'video_block')):
			
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
      
		<?php elseif( (get_row_layout() == 'cta_button')):
			
			$block_title = get_sub_field('title');
			$url = get_sub_field('url');
			$cta_button = get_cta_link_big_2($block_title,$url);
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif;
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif; ?>
			
				<div class="container">				
					<?php if($block_title): ?>
						<div class="col-sm-4 no_padding margin_auto">
							<?php echo $cta_button; ?>
						</div>
						<div class="clearfix"></div>
					<?php endif;?>
				</div> <!-- container -->
      
			<?php if($padding_above || $padding_below): echo '</div>'; endif;
			
		elseif( (get_row_layout() == 'free_text_content')):
			
			$free_text = get_sub_field('free_text');
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif;
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif;?>
			
				<div class="container">				
					<?php if($free_text): ?>
						<div class="col-md-10 col-lg-9 margin_auto content no_padding">
							<?php echo $free_text; ?>
						</div>
						<div class="clearfix"></div>
					<?php endif;?>
				</div> <!-- container -->
      
			<?php if($padding_above || $padding_below): echo '</div>'; endif;
			
		elseif( (get_row_layout() == 'image_grid')):
					
			$block_title = get_sub_field('block_title');
			$images = get_sub_field('images');
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif; 
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif;?>
		
				<?php if($block_title): ?>
					<div class="container">
						<div class="big_margin_bottom">
							<h2 class="home_title"><?php echo $block_title; ?></h2>
						</div>
					</div>
				<?php endif;
					
				if(get_sub_field('images')): ?>
					
					<div class="container">
						<div class="big_margin_bottom logo_block">
							<?php $counter = 1;
							while(has_sub_field('images')):
								
								//variables
								$title = get_sub_field('title');
								$link = get_sub_field('link');
								$image = get_sub_field('image'); ?>
									
								<div class="col-sm-3 margin_bottom">
									<?php if($link): echo '<a href="'.$link.'" title="'.$title.'" target="_blank">'; endif; ?>
									<?php if($image) echo '<div class="margin_bottom">'.do_free_height_picturefill($image, $link, 'margin_auto').'</div>'; ?>
									<?php if($link): echo '</a>'; endif; ?>
								</div>
																
							<?php $counter++; endwhile; ?>
						</div> <!-- row -->
					</div> <!-- container -->
				<?php endif; // get_sub_field
					
			if($padding_above || $padding_below): echo '</div>'; endif;
				
		endif; //get_layout_row
		
	endwhile; //have_rows

elseif( have_rows('content_blocks') && !is_home() ):
	
	while ( have_rows('content_blocks') ) : the_row();	
		
		if( (get_row_layout() == 'step_block')):

			$block_title = get_sub_field('block_title');
			$block_title_link = get_sub_field('block_title_link');
			$blocks = get_sub_field('blocks');
			
			if($block_title): ?>
				<div class="big_margin_bottom">
					<?php if($block_title_link): ?>
						<h2 class="home_title"><a href="<?php echo $block_title_link; ?>" title="<?php  echo $block_title; ?>" class="alt_white"><?php  echo $block_title; ?></a></h2>
					<?php else: ?>
						<h2 class="home_title"><?php  echo $block_title; ?></h2>
					<?php endif; ?>
				</div>
			<?php endif;
				
			if(get_sub_field('blocks')): ?>
				<div class="coloured_background_1">
					<div class="container">
						<div class="big_margin_top">
							<?php $counter = 1;
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
								
								<div class="block_row block_row_alt big_margin_bottom">
									<div class="col-sm-6 block_text">
										<?php echo '<h3 class="step_title margin_bottom">'.$title.'</h3>'; ?>
										<?php echo '<p>'.$text.'</p>'; ?>
									</div>
									<div class="col-sm-6 block_image">
										<?php if($image) echo $small_image_open.do_free_height_picturefill($image).$small_image_close; ?>
									</div>
									<div class="clearfix"></div>
								</div>
								
							<?php $counter++; endwhile;?> 
						</div>
					</div>
				</div>
			<?php endif; 
      
		elseif( (get_row_layout() == 'icon_block')):
								
			$block_title = get_sub_field('block_title');
			$blocks = get_sub_field('blocks');
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif; 
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif;?>
		
				<?php if($block_title): ?>
					<div class="container">
						<div class="row big_margin_bottom">
							<h2 class="home_title"><?php echo $block_title; ?></h2>
						</div>
					</div>
				<?php endif;
					
				if(get_sub_field('blocks')): ?>
					
					<div class="container">
						<?php $counter = 1;
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
									<?php if($image) echo '<div class="very_small_image margin_bottom">'.do_free_height_picturefill($image, $link, 'margin_auto').'</div>'; ?>
									<?php echo '<h3 class="centre_text margin_bottom">'.$title.'</h3>'; ?>
									<?php echo '<p class="centre_text">'.$text.'</p>'; ?>
								</div>
							<?php if($counter == 3 || $counter == 6 || $counter == 9 ) : ?>
								</div>
							<?php endif; ?>
							
						<?php $counter++; endwhile; ?>
					</div> <!-- container -->
				<?php endif; // get_sub_field
					
			if($padding_above || $padding_below): echo '</div>'; endif;
      
		elseif( (get_row_layout() == 'video_block')):
			
			$block_title = get_sub_field('title');
			$video = get_sub_field('video_url'); 
			
			if(is_singular('counsellor')):
				$coloured_background = 'coloured_background_1';
			else:
				$coloured_background = 'coloured_background_2';
			endif;
			
			?>
			
			<div class="<?php echo $coloured_background; ?>">
				<div class="container">
					<div class="big_margin_top">
				
						<?php if($block_title): ?>
							<div class="big_margin_bottom">
								<h2 class="home_title"><?php echo $block_title; ?></h2>
							</div>
						<?php endif;
							
						if($video): ?>
							<div class="big_margin_bottom">
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
      
		<?php elseif( (get_row_layout() == 'cta_button')):
			
			$block_title = get_sub_field('title');
			$url = get_sub_field('url');
			$cta_button = get_cta_link_big($block_title,$url);
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif; 
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif;?>
			
				<div class="container">				
					<?php if($block_title): ?>
						<div class="big_margin_bottom">
							<div class="col-sm-4 no_padding margin_auto">
								<?php echo $cta_button; ?>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php endif;?>
				</div> <!-- container -->
      
			<?php if($padding_above || $padding_below): echo '</div>'; endif;
			
		elseif( (get_row_layout() == 'free_text_content')):
			
			$free_text = get_sub_field('free_text');
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif;
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif;?>
			
				<div class="container">				
					<?php if($free_text): ?>
						<div class="col-md-10 col-lg-9 margin_auto content no_padding">
							<?php echo $free_text; ?>
						</div>
						<div class="clearfix"></div>
					<?php endif;?>
				</div> <!-- container -->
      
			<?php if($padding_above || $padding_below): echo '</div>'; endif;
			
		elseif( (get_row_layout() == 'image_grid')):
					
			$block_title = get_sub_field('block_title');
			$images = get_sub_field('images');
			$padding_above = get_sub_field('padding_above');
			$padding_below = get_sub_field('padding_below');
			
			if($padding_above):
				$big_margin_top = 'big_margin_top';
			endif;
			if($padding_below):
				$big_margin_bottom = 'big_margin_bottom';
			endif; 
			
			if($padding_above || $padding_below): echo '<div class="'.$big_margin_top.' '.$big_margin_bottom.'">'; endif;?>
		
				<?php if($block_title): ?>
					<div class="container">
						<div class="big_margin_bottom">
							<h2 class="home_title"><?php echo $block_title; ?></h2>
						</div>
					</div>
				<?php endif;
					
				if(get_sub_field('images')): ?>
					
					<div class="container">
						<div class="big_margin_bottom images_grid">
							<?php $counter = 1;
							while(has_sub_field('images')):
								
								//variables
								$title = get_sub_field('title');
								$link = get_sub_field('link');
								$image = get_sub_field('image'); ?>
									
								<div class="image_grid_item margin_bottom">
									<?php if($link): echo '<a href="'.$link.'" title="'.$title.'" target="_blank">'; endif; ?>
									<?php if($image) echo '<span></span>'.do_free_height_picturefill($image, $link, 'margin_auto').''; ?>
									<?php if($link): echo '</a>'; endif; ?>
								</div>
																
							<?php $counter++; endwhile; ?>
							<div class="clearfix"></div>
						</div> <!-- row -->
					</div> <!-- container -->
				<?php endif; // get_sub_field
					
			if($padding_above || $padding_below): echo '</div>'; endif;
			
		endif; //get_layout_row
		
	endwhile; //have_rows
	
endif;  // have_rows?>