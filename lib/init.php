<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
		'primary_navigation' => __('Primary Navigation', 'sage'),
		'secondary_nav_1' => __('Secondary Navigation 1', 'sage'),
		'secondary_nav_2' => __('Secondary Navigation 2', 'sage'),
		'secondary_nav_3' => __('Secondary Navigation 3', 'sage'),
		'secondary_nav_4' => __('Secondary Navigation 4', 'sage'),
		'secondary_nav_5' => __('Secondary Navigation 5', 'sage'),
		'secondary_nav_6' => __('Secondary Navigation 6', 'sage'),
		//'counsellors_nav' => __('Counsellors Navigation', 'sage'),
	)
  );

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_filter( 'jpeg_quality', create_function( '', 'return 75;' ) );

  // set_post_thumbnail_size(150, 150, false);
  add_image_size('profile-thumb', 480, 360, array('center', 'center'));
  add_image_size('featured-small', 480, 270, array('center', 'center'));
  add_image_size('featured-medium', 820, 461, array('center', 'center'));
  add_image_size('page-featured-medium', 820, 350, array('center', 'center'));
  add_image_size('featured-large', 1240, 697, array('center', 'center'));
  add_image_size('page-featured-large', 1240, 400, array('center', 'center'));  
  add_image_size('banner-large', 1240, 806, array('center', 'center'));  
  add_image_size('featured-xlarge', 1440, 810, array('center', 'center'));
  add_image_size('page-featured-xlarge', 1440, 450, array('center', 'center')); 
  add_image_size('banner-xlarge', 1440, 936, array('center', 'center'));

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style(Assets\asset_path('styles/editor-style.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');




/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<div class="widget footer_widget %1$s %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
