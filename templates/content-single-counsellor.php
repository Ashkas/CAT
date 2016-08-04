<?php while (have_posts()) : the_post();
	
	// ACF Variables
	if(function_exists('get_field')):
		$techniques = get_field('counsellor_techniques');
		$spectialties = get_field('counsellor_specialties');
		$contact = get_field('counsellor_contact');
		$request = get_field('counsellor_request');
	endif;	
	
	$get_title = get_the_title();
?>
	<div class="col-md-10 col-lg-9 margin_auto content no_padding">
		
		<?php if($contact || $request):
			
			echo '<ul class="margin_bottom margin_top cta_buttons">';
			
				if($contact):
					
					echo '<li><a href="'.$contact.'" title="Contact '.$get_title.'" class="cta_button cta_button_alt button margin_bottom" target="_blank">Contact</a></li>';
					
				endif;
				
				if($request):
					
					if (!$contact) {
						$single_button = 'single_button';
					}
					
					echo '<li class="'.$single_button.'"><a href="'.$request.'" title="Book online session with '.$get_title.'" class="cta_button button">Book Now</a></li>';
					
				endif;
				
				echo '<div class="clearfix"></div>';
				
			echo '</ul>';
						
		endif; ?>
		
		<?php include(locate_template( 'flexible_content/block-2.php' ));   ?>
		
		<?php the_content(); ?>
		
		<?php if($contact || $request):
			
			echo '<ul class="big_margin_bottom margin_top cta_buttons">';
			
				if($contact):
					
					echo '<li><a href="'.$contact.'" title="Contact '.$get_title.'" class="cta_button cta_button_alt button margin_bottom" target="_blank">Contact</a></li>';
					
				endif;
				
				if($request):
					
					if (!$contact) {
						$single_button = 'single_button';
					}
					
					echo '<li class="'.$single_button.'"><a href="'.$request.'" title="Book online session with '.$get_title.'" class="cta_button button">Book Now</a></li>';
					
				endif;
				
				echo '<div class="clearfix"></div>';
				
			echo '</ul>';
						
		endif; ?>
		
		<?php if($techniques || $spectialties): ?>
			<div class="margin_top">
				<?php if($techniques): ?>
					<div class="col-sm-6 no_padding margin_bottom">
						<h2>Techniques</h2>
						<ul>
							<?php foreach($techniques as $technique):
								$term_link = get_term_link( $technique );
	   
							    // If there was an error, continue to the next term.
							    if ( is_wp_error( $term_link ) ) {
							        continue;
							    }
							?>
								<li><?php echo '<a href="'.esc_url($term_link).'" title="'.$technique->name.'">'.$technique->name.'</a>'; ?></li>
								
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				
				<?php if($spectialties): ?>
					<div class="col-sm-6 no_padding">
						<h2>Specialties</h2>
						<ul>
							<?php foreach($spectialties as $spectialty):
								$term_link = get_term_link( $spectialty );
	   
							    // If there was an error, continue to the next term.
							    if ( is_wp_error( $term_link ) ) {
							        continue;
							    }
							?>
								<li><?php echo '<a href="'.esc_url($term_link).'" title="'.$spectialty->name.'">'.$spectialty->name.'</a>'; ?></li>
								
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="clearfix"></div>
			</div> <!-- margin_top -->
		<?php endif; ?>
	</div>
	<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
<?php endwhile; ?>