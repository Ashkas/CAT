<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;
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
    <main role="document" id="page" role="main">
	     <?php get_template_part( 'templates/page', 'header' ); ?>
	 	<div class="wrap container">
		 	
		 	
	    	<div class="content row">
	        	<div class="main big_margin_bottom">
					<?php include Wrapper\template_path(); ?>
	        	</div><!-- /.main -->
		        
		        <aside class="sidebar" role="complementary">
			        <?php $categories = get_categories();
				        
			        if($categories):
			         //var_dump($categories); ?>
			         	<ul class="menu-list">
				         	
							<?php foreach($categories as $category): ?>
								
								<li><a href="<?php echo esc_url( get_category_link( $category->term_id ) );?>" title="<?php echo esc_html( $category->name ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
							
							<?php endforeach; ?>
							
			         	</ul>
			        <?php endif; ?>
			        
			        <?php if (Config\display_sidebar()) : ?>
				        <?php include Wrapper\sidebar_path(); ?>
				    <?php endif; ?>
		        </aside><!-- /.sidebar -->
	    	</div><!-- /.content -->
	    </div><!-- /.wrap -->
	    
	    <?php  if($team_blocks):
			shuffle($team_blocks);
			$team_counter = 1;
			
			// change background colour if set
			if($team_block_alt_colour):
				$coloured_background = 'coloured_background_2';
			else:
				$coloured_background = 'coloured_background_1';
			endif;
			
			echo '<div class="'.$coloured_background.'"><div class="container"><div class="big_margin_top">';
				foreach($team_blocks as $team_block):
					$name = $team_block['name'];
					$link = $team_block['link'];
					$image_id = $team_block['image'];
					$medium = wp_get_attachment_image_src($image_id,'medium');
					$image = '<img src="'.$medium[0].'" alt="'.$name.'">';
					
					$cta_button = get_cta_link_big('View Profile',$link); ?>
					
					<div class="block_row block_row_bottom big_margin_bottom">
						<div class="col-sm-7 col-md-8 block_text">
							<?php echo '<h2 class="step_title_alt margin_bottom"><span class="not_bold block small_margin_bottom">Looking for a Counsellor?</span>';
							echo 'Find out how '.$name.' can help you</h2>';
							echo $cta_button; ?>
						</div>
						<div class="col-sm-5 col-md-4 block_image margin_bottom">
							<?php if($image_id): echo $image; endif; ?>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<?php if($team_counter == 1): break; endif;
				endforeach;
			echo '</div></div></div>';
		endif;   ?>
    </main> <!-- document -->
    <?php do_action('get_footer');
	get_template_part('templates/footer');
	wp_footer(); ?>
	
  </body>
</html>
