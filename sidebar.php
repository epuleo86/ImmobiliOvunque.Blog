<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-sm-12 col-lg-3 pl-lg-4 mt-4 mt-lg-0" role="complementary">
	<div class="row bg-light border rounded p-2 mb-3">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside>
