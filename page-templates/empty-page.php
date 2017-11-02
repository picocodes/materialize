<?php
/**
 * Template Name: Empty Page
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
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="profile" href="http://gmpg.org/xfn/11">
 	<link rel="icon" href="<?php echo get_template_directory_uri();?>/assets/images/ico.png">	
 	<?php wp_head(); ?>
	 <style>
		.main-feature-section{
			color: #fafafa;
			background: linear-gradient(to bottom, #00aadc 0%, rgba(0, 170, 220, 0) 30%, rgba(0, 170, 220, 0) 70%, #00aadc 100%), #00aadc url(<?php echo get_template_directory_uri();?>/assets/images/pattern.svg) fixed;
		}
		.conversion-feature-section{
			background: linear-gradient(to bottom, rgba(217, 242, 250, 0.03) 0%, rgba(180, 197, 203, 0) 30%, rgba(175, 179, 180, 0) 70%, rgba(243, 247, 248, 0.05) 100%), rgba(234, 245, 248, 0.1) url(<?php echo get_template_directory_uri();?>/assets/images/pattern.svg) fixed;
		}
	</style>

 </head>

<body <?php body_class(); ?>>
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
<?php wp_footer(); ?>
</body>
</html>
