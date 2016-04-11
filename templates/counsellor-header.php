<?php use Roots\Sage\Titles; ?>

<?php 

// ACF Variables
if(function_exists('get_field')):
	$c_title = get_field('counsellor_title');
	$qualifications = get_field('counsellor_qualifications');
	$registration = get_field('counsellor_registration');
endif;
	
$featured_image = do_free_height_picturefill(get_post_thumbnail_id());

if(is_single()):

	if(get_the_post_thumbnail($post->ID)): ?>
	
		<div class="page_header_wrapper coloured_background_2 margin_bottom profile_header profile_header_image">
			
			<div class="wrap container">
		    	<div class="content margin_top margin_bottom">
			    	<div class="col-md-10 col-lg-9 margin_auto content no_padding">
				    	<div class="col-sm-3 no_padding">
					    	<?php echo $featured_image; ?>
				    	</div>
				    	<div class="col-sm-9">
							<div class="page-header">
								<h1 class="small_margin_bottom"><span itemprop="name"><?= Titles\title(); ?></span></h1>
								
								<?php if($c_title):
									echo '<p itemprop="title"><strong>'.$c_title.'</strong></p>';
								endif;
								
								echo '<span itemprop="affiliation" class="hidden">Online Counselling Services</span>'; ?>
								
								<meta itemprop="description" content="<?php echo get_the_excerpt(); ?>">
								
								<?php if($qualifications):
									echo '<small>Qualifications: '.$qualifications.'</small>';
								endif; 
								
								if($registration):
									echo '<small>Registration: '.$registration.'</small>';
								endif; ?>
								
							</div>
				    	</div>
				    	<div class="clearfix"></div>
			    	</div>
			    	<div class="clearfix"></div>
		    	</div>
			</div>
		</div>
		
	<?php else: ?>
		
		<div class="page_header_wrapper coloured_background_2 margin_bottom profile_header">
			<div class="wrap container">
		    	<div class="content">
					<div class="page-header">
						<h1><span itemprop="name"><?= Titles\title(); ?></span></h1>
						
						<?php if($c_title):
							echo '<p itemprop="title"><strong>'.$c_title.'</strong></p>';
						endif;
						
						echo '<span itemprop="affiliation" class="hidden">Online Counselling Services</span>'; ?>
						
						<meta itemprop="description" content="<?php echo get_the_excerpt(); ?>">
						
						<?php if($qualifications):
							echo '<small>Qualifications: '.$qualifications.'</small>';
						endif; 
						
						if($registration):
							echo '<small>Registration: '.$registration.'</small>';
						endif; ?>
						
					</div>
		    	</div>
			</div>
		</div>
		
	<?php endif; // featued image
		
elseif(is_archive() || is_tax()): ?>
	
	<div class="page_header_wrapper coloured_background_2 margin_bottom">
		<div class="wrap container">
	    	<div class="content">
				<div class="page-header">
					<h1><?= Titles\title(); ?></h1>
				</div>
	    	</div>
		</div>
	</div>
	
<?php endif; // is_archive ?>