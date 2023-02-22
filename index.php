<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
	<div class="col-md-12 text-center">
		<h1 class="page-title screen-reader-text">Blog Immobili Ovunque</h1>
	</div>
	
	<?php get_template_part( 'template-parts/loop'); ?>
<?php
get_sidebar();
get_footer();
