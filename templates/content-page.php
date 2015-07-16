<div class="col-md-10 col-lg-9 margin_auto content no_padding">
	<?php the_content($post->ID);?>
	<?php include(locate_template( 'flexible_content/block-2.php' ));   ?>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
