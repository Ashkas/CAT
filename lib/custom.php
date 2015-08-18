<?php

//Get link from ACF fields
function get_cta_link( $text = '', $url = '', $class = NULL ) {
	
  $output = '';
  if(!empty($url) && !empty($text)) {
    $output = '<a href="'. $url .'" class="cta_button '.$class.'">'. $text .'</a>';
  }
  return $output;
}

function get_cta_link_alt( $text = '', $url = '', $class = NULL ) {
  $output = '';
  if(!empty($url) && !empty($text)) {
    $output = '<a href="'. $url .'" class="cta_button cta_button_alt '.$class.'">'. $text .'</a>';
  }
  return $output;
}

function get_cta_link_big( $text = '', $url = '' ) {
  $output = '';
  if(!empty($url) && !empty($text)) {
    $output = '<a href="'. $url .'" class="cta_button big_button">'. $text .'</a>';
  }
  return $output;
}

// From - http://css-tricks.com/snippets/wordpress/year-shortcode/
function year_shortcode() {
	$year = date('Y');
	return $year;
}
add_shortcode('year', 'year_shortcode');

// Allow SVG uploads
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Get image URL
function get_image_url($imgID, $size='full'){
  if(!empty($imgID)) {
    $url = wp_get_attachment_image_src($imgID,$size);
    return  $url[0];
  }
}

// Shortcode Function for Picturefill
// from: https://css-tricks.com/hassle-free-responsive-images-for-wordpress/

function ashkas_get_img_alt( $image ) {
    $img_alt = trim( strip_tags( get_post_meta( $image, '_wp_attachment_image_alt', true ) ) );
    return $img_alt;
}

function ashkas_get_picture_srcs( $image, $mappings ) {
    $arr = array();
    foreach ( $mappings as $size => $type ) {
        $image_src = wp_get_attachment_image_src( $image, $type );
        $arr[] = '<source srcset="'. $image_src[0] . '" media="(min-width: '. $size .'px)">';
    }
    return implode( array_reverse ( $arr ) );
}

function ashkas_responsive_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'imageid'    => 1,
        // You can add more sizes for your shortcodes here
        'size1' => 0,
        'size2' => 600,
        'size3' => 1000,
    ), $atts ) );

    $mappings = array(
        $size1 => 'small-img',
        $size2 => 'medium-img',
        $size3 => 'large-img'
    );

   return
        '<picture>
            <!--[if IE 9]><video style="display: none;"><![endif]-->'
            . ashkas_get_picture_srcs( $imageid, $mappings ) .
            '<!--[if IE 9]></video><![endif]-->
            <img srcset="' . wp_get_attachment_image_src( $imageid[0] ) . '" alt="' . ashkas_get_img_alt( $imageid ) . '">
        </picture>';
}


// Template function for PictureFill

function do_feature_picturefill ($image_id, $link = NULL, $size1="0", $size2="600", $size3="1000", $size4="1280") {
	$small = wp_get_attachment_image_src($image_id,'featured-small');
	$medium = wp_get_attachment_image_src($image_id,'featured-medium');
	$large = wp_get_attachment_image_src($image_id,'featured-large');
	$xlarge = wp_get_attachment_image_src($image_id,'featured-xlarge');
	$get_meta = get_post_meta($image_id);
	$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	if(empty($alt)){
		$alt = get_the_title($image_id);
	}
	$link = '';
	
	if($link):
		$link_open = '<a href="'.$link.'">';
		$link_close = '</a>';
	endif;
	
	return '
		<picture>
			'.$link_open.'
				<!--[if IE 9]><video style="display: none;"><![endif]-->
					<source srcset="'.$xlarge[0].'" media="(min-width: '.$size4.'px)" alt="'.$alt.'">
					<source srcset="'.$large[0].'" media="(min-width: '.$size3.'px)" alt="'.$alt.'">
					<source srcset="'.$medium[0].'" media="(min-width: '.$size2.'px)" alt="'.$alt.'">
				<!--[if IE 9]></video><![endif]-->
				<img srcset="'.$small[0].'" alt="'.$alt.'">
			'.$link_close.'
		</picture>';
}

function do_page_feature_picturefill ($image_id, $link = NULL, $size1="0", $size2="600", $size3="1000", $size4="1280") {
	$small = wp_get_attachment_image_src($image_id,'page-featured-small');
	$medium = wp_get_attachment_image_src($image_id,'page-featured-medium');
	$large = wp_get_attachment_image_src($image_id,'page-featured-large');
	$xlarge = wp_get_attachment_image_src($image_id,'page-featured-xlarge');
	$get_meta = get_post_meta($image_id);
	$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	if(empty($alt)){
		$alt = get_the_title($image_id);
	}
	$link = '';
	
	if($link):
		$link_open = '<a href="'.$link.'">';
		$link_close = '</a>';
	endif;
	
	return '
		<picture>
			'.$link_open.'
				<!--[if IE 9]><video style="display: none;"><![endif]-->
					<source srcset="'.$xlarge[0].'" media="(min-width: '.$size4.'px)" alt="'.$alt.'">
					<source srcset="'.$large[0].'" media="(min-width: '.$size3.'px)" alt="'.$alt.'">
					<source srcset="'.$medium[0].'" media="(min-width: '.$size2.'px)" alt="'.$alt.'">
				<!--[if IE 9]></video><![endif]-->
				<img srcset="'.$small[0].'" alt="'.$alt.'">
			'.$link_close.'
		</picture>';
}

function do_free_height_picturefill ($image_id, $link = NULL, $class = NULL, $size1="0", $size2="760") {
	$medium = wp_get_attachment_image_src($image_id,'medium');
	$large = wp_get_attachment_image_src($image_id,'large');
	$get_meta = get_post_meta($image_id);
	$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	if(empty($alt)){
		$alt = get_the_title($image_id);
	}
	$link = '';
	
	if($link):
		$link_open = '<a href="'.$link.'">';
		$link_close = '</a>';
	endif;
	
	if($class):
		$class = 'class="'.$class.'"';
	endif;
	
	return '
		<picture>
			'.$link_open.'
				<!--[if IE 9]><video style="display: none;"><![endif]-->
					<source srcset="'.$large[0].'" media="(min-width: '.$size2.'px)" alt="'.$alt.'">
				<!--[if IE 9]></video><![endif]-->
				<img srcset="'.$medium[0].'" alt="'.$alt.'" '.$class.'>
			'.$link_close.'
		</picture>';
}


// Filter images in the content to pull them out of the main div so they bleed full width
function filter_blockquote($content){
	$search = '/<blockquote>(.*?)<\/blockquote>/';
	
	//This is for large size image
	$replace = '</div><blockquote class="margin_auto">$1</blockquote><div class="col-md-10 col-lg-9 margin_auto no_padding">';
	
    return preg_replace($search, $replace, $content);
}
add_filter('the_content', 'filter_blockquote');

// Filter images in the content to pull them out of the main div so they bleed full width


// check if page has children - https://gist.github.com/lukaszklis/1247306
function has_children() {
	global $post;
	$children = get_pages('child_of=' . $post->ID);
	if( count( $children ) != 0 ) { return true; } // Has Children
    else { return false; } // No children
}

// Set up walkers for wp_list_pages, so I can show the short_name custom field if it exists http://www.456bereastreet.com/archive/201101/cleaner_html_from_the_wordpress_wp_list_pages_function/
class Short_Name_Walker extends Walker_Page {
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }
    function start_el(&$output, $page, $depth, $args, $current_page) {
        //Get the short_title if it is there
        if(get_field('short_title', $page->ID)) : 
			$title = get_field('short_title', $page->ID); 
		else: 
			$title = $page->post_title;
		endif;
        
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';
        extract($args, EXTR_SKIP);
        $class_attr = '';
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( (isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors)) || ( $page->ID == $current_page ) || ( $_current_page && $page->ID == $_current_page->post_parent ) ) {
                $class_attr = 'sel';
            }
        } elseif ( (is_single() || is_archive()) && ($page->ID == get_option('page_for_posts')) ) {
            $class_attr = 'sel';
        }
        if ( $class_attr != '' ) {
            $class_attr = ' class="' . $class_attr . '"';
            $link_before .= '<strong>';
            $link_after = '</strong>' . $link_after;
        }
        $output .= $indent . '<li' . $class_attr . '><a href="' . get_page_link($page->ID) . '"' . $class_attr . '>' . $link_before . apply_filters( 'the_title', $title, $page->ID ) . $link_after . '</a> |</li>';

        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;
            $output .= " " . mysql2date($date_format, $time);
        }
    }
}

// NAvigation

// Search form

function search_nav() {
	
	global $wp_query;
	
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="margin_bottom pagination" role="navigation">
			<div class="nav-previous float_left"><?php previous_posts_link( __( '<span class="icon-arrow-left" title="previous"></span> <span class="nav_text">Previous</span>', $wp_query->max_num_pages ) ); ?></div>
			<div class="nav-next float_right"><?php next_posts_link( __( '<span class="nav_text">Next</span> <span class="icon-arrow-right" title="next"></span>', $wp_query->max_num_pages ) ); ?></div>
			<div class="clearfix"></div>
		</nav> <!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}

// Confirm email in contact form
add_filter( 'wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 20, 2 );
 
function custom_email_confirmation_validation_filter( $result, $tag ) {
    $tag = new WPCF7_Shortcode( $tag );
 
    if ( 'your-email-confirm' == $tag->name ) {
        $your_email = isset( $_POST['your-email'] ) ? trim( $_POST['your-email'] ) : '';
        $your_email_confirm = isset( $_POST['your-email-confirm'] ) ? trim( $_POST['your-email-confirm'] ) : '';
 
        if ( $your_email != $your_email_confirm ) {
            $result->invalidate( $tag, "Your two email addresses are different. They must be the same." );
        }
    }
 
    return $result;
}

// Remove the taxonomies from the side column of the Counseollors edit screen

function remove_taxonomies_metaboxes() {
    remove_meta_box( 'tagsdiv-technique', 'counsellor', 'side' );
    remove_meta_box( 'tagsdiv-specialty', 'counsellor', 'side' );
}
add_action( 'add_meta_boxes' , 'remove_taxonomies_metaboxes' );



add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

        $title = single_cat_title( '', false );

    } elseif ( is_tag() ) {

        $title = single_tag_title( '', false );

    } elseif ( is_author() ) {

        $title = '<span class="vcard">' . get_the_author() . '</span>' ;

    } elseif (is_post_type_archive()){
        
        $title = post_type_archive_title( '', false );
    }
    
    elseif (is_tax()){
        
        $title = single_term_title( '', false );
    }

    return $title;
    
});