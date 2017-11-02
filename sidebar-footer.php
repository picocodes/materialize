<?php if (
			(
				!is_page( 'my-account' ) &&
				!is_page( 'checkout' ) &&
				is_active_sidebar( 'sidebar-2' )
			) || is_customize_preview()) : ?>
	<aside id="footer-widget" class="footer-widget-area widget-area container" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif;
