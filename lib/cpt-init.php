<?php
	
	////////////* Counsellors CUSTOM POSTS *//////////////

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => "Counsellors",
		"singular_name" => "Counsellor",
		"menu_name" => "Counsellors",
		"all_items" => "All Counsellors",
		"add_new" => "Add New",
		"add_new_item" => "Add New Counsellor",
		"edit" => "Edit",
		"edit_item" => "Edit Counsellor",
		"new_item" => "New Counsellor",
		"view" => "View",
		"view_item" => "View Counsellor",
		"search_items" => "Search Counsellors",
		"not_found" => "No Counsellors Found",
		"not_found_in_trash" => "No Counsellors found in Trash",
		"parent" => "Parent Counsellor",
		);

	$args = array(
		"labels" => $labels,
		"description" => "A counsellor who works for cousnellingathome",
		"public" => true,
		"show_ui" => true,
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "counsellors", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "revisions", "thumbnail", "author" ),		
	);
	register_post_type( "counsellor", $args );

// End of cptui_register_my_cpts()
}

////////////* TAXONOMies *//////////////

add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes() {

	$labels = array(
		"name" => "Techniques",
		"label" => "Techniques",
		"menu_name" => "Techniques",
		"all_items" => "All Techniques",
		"edit_item" => "Edit Technique",
		"view_item" => "View Technique",
		"update_item" => "Update Technique",
		"add_new_item" => "Add New Technique",
		"new_item_name" => "New Technique Name",
		"parent_item" => 'Parent Technique',
		"parent_item_colon" => 'Parent Technique:',
		"search_items" => "Search Techniques",
		"popular_items" => Null,
		"separate_items_with_commas" => Null,
		"add_or_remove_items" => "Add or remove techniques",
		"choose_from_most_used" => 'Choose from most used techniques',
		"not_found" => "No techniques found",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => false,
		"label" => "Techniques",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'counselling-techniques', 'with_front' => true ),
		"show_admin_column" => false,
	);
	register_taxonomy( "technique", array( "counsellor" ), $args );


	$labels = array(
		"name" => "Specialties",
		"label" => "Specialties",
		"menu_name" => "Specialties",
		"all_items" => "All Specialties",
		"edit_item" => "Edit Specialty",
		"view_item" => "View Specialty",
		"update_item" => "Update Specialty",
		"add_new_item" => "Add New Specialty",
		"new_item_name" => "New Specialty Name",
		"parent_item" => 'Parent Specialty',
		"parent_item_colon" => 'Parent Specialty:',
		"search_items" => "Search Specialties",
		"popular_items" => 'Popular Specialties',
		"separate_items_with_commas" => 'Separate specialties with commas',
		"add_or_remove_items" => "Add or remove specialties",
		"choose_from_most_used" => 'Choose from most used specialties',
		"not_found" => "No specialties found",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => false,
		"label" => "Specialties",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'counselling-types', 'with_front' => true ),
		"show_admin_column" => false,
	);
	register_taxonomy( "specialty", array( "counsellor" ), $args );
	
// End cptui_register_my_taxes
}

?>