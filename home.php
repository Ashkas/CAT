<?php get_template_part('templates/page', 'header');

// ACF Variables
$banners = get_field('homepage_banner', 'option');
$tagline = get_field('homepage_tagline', 'option');
$steps_title = get_field('homepage_steps_title', 'option');

if( $banners ): ?>
    <div class="banner">
        <?php foreach( $banners as $image ): ?>
        	<style type="text/css">
				@media only screen {
					.home_parralax_image {
						background: url('<?php echo $image['sizes']['featured-small']; ?>')  no-repeat 50% !important;
						
						min-height: 250px;
					}
				}
				@media only screen and (min-width: 760px) {
					.home_parralax_image {
						background: url('<?php echo $image['sizes']['featured-medium']; ?>')  no-repeat !important;
						min-height: 440px;
					}
				}
				@media only screen and (min-width: 1024px) {
					.home_parralax_image {
						background: url('<?php echo $image['sizes']['banner-large']; ?>')  no-repeat 0 0 fixed !important;
						min-height: 660px;
						margin-top: -95px;
					}
				}
				@media only screen and (min-width: 1240px) {
					.home_parralax_image {
						background: url('<?php echo $image['sizes']['banner-xlarge']; ?>')  no-repeat 0 0 fixed !important;
						min-height: 800px;
						margin-top: -95px;
					}
				}
			</style>
	        <div class="parralax_banner parallax home_parralax_image" id="section_<?php echo the_ID(); ?>" style=" background-size:cover !important; -webkit-background-size: cover !important; -moz-background-size: cover !important; -o-background-size: cover !important;"></div>  
        <?php endforeach;
        	        	
    	if(get_field('homepage_banner_cta', 'option')): ?>
    		
    		<div class="container">
				<div class="banner_cta">
					<?php if($tagline): ?>
						<h1 class="banner_tagline big_margin_bottom"><?php echo $tagline; ?></h1>
					<?php endif; ?>
					<ul class="cta_buttons">
						<?php $counter = 1;
						while(has_sub_field('homepage_banner_cta', 'option')):
							
							if($counter == 1):
								$link = get_cta_link(get_sub_field('title'),get_sub_field('url'), 'big_button');
							else:
								$link = get_cta_link_alt(get_sub_field('title'),get_sub_field('url'), 'big_button');
							endif;
							
							if($link): ?>
							    <li><?php echo $link; ?></li>
							<?php endif;
							$counter++;
						endwhile; ?>
					</ul><!--#menu-secondary-nav-->
				</div><!--.banner_cta-->
    		</div> <!-- container -->
		<?php endif; ?>
    </div> <!-- banner -->
<?php endif; ?>

<main class="main" role="main">
	<div class="container">
		<div class="row big_margin_bottom big_margin_top">
			<h2 class="home_title">Online. Professional. Secure</h2>
		</div>
	</div> <!-- container -->

	<?php include(locate_template( 'flexible_content/block-1.php' ));   ?>
	
</main>