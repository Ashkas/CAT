<?php use Roots\Sage\Titles; ?>

<?php if((is_page() || is_single() || is_404() || is_search()) && !is_home()) : 
	
	if(is_page()):
		$featured_image = do_page_feature_picturefill(get_post_thumbnail_id());
	endif;
	
	if(get_the_post_thumbnail($post->ID) && is_page()): ?>
	
		<div class="featured_header_wrapper">
			
			<?php echo $featured_image; ?>
			
			<div class="wrap container">
		    	<div class="content">
					<div class="page-header">
						<h1><?= Titles\title(); ?></h1>
					</div>
		    	</div>
			</div>
		</div>
		
	<?php else: ?>
		
		<div class="page_header_wrapper coloured_background_2 margin_bottom">
			<div class="wrap container">
		    	<div class="content">
					<div class="page-header">
						<h1><?= Titles\title(); ?></h1>
					</div>
		    	</div>
			</div>
		</div>
		
	<?php endif;
	
	// if is page and is a sub-page, show the parent and siblings in a menu
	if(is_page()):
		// WP variables		
		$current = $post->ID;
		$parent = $post->post_parent;
		$grandparent_get = get_post($parent);
		$grandchild = $grandparent_get->post_parent;
		$has_children = has_children($post->ID);
		
		// ACF variables
		$sub_menu = get_field('show_top_sub_menu', $post->ID);
		
		if($sub_menu == 'true_sub_menu') {
			if($parent) {
				
				if(!$grandchild && $parent):
					$child_of_value = ( $post->post_parent ? $post->post_parent : $post->ID );
					// Depth of 2 if parent page, else depth of 1
					$depth_value = ( $post->post_parent ? 2 : 1 );
					
					$walker = new Short_Name_Walker();
					$wp_list_pages = wp_list_pages( array(
					    // Only pages that are children of the current page
					    'child_of' => $post->post_parent,
					    'depth' => 1,
					    'title_li' => '',
					    'walker' => $walker,
					    'echo' => 0,
					) );
					
					// Remove last |
					$wp_list_pages = preg_replace('/\|[^|]*$/', '', $wp_list_pages);
					//echo '2';
				elseif($grandchild):
					$child_of_value = ( $post->post_parent ? $post->post_parent : $post->ID );
					// Depth of 2 if parent page, else depth of 1
					$depth_value = ( $post->post_parent ? 2 : 1 );
					
					$walker = new Short_Name_Walker();
					$wp_list_pages = wp_list_pages( array(
					    // Only pages that are children of the current page
					    'child_of' => $grandchild,
					    'depth' => 1,
					    'title_li' => '',
					    'walker' => $walker,
					    'echo' => 0
					) );
					
					// Remove last |
					$wp_list_pages = preg_replace('/\|[^|]*$/', '', $wp_list_pages);
					//echo '3';
				else:
					
					$walker = new Short_Name_Walker();
					$wp_list_pages = wp_list_pages( array(
					    // Only pages that are children of the current page
					    'child_of' => $post->ID,
					    'depth' => 1,
					    'title_li' => '',
					    'walker' => $walker,
					    'echo' => 0,
					) );
					
					// Remove last |
					$wp_list_pages = preg_replace('/\|[^|]*$/', '', $wp_list_pages);
					//echo '4';
				endif;
			} else {
				$walker = new Short_Name_Walker();
				$wp_list_pages = wp_list_pages( array(
				    // Only pages that are children of the current page
				    'child_of' => $post->ID,
				    'depth' => 1,
				    'title_li' => '',
				    'walker' => $walker,
				    'echo' => 0,
				) );
				
				// Remove last |
				$wp_list_pages = preg_replace('/\|[^|]*$/', '', $wp_list_pages);
				//echo '5'; 
			} //end else
			
		} //$sub_menu
		
		if($wp_list_pages): ?>
			<nav class="centre_text margin_bottom">
				<ul class="double_single_block menu menu_font inline_list">
					<?php echo $wp_list_pages; ?>
				</ul>
			</nav>	
		<?php endif;
	endif;
	
elseif(!is_home()): ?>
	
	<div class="pageheader">
	  <h1><?= Titles\title(); ?></h1>
	</div>
		
<?php endif; ?>