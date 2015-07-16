<?php

//Get link from ACF fields
function get_cta_link( $text = '', $url = '' ) {
  $output = '';
  if(!empty($url) && !empty($text)) {
    $output = '<a href="'. $url .'" class="cta_button">'. $text .'</a>';
  }
  return $output;
}

function get_cta_link_alt( $text = '', $url = '' ) {
  $output = '';
  if(!empty($url) && !empty($text)) {
    $output = '<a href="'. $url .'" class="cta_button cta_button_alt">'. $text .'</a>';
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
            <noscript>' . wp_get_attachment_image( $imageid, $mappings[0] ) . ' </noscript>
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
				<noscript><img src="'.$large[0].'" alt="'.$alt.'"></noscript>
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
				<noscript><img src="'.$large[0].'" alt="'.$alt.'"></noscript>
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
				<noscript><img src="'.$large[0].'" alt="'.$alt.'"></noscript>
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
