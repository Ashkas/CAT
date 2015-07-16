<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;


// ACF variables
if(function_exists('get_field')):
	$page_show_children = get_field('page_show_children');
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
	     <?php get_template_part( 'templates/page', 'header' ); ?>
		 	<div class="wrap container">
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
				
			if($page_show_children):
	
				$args = array(
					'child_of' => $post->ID,
					'post_type' => 'page',
					'post_status' => 'publish',
				);
					
				$query = null;
							
				$key = 'child-pages-'.$post->ID;
													
				$query = wp_cache_get( $key, $group );
							
				if ( $query == '' ) {
				    $query = get_pages( $args );
					wp_cache_set( $key, $query, $group, $expire );
				}
												
				if($query):		
					$counter = 1;
					echo '<div class="blocks big_margin_bottom">';	
						foreach( $query as $post ) : setup_postdata($post);
							
							// if it is the first row
							if ($counter++ % 2 == 1 ) echo '<div class="flex_row container">';
								get_template_part('loops/blocks');
							// if it is every 2nd plus one row
							if ($counter % 2 == 1 ) echo '</div>';
						//$counter++ ; 
						endforeach;
					echo '</div>';
					echo '<div class="clearfix"></div>';
				endif; //end query
				wp_reset_postdata();  
			endif; 
			
			if($team_blocks):
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
						
						<div class="block_row big_margin_bottom">
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
			endif;   
			
		do_action('get_footer');
		get_template_part('templates/footer');
		wp_footer(); ?>
    </div> <!-- document -->
	
  </body>
</html>
