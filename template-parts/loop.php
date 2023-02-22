<?php 
global $wp_query;
$total_results = $wp_query->found_posts;
$paged_current_page = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$paged_maxnum = $GLOBALS['wp_query']->max_num_pages;

echo '<div class="col-md-12 text-center">';
	if(!is_home() && !is_search()){
		the_archive_title( '<h1 class="page-title">', '</h1>' );
	}
	else if(is_search()){ ?>
		<h1 class="page-title"><?php printf( esc_html__('Hai cercato: %s', 'wp-bootstrap-starter'), '<span>' . get_search_query() . '</span>' ); ?></h1>
	<?php 
	}
	
	get_template_part( 'template-parts/breadcrumbs');
	
	echo '</div>';
	
	if(!is_search()){
		the_archive_description( '<div class="col-12 archive-description px-0">', '</div>' );
	}

if ( is_active_sidebar('sidebar-1' )) {
	echo '<div class="col-lg-9">';
}
else{
	echo '<div class="col-lg-12">';
}

?>
	<div class="row mb-2">
		<?php
		if (have_posts()) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile;
			
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
	</div>
	
	<?php if(!is_home()):?>
	
	<div class="row flex-column align-items-center io-listing-pagination p-4 bg-light rounded border py-2">
	<p class="mb-1"><span><?php echo $paged_current_page .' - ' .$paged_maxnum ?></span> di <span><?php echo $total_results; ?></span> articoli </p>
	<?php the_posts_pagination(array(
		'prev_text' => __( '<span area-hidden="true">‹</span><span class="sr-only">Previous</span>' ),
		'next_text' => __( '<span area-hidden="true">›</span><span class="sr-only">Next</span>' ),
	)); ?>
	</div>
	<?php endif;?>
</div>