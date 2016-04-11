<?php //get ACF variables

if(function_exists('get_field')):
		
	$term = get_queried_object();
	$term_id = 'technique_'.$term->term_id;
	
	$content = get_field('taxonomy_content', $term_id);
	
endif;
	
if($content):?>

	<div class="col-md-10 col-lg-9 margin_auto content no_padding margin_bottom">
		<?php $search = '/<blockquote>(.*?)<\/blockquote>/';
	
		//This is for large size image
		$replace = '</div><blockquote class="margin_auto">$1</blockquote><div class="col-md-10 col-lg-9 margin_auto no_padding margin_bottom">';
		
	    echo preg_replace($search, $replace, $content); ?>
	</div>

<?php endif; // $content

query_posts($query_string . '&orderby=title&order=ASC');

if (!have_posts()) : ?>
	<div class="alert alert-warning">
		<h2 class="centre_text">Counsellors</h2>
		<div class="big_margin_bottom">
			<div class="col-sm-4 no_padding margin_auto">
				<a class="cta_button big_button" href="http://counsellingathome.com/counsellors/">Find A Counsellor</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php endif;

if (have_posts()) :
	
	$counter = 0;
	echo '<div class="row equal_height_items grid_items">';
	if($content) echo '<h2 class="centre_text">Counsellors</h2>';
	while (have_posts()) : the_post();
		
		get_template_part('templates/content-archive-counsellor', get_post_type() != 'post' ? get_post_type() : get_post_format());
		
		$counter++; 
		if ($counter%3 == 0) echo '</div><div class="row equal_height_items grid_items">';
		
	endwhile;
	echo '<div class="clearfix"></div>';
endif; 

$args = array(
	'hide_empty' => false,
);
			
$terms = get_terms( 'technique', $args );
							
if($terms):	
	echo '<div class="blocks big_margin_bottom '.$big_margin_top.'">';	
		echo '<div class="flex_row">';
		foreach( $terms as $term ) :
			
			$title = $term->name;
			$link = get_term_link($term->slug, 'technique');
			
			// If there was an error, continue to the next term.
		    if ( is_wp_error( $link ) ) {
		        continue;
		    }
			
			$excerpt = get_field('taxonomy_excerpt', $term->taxonomy.'_'.$term->term_id); ?>
			
			<section class="page_child_grid_item">
				<div class="wrap container">
			    	<div class="content big_margin_top big_margin_bottom">
						<h2> <a href="<?php echo esc_url($link); ?>" title="Continue reading about <?php echo $title; ?>"><?php echo $title; ?> </a></h2>
						<?php if($excerpt): echo $excerpt; endif; ?>
			    	</div>
				</div>
					
			</section>
			
			<?php $counter++; if ($counter%2 == 0) echo '</div><div class="flex_row">';
		endforeach;
	echo '</div>';

	echo '<div class="clearfix"></div>';
endif; //end $terms ?>