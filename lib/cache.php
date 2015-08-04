<?php 
	/* clear transient cache for page on update */
function skattle_clear_page_caches() {
	if($_POST[post_type] == 'page') {
		
		$key = 'child-pages-'.$post->ID;
	
		wp_cache_delete($key, 'page');
	
	}
}
add_action('save_post','skattle_clear_page_caches');

?>