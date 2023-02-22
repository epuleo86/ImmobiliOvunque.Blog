<div class="col-md-6 py-2 px-3 post-item">
	<div class="row bg-light">
		<div class="col-xl-5 p-0 post-excerpt-img">
			<div class="post-date">
				<?php
				$post_date = get_the_date('d/m');
				echo $post_date;
				?>
			</div>
			<div class="bg-light blog-image-fit-container">
				<?php 
				 $image_id = get_post_thumbnail_id(get_the_ID());
				 $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
				 $alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				 echo '<img src="'.esc_url($featured_img_url).'" width="373" height="300" alt="'.$alt_text.'"></img>'; 
				?>
			</div>
		</div>
		<div class="col-xl-7 px-4 py-4 post-excerpt-content align-self-center">
			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
			<?php
				$excerpt = get_the_excerpt();
				
				if (strlen($excerpt) > 250) {
				  $excerpt = substr($excerpt, 0, 250) . '...';
				}
				
				echo '<p>'.$excerpt.'</p>';
				
				$permalink = esc_url(get_permalink());
				echo '<span class="blog-read-more">Leggi Tutto</span>';
			?>
		</div>
	</div>
</div>