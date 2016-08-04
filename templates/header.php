<?php
	
	//Variables
	$home_url = home_url();
	$template_directory = get_bloginfo( 'template_directory' );
	
	// ACF Variables
	if(function_exists('get_field')):
		$get_header_logo = get_field('logo', 'option');
		$header_logo = wp_get_attachment_image_src($get_header_logo,'full');		
		
		$phone_number = get_field('site_phone_number', 'option');
	
	
		if(get_field('header_cta', 'option')):
			while(has_sub_field('header_cta', 'option')):
				$cta_button = get_cta_link(get_sub_field('header_cta_title'),get_sub_field('header_cta_url'));
			endwhile;
		endif;
	
	endif;
?>

<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TPSBPL"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TPSBPL');</script>
<!-- End Google Tag Manager -->

<header class="header" role="banner" id="top">
	<div class="topbar">
		<div class="container">
			<small class="float_left text_left header_phone"><a href="tel:<?php echo $phone_number; ?>" class="phone_link"><?php echo $phone_number; ?></a></small>
			<small class="float_right text_right links"><!-- <a href="https://counsellingathome.yondo.com/login" title="Sign Up to Counselling at Home Account" target="_blank">Sign Up</a> <a href="https://portal.counsellingathome.com" title="Login to your Counselling at Home Account" target="_blank">Login</a> --> <?php if($cta_button) echo $cta_button?></small>				
			<div class="clearfix"></div>
		</div> <!-- container -->
	</div> <!-- topbar -->
		
	<div class="midbar">
		<div class="container mobile_scroll_hide">
			
			<div class="col-xs-1 header_hamburger_menu header_mobile_icons no_padding">	
				<a href="javascript:void(0)" class="icon">
					<div class="hamburger">
					<div class="menui top-menu"></div>
					<div class="menui mid-menu"></div>
					<div class="menui bottom-menu"></div>
					</div>
				</a>
			</div>
			
			<div class="col-xs-10 brand_col no_padding">
				<a class="brand" href="<?php echo $home_url; ?>">
					<!--[if lte IE 8]><img src="<?php echo $template_directory; ?>/assets/images/logo-horizontal.png" alt="Counselling at Home"/><![endif]-->	
					<img src="<?php echo $template_directory; ?>/assets/images/logo-horizontal.svg" alt="Counselling at Home"/>
				</a>
			</div>
			<div class="col-xs-1 header_search header_mobile_icons">
				<span class="icon-search" id="search_toggle"></span>
			</div>
			
			<?php include(locate_template( 'templates/menu-primary.php' )); ?>
			<div class="clearfix"></div>
				
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