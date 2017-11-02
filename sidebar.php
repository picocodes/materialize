<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Materialize
 */

global $post;
?>

<?php if ( ht_is_sidebar()) : ?>
	<aside id="secondary" class="sidebar sidebar-primary widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif;?>
