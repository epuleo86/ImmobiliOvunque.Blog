<?php 
	 add_action( 'wp_enqueue_scripts', 'immobili_ovunque_enqueue_styles_scripts' );
	 function immobili_ovunque_enqueue_styles_scripts() {
 		  //wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
		  //wp_enqueue_style('style',  get_stylesheet_directory_uri() .'/style.css', 'all');
		  wp_enqueue_style('style',  get_stylesheet_directory_uri() .'/asset/css/fontello.css');
		  wp_enqueue_script( 'jquery-ui-autocomplete');
		  wp_enqueue_script( 'script', get_stylesheet_directory_uri() .'/asset/js/scripts.js', array ( 'jquery' ), 1.0, true);
	  }
	  
	  function releadted_posts_by_category() {

		$post_id = get_the_ID();
		$cat_ids = array();
		$categories = get_the_category( $post_id );

		if(!empty($categories) && !is_wp_error($categories)):
			foreach ($categories as $category):
				array_push($cat_ids, $category->term_id);
			endforeach;
		endif;

		$current_post_type = get_post_type($post_id);

		$query_args = array( 
			'category__in'   => $cat_ids,
			'post_type'      => $current_post_type,
			'post__not_in'    => array($post_id),
			'posts_per_page'  => '6',
		 );

		$related_cats_post = new WP_Query($query_args);

		if($related_cats_post->have_posts()){
			echo '<aside class="p-2 mt-2"><h2 class="page-title text-center my-2">Ti potrebbe interessare anche</h2><div class="row">';
			
			while($related_cats_post->have_posts()): $related_cats_post->the_post();
				get_template_part( 'template-parts/loop-item', get_post_format() );
			endwhile;
			wp_reset_postdata();
			echo '</div></aside>';
		}
	}
	
	function sanitize_pagination($content) {
	  // Remove h2 tag
	  $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);
	  return $content;
	}

	add_action('navigation_markup_template', 'sanitize_pagination');
	
	function io_filter_search($atts = [], $content = null, $tag = '') { 
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );
 
		$wporg_atts = shortcode_atts(
			array(
				'title' => 'Titolo',
				'categories' => '1',
				'posts_per_page' => '6',
				'readmore' => 'false',
				'readmore_title' => 'Leggi altro',
			), $atts, $tag
		);
		
		$title = esc_html__( $wporg_atts['title'], 'io-search');
		$cat_ids =  explode(",", $wporg_atts['categories']);
		$query_args = array( 
			'category__in'   => $cat_ids,
			'post_type'      => 'post',
			'posts_per_page'  => $wporg_atts['posts_per_page'],
		 );
		
		$posts = new WP_Query($query_args);
		
		echo '<h2 class="page-title text-center my-2">' . $title . '</h2>';
		
		if($posts->have_posts()){
			echo '<div class="row mb-5">';
			
			while($posts->have_posts()): $posts->the_post();
				get_template_part('template-parts/loop-item', get_post_format() );
			endwhile;
			wp_reset_postdata();
			
			if($wporg_atts['readmore'] == 'true'){
				$category_link = get_category_link($cat_ids[0]);
				echo '<div class="col-12 text-center">';
				echo '<a class="btn btn-io-orange rounded-pill px-5" href="' . $category_link .  '">' .$wporg_atts['readmore_title']. '</a>';
				echo '</div>';
			}
			
			echo '</div>';
		}	 
	} 
	
	add_shortcode('io-filter-search', 'io_filter_search'); 
	
	function io_search_bar($atts = [], $content = null, $tag = '') { 
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );
 
		$wporg_atts = shortcode_atts(
			array(
				'id' => 'searchform',
				'class' => '',
				'title' => '',
				'input_class' => '',
			), $atts, $tag
		);
		
		$class = $wporg_atts['class'];
		
		if(strlen($class) > 0){
			echo '<div class="'.$class.'">';
		}
		
		$title = $wporg_atts['title'];
			
		if(strlen($title) > 0){
			echo '<div class="text-center w-100 mt-2"><h3 class="widget-title">'.$title.'</h3></div>';
		}
		
		echo '<form id="'.$wporg_atts['id'].'" method="get" action="'.esc_url(home_url( '/' )).'">';
		echo '<div class="' .$wporg_atts['id']. '-container">';
		echo '<input type="search" class="search-field '.$wporg_atts['input_class'].'" name="s" placeholder="Cerca" value="'.get_search_query().'" required>';
		echo '<button type="submit" title="Cerca" aria-label="Cerca"><i class="fa fa-search" aria-hidden="true"></i></button>';
		echo '</div>';
		echo '</form>';
		
		if(strlen($class) > 0){
			echo '</div>';
		}
	}
	
	add_shortcode('io-search-bar', 'io_search_bar'); 
	
	if (!is_admin()) {
		function wpb_search_filter($query) {
			if ($query->is_search) {
				$query->set('post_type', 'post');
			}
			return $query;
		}
		
		add_filter('pre_get_posts','wpb_search_filter');
	}
	
	function io_social($atts = [], $content = null, $tag = '') {
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );
 
		$wporg_atts = shortcode_atts(
			array(
				'title' => '',
				'channels' => 'facebook,instagram,linkedin',
			), $atts, $tag
		);
		
		$title = $wporg_atts['title'];
		$channels =  explode(",",  $wporg_atts['channels']);
		
		if(count($channels) > 0){			
			if(strlen($title) > 0){
				echo '<div class="text-center w-100 mt-2"><h3 class="widget-title">'.$title.'</h3></div>';
			}
			
			echo '<div class="d-flex flex-row w-100 justify-content-center mb-2 social-container">';
			
			$link;
			$iconClass;
			
			foreach ($channels as &$channel) {
				$link = '';
				$iconClass = '';
				
				$channel = strtolower(trim($channel));
				
				switch($channel){
					case 'facebook':
						$link = 'https://www.facebook.com/immobiliovunquesrl/';
						$iconClass ='fab fa-facebook';
					break;
					case 'instagram':
						$link = 'https://www.instagram.com/immobiliovunque/';
						$iconClass ='fab fa-instagram';
					break;
					case 'linkedin':
						$link = 'https://www.linkedin.com/company/immobili-ovunque/';
						$iconClass ='fab fa-linkedin';
					break;
				}
				
				if(strlen($link) > 0 && strlen($iconClass) > 0){
					echo '<a class="social-icon p-1 text-decoration-none '.$channel.'" href="'.$link.'" target="_blank" rel="nofollow"><i class="'.$iconClass.'"></i></a>';
				}
			}
			
			echo '</div>';
		}
	}
	
	add_shortcode('io-social', 'io_social'); 
	
	function io_search_form($atts = [], $content = null, $tag = '') {
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );
 
		$wporg_atts = shortcode_atts(
			array(
				'title' => '',
			), $atts, $tag
		);
		
		$title = $wporg_atts['title'];
			
		if(strlen($title) > 0){
			echo '<div class="text-center w-100 mt-2"><h3 class="widget-title">'.$title.'</h3></div>';
		}
		
		get_template_part('template-parts/search-form');
	}
	
	add_shortcode('io-search-form', 'io_search_form'); 
	
	function wpdocs_dequeue_script() {
		wp_dequeue_script('wp-bootstrap-starter-themejs');
		wp_dequeue_script('wp-bootstrap-starter-skip-link-focus-fix');
		wp_dequeue_script('wp-polyfill');
		wp_deregister_script( 'wp-embed' );
		//wp_deregister_script( 'wp-polyfill' );
	}
	add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );
	
	/**
	* Disable the emoji's
	*/
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
	}
	add_action( 'init', 'disable_emojis' );

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 * 
	 * @param array $plugins 
	 * @return array Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}

	/**
	 * Remove emoji CDN hostname from DNS prefetching hints.
	 *
	 * @param array $urls URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed for.
	 * @return array Difference betwen the two arrays.
	 */
	function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}

		return $urls;
	}
	
	add_filter('term_links-post_tag','limit_to_five_tags');
	function limit_to_five_tags($terms) {
		return array_slice($terms,0,5,true);
	}
	
	add_filter('get_the_archive_title_prefix','__return_false');
	
 ?>