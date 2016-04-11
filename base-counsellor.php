<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;


// ACF variables
if(function_exists('get_field')):
	$page_show_team_member = get_field('page_show_team_member');
	
	if($page_show_team_member):
		$team_blocks = get_field('team_block', 'option');
		$team_block_alt_colour = get_field('page_change_team_member_background');
	endif;
endif;  //function_exists
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div role="document" id="page">
	    <?php get_template_part( 'templates/counsellor', 'header' ); ?>
	    
	    <?php if(is_single()): ?>
		 	<div class="wrap container" itemscope itemtype="http://data-vocabulary.org/Person">
			 	<div class="centre_text border_bottom small_margin_bottom">
				    <ul class="inline_list menu">
					    <li><a href="<?php echo get_post_type_archive_link( 'counsellor' ); ?>" title="View all Counsellors">All Counsellors</a></li>
				    </ul>
			    </div>
			 	
		    	<div class="content row">
		        	<main class="main big_margin_bottom" role="main">
						<?php include Wrapper\template_path(); ?>
		        	</main><!-- /.main -->
			        <?php if (Config\display_sidebar()) : ?>
				        <aside class="sidebar" role="complementary">
				        <?php include Wrapper\sidebar_path(); ?>
				        </aside><!-- /.sidebar -->
			        <?php endif; ?>
		    	</div><!-- /.content -->
		    </div><!-- /.wrap -->
		    
		    <?php include(locate_template( 'flexible_content/block-1.php' ));   
			
		endif; //is_single
		
		if(is_archive()): ?>
			
			<div class="wrap container">
				
				<?php if(is_tax()): 
					$term = get_queried_object();
				?>
					<div class="centre_text border_bottom">
					    <ul class="double_single_block menu menu_font inline_list contextual_menu">
						    <li><a href="<?php echo get_post_type_archive_link( 'counsellor' ); ?>" title="View all Counsellors">All Counsellors</a></li>
							<?php if(is_tax('technique')): 
							
								$nav_args = array( 
									'theme_location'  => 'secondary_nav_5',
									'container'       => '%3$s',
									'items_wrap' => '%3$s',
								);
							
							elseif(is_tax('specialty')):
								
								$nav_args = array( 
									'theme_location'  => 'secondary_nav_4',
									'container'       => '%3$s',
									'items_wrap' => '%3$s',
								);
								
							endif;
								
								// Display the nav menu
								wp_nav_menu($nav_args);
							?>   
					    </ul>
				    </div>
				<?php endif; ?>
				
		    	<div class="content">
		        	<main class="main big_margin_bottom" role="main">
						<?php include Wrapper\template_path(); ?>
		        	</main><!-- /.main -->
			        <?php if (Config\display_sidebar()) : ?>
				        <aside class="sidebar" role="complementary">
				        <?php include Wrapper\sidebar_path(); ?>
				        </aside><!-- /.sidebar -->
			        <?php endif; ?>
		    	</div><!-- /.content -->
		    </div><!-- /.wrap -->
			
		<?php endif; // is_archive 
			
		do_action('get_footer');
		get_template_part('templates/footer');
		wp_footer(); ?>
    </div> <!-- document -->
	
  </body>
</html>
