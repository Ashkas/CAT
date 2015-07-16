<?php //ACG Varibales
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
?>
<div class="clearfix"></div>
<footer class="content-info" role="contentinfo">
	<?php if($footer_top_bar): ?>
		<div class="top_bar">
			<div class="container">
				<?php echo $footer_top_bar; ?>
			</div> <!-- container -->
		</div> <!-- topbar -->
	<?php endif; ?>
	
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
								echo'<div class="footer_logo"><img src="'.$footer_logo[0].'"</div>';
							endif; ?>
						</div>
					<?php endif; ?>
				</div> <!-- row -->
			</div> <!-- container -->
		</div> <!-- bottom_bar -->
	<?php endif; ?>
</footer>
