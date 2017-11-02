<?php
/**
 * Template Name: Full Page
 *
 */
 ?>
 <!DOCTYPE html>
 <html <?php language_attributes(); ?> >
 <head>
 <meta charset="<?php bloginfo( 'charset' ); ?>">
 <!-- Global site tag (gtag.js) - Google Analytics -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108060896-1"></script>
	<script>
  		window.dataLayer = window.dataLayer || [];
  		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());

  		gtag('config', 'UA-108060896-1');
	</script>
 	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo get_template_directory_uri();?>/assets/images/ico.png">
	 <?php wp_head(); ?>
 </head>

 <body <?php body_class(); ?>>
 	<div id="page" class="site">
 		<div class="site-inner">
 			<!-- START HEADER -->
 			<header id="header" class="page-topbar">
         		<!-- start header nav-->
 				<nav class="navbar main-nav-bar">
 					<div class="container">
 					<a href="#" class="navbar-collapse"><svg id="icon-menu" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg">
 						<title>toggle menu</title>
 						<path d="M3 6h18v2.016h-18v-2.016zM3 12.984v-1.969h18v1.969h-18zM3 18v-2.016h18v2.016h-18z"></path>
 					</svg></a>

 					<p class="navbar-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

 					<?php
 						wp_nav_menu(array(
 							'theme_location' 	=> 'primary',
 							'fallback_cb' 		=> false,
 							'container' 		=> false,
 							'fallback_cb' 		=> false,
 							'items_wrap'     	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
 							'menu_class'     	=> 'alignright',
 							'menu_id'     		=> 'desktop-primary-menu',
 							'depth'             => 1,
 						));
 					?>
 					</div>
 				</nav>
 	 			<!-- end header nav-->

 				<?php
 					wp_nav_menu( array(
 						'theme_location' 	=> 'primary',
 						'fallback_cb' 		=> false,
 						'container' 		=> false,
 						'fallback_cb' 		=> false,
 						'items_wrap'     	=> '<ul id="%1$s" class="%2$s">%3$s </ul>',
 					 	'menu_class'     	=> 'side-nav',
 						'menu_id'     		=> 'mobile-primary-menu',
 						'depth'             => 1,
 					));

 				?>


 			</header>
   			<!-- END HEADER -->
		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) : the_post();
				the_content(  );
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="navbar footer-nav-bar">
			<div class="container">
				<span>Proudly powered by WordPress.</span>
			</div>
		</div><!-- .footer-copyright -->
	</footer><!-- .site-footer -->

</div><!-- .site-inner -->
</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>
