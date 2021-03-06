	<?php
		
	//ACF Varibales
	if(function_exists('get_field')):
		// Top
		$footer_top_bar = get_field('footer_top_bar', 'option');
		
		// Bottom
		$footer_links = get_field('footer_links', 'option');
		$get_footer_site_info = get_field('footer_site_info', 'option');
		$footer_site_info = apply_filters('the_content', $get_footer_site_info);
		$get_footer_logo = get_field('footer_logo', 'option');
		$footer_logo = wp_get_attachment_image_src($get_footer_logo,'full');
		
		if(!$footer_logo):
			$get_footer_logo = get_field('logo', 'option');
			$footer_logo = wp_get_attachment_image_src($get_footer_logo,'full');
		endif;
	endif;	
	
	// WP variables
	$home_url = home_url();
	$site_title = get_bloginfo('name');
?>
<div class="clearfix"></div>
<footer class="content-info" role="contentinfo">
	<div class="top_bar">
		<div class="container">
			<?php if($footer_top_bar):
				echo '<div class="float_left">'.$footer_top_bar.'</div>';
			endif; ?>
			<div class="float_right">
				<a class="back-to-top" id="smooth-scroll" title="Back to top">
					Back to Top <span class="icon-arrow-up"></span>
				</a>
			</div>
			<div class="clearfix"></div>
		</div> <!-- container -->
	</div> <!-- topbar -->
	
	<?php if(is_dynamic_sidebar('sidebar-footer')): ?>
		<div class="mid_bar">
			<div class="container">
				<?php dynamic_sidebar('sidebar-footer'); ?>
			</div> <!-- container -->
		</div> <!-- midbar -->
	<?php endif; ?>
	
	<?php if($footer_links || $get_footer_site_info || $footer_logo): ?>
		<div class="bottom_bar">
			<div class="container">
				<div class="row">
					<?php if($footer_links): ?>
						<div class="col-md-6">
							<ul class="inline_list">
								<?php while( have_rows('footer_links', 'option') ): the_row(); 
								
									$title = get_sub_field('title');
									$link = get_sub_field('link');?>
									
									<li><a href="<?php echo $link; ?>" title="<?php echo $title;?>"><?php echo $title; ?></a></li>
								
								<?php endwhile; ?>
							</ul>
						</div>
					<?php endif;
						
					if($get_footer_site_info || $footer_logo): ?>
						<div class="col-md-6 margin_bottom no_padding site_info">
							<?php if($get_footer_site_info):
								echo $footer_site_info;
							endif;
							
							if($footer_logo):
								echo '<div class="footer_logo"><a href="'.$home_url.'" title="'.$site_title.' home"><img src="'.$footer_logo[0].'" alt="'.$site_title.' logo"></a></div>';
							endif; ?>
						</div>
					<?php endif; ?>
				</div> <!-- row -->
			</div> <!-- container -->
		</div> <!-- bottom_bar -->
	<?php endif; ?>
</footer>
