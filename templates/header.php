<?php
	
	//Variables
	$home_url = home_url();
	$template_directory = get_bloginfo( 'template_directory' );
	
	// ACF Variables
	if(function_exists('get_field')):
		$get_header_logo = get_field('logo', 'option');
		$header_logo = wp_get_attachment_image_src($get_header_logo,'full');		
		
		$phone_number = get_field('site_phone_number', 'option');
	endif;
	
	if(get_field('header_cta', 'option')):
		while(has_sub_field('header_cta', 'option')):
			$cta_button = get_cta_link(get_sub_field('header_cta_title'),get_sub_field('header_cta_url'));
		endwhile;
	endif;
?>


<header class="header" role="banner">
	<div class="topbar">
		<div class="container">
			<small class="float_left text_left header_phone"><a href="tel:<?php echo $phone_number; ?>" class="phone_link"><?php echo $phone_number; ?></a></small>
			<small class="float_right text_right links"><a href="<?php echo $home_url; ?>/users/sign_up" title="Sign up to Counselling at Home Account">Sign up</a> <a href="<?php echo $home_url; ?>/login" title="Login to your Counselling at Home Account">Login</a> <?php if($cta_button) echo $cta_button?></small>				
			<div class="clearfix"></div>
		</div> <!-- container -->
	</div> <!-- topbar -->
		
	<div class="midbar">
		<div class="container mobile_scroll_hide">
<!-- 			<div class="row"> -->
				<div class="col-xs-9 brand_col no_padding">
					<a class="brand" href="<?php echo $home_url; ?>">
						<!--[if lte IE 8]><img src="<?php echo $template_directory; ?>/assets/images/logo-horizontal.png" alt="Counselling at Home"/><![endif]-->	
						<img src="<?php echo $template_directory; ?>/assets/images/logo-horizontal.svg" alt="Counselling at Home"/>
					</a>
				</div>
				<div class="col-xs-1 header_search header_mobile_icons">
					<span class="icon-search" id="search_toggle"></span>
				</div>
				
				<div class="col-xs-2 header_hamburger_menu header_mobile_icons">	
					<a href="javascript:void(0)" class="icon">
						<div class="hamburger">
						<div class="menui top-menu"></div>
						<div class="menui mid-menu"></div>
						<div class="menui bottom-menu"></div>
						</div>
					</a>
				</div>
				
				<?php include(locate_template( 'templates/menu-primary.php' )); ?>
				<div class="clearfix"></div>
				
<!-- 			</div> --> <!-- row -->
		</div> <!-- mobile_scroll_hide -->
		
		<?php if($cta_button): ?>
			<div class="header_cta">
				<div class="container">
				  <ul class="cta_buttons">
				    <?php if($cta_button): ?>
				        <li><?php echo $cta_button; ?></li>
				    <?php endif; ?>
				  </ul><!--#menu-secondary-nav-->
				</div> <!-- container -->
			</div><!--.header_cta-->
		<?php endif; ?>
		
		<div class="sb-search" id="sb-search">
			<div class="container">
				<form method="get" class="search_form" action="<?php echo trailingslashit( home_url() ); ?>">
					<input class="sb-search-input" id="search" type="search" name="s" value="<?php echo sanitize_text_field($_GET['q']); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
					<input class="sb-search-submit" name="submit" type="submit" value="<?php esc_attr_e( 'Search', 'jch' ); ?>" />
					<div class="clearfix"></div>
				</form><!-- .search_form -->
			</div>
		</div>
		
		<div class="clearfix"></div>
		
	</div> <!-- midbar -->	
	
</header>

<span id="header_waypoint"></span>