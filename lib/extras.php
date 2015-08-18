<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (is_active_sidebar('sidebar-primary')) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

// Custom excerpt length
function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length',  __NAMESPACE__ . '\\custom_excerpt_length', 999 );

// Turn on excerpts for pages
function custom_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action('init',  __NAMESPACE__ . '\\custom_page_excerpts');

// Change wrapper for base for page
  add_filter('sage/wrap_base', __NAMESPACE__ . '\\sage_wrap_base_page'); // Add our function to the sage_wrap_base filter

  function sage_wrap_base_page($templates) {
    $page = is_page(); // Get the current post type
    if ($page) {
       array_unshift($templates, 'base-page.php'); // Shift the template to the front of the array
    }
    return $templates; // Return our modified array with base-$cpt.php at the front of the queue
  }
  
 // Change base for Custom Post Types
 // Ref: https://roots.io/sage/docs/theme-wrapper/
 add_filter('sage/wrap_base', __NAMESPACE__ . '\\sage_wrap_base_cpts'); // Add our function to the sage/wrap_base filter

  function sage_wrap_base_cpts($templates) {
    $cpt = get_post_type(); // Get the current post type
    if ($cpt) {
       array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
    }
    return $templates; // Return our modified array with base-$cpt.php at the front of the queue
  }
 
 
 ?>