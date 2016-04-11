<?php if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.
	
// Pull the Icon Blocks Flexible content
	if(function_exists('get_field')):
	if( have_rows('questions_and_answers') && !is_home() ): ?>
	
		<div class="big_margin_top">
	
			<?php while ( have_rows('questions_and_answers') ) : the_row();	
				
				if( (get_row_layout() == 'q_and_a_block')):
					
					$block_title = get_sub_field('q_and_a_block_title');
					$blocks = get_sub_field('q_and_a');
					
					if($block_title): ?>
						<h2><?php echo $block_title; ?></h2>
					<?php endif;
						
					if($blocks): ?>
						<div class="margin_bottom">
							<dl class="accordian">
								<?php $counter = 1;
								
								while(has_sub_field('q_and_a')):
									
									//variables
									$question = get_sub_field('question');
									$answer = get_sub_field('answer'); ?>
									
									<dt><a aria-expanded="false" aria-controls="accordion<?php echo $counter; ?>" class="accordion-title accordionTitle js-accordionTrigger" href="#accordion<?php echo $counter; ?>"><?php echo $question; ?></a></dt>
									<dd id="accordion<?php echo $counter; ?>" class="accordion-content accordionItem is-collapsed" aria-hidden="true"><?php echo $answer; ?> </dd>
									
								<?php $counter++; endwhile; ?>
							</dl> <!-- accordian -->
						</div> <!-- row -->
					<?php endif;?>
		      
				<?php endif; //get_layout_row
				
			endwhile; //have_rows ?>
		</div> <!-- big_margin_top -->
		
	<!--
		<script>
			jQuery(document).ready(function() {
				function close_accordion_section() {
					jQuery('.accordion .accordion-section-title').removeClass('active');
					jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
				}
			
				jQuery('.accordion-section-title').click(function(e) {
					// Grab current anchor value
					var currentAttrValue = jQuery(this).attr('href');
			
					if(jQuery(e.target).is('.active')) {
						close_accordion_section();
					}else {
						close_accordion_section();
			
						// Add active class to section title
						jQuery(this).addClass('active');
						// Open up the hidden content panel
						jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
					}
			
					e.preventDefault();
				});
			});
		</script>
	-->
		
	<?php endif;  // have_rows
endif; // function_exists ?>