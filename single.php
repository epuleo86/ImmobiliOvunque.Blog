<?php
get_header(); ?>
<?php
	if ( have_posts() ) : the_post(); 
		echo '<div class="col-md-12 text-center">';
			the_title( '<h1 class="page-title">', '</h1>' );
			get_template_part( 'template-parts/breadcrumbs');
		echo '</div>';
?>
		<div class="content-area col-sm-12 col-lg-9 p-0">
			<?php
				$image_id = get_post_thumbnail_id($post->Id);
				$featured_img_url = get_the_post_thumbnail_url($post->Id,'full');
				$alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				echo '<img class="img-fluid w-100 py-2" src="'.esc_url($featured_img_url).'" width="373" height="300" alt="'.$alt_text.'"></img>';  
			?>
			
			<div class="col-md-12 page-description mt-2 px-0">
				<?php the_content(); ?>
			</div>
			
			<hr class="solid mt-5">
			
			<div class="col-md-12 px-0">
				<p class="entry-date">Data di pubblicazione: <?php echo get_the_date(); ?></p>
				<p>Categoria:</p>
				<?php the_category() ?>
			</div>
			
			<div class="col-md-12 px-0">
				<?php the_tags('Tags: ') ?>
			</div>
			
			<hr class="solid">
			
			<?php
				$prevPostTitle = get_previous_post()->post_title;
				$nextPostTitle = get_next_post()->post_title;
			
				if (strlen($prevPostTitle) > 0 || strlen($nextPostTitle)):
			?>
			
				<div class="row mt-4 prev-next-post">
					<?php if(strlen($prevPostTitle) > 0):?>
						<div class="col-lg-6 d-flex justify-content-lg-start">
							<?php previous_post_link(); ?> 
						</div>
					<?php endif; ?>
					
					<?php if(strlen($nextPostTitle) > 0):?>
						<?php if(strlen($prevPostTitle) > 0):?>
							<div class="col-lg-6 d-flex justify-content-lg-end mt-2 mt-lg-0">
						<?php else: ?>
							<div class="col-lg-12 d-flex justify-content-lg-end mt-2 mt-lg-0">
						<?php endif; ?>
							<?php next_post_link(); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			
			<?php releadted_posts_by_category();?>
		</div>
	<?php endif; ?>
<?php
get_sidebar();
get_footer();
