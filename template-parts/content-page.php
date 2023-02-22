<div class="col-md-12 text-center">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); 
		get_template_part( 'template-parts/breadcrumbs');
	?>
</div>

<?php 
	if ( is_active_sidebar('sidebar-1' )) {
		echo '<div class="col-lg-9">';
	}
	else{
		echo '<div class="col-lg-12">';
	}
?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</div>