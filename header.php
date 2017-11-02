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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo get_template_directory_uri();?>/assets/images/ico.png">	
	<?php wp_head(); ?>
	<style>
		.feature-section-wrapper{
			background-image: url(<?php echo get_template_directory_uri();?>/assets/images/pattern.svg);
		}
	</style>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<div class="site-inner">
			<a class="skip-link screen-reader-text" href="#content">Skip to content</a>

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

			<div id="content" class="site-content container">
