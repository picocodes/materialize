<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brendah
 */

get_header();
?>

	<div id="primary" class="main-content">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php if ( is_archive() ) : ?>
				<header>
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header>
			<?php endif; ?>


			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			if ( is_singular( 'attachment' ) ) {

				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in </span><span class="post-title">%title</span>', 'Parent post link', 'brendah' ),
				) );

			} elseif ( is_singular( 'post' ) ) {

				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true"></span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'brendah' ) . '</span> ' .
						'<span class="post-title">%title</span><i class="mdi-navigation-arrow-forward"></i>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="mdi-navigation-arrow-back"></i></span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'brendah' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );

			}

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'brendah' ),
				'next_text'          => __( 'Next page', 'brendah' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'brendah' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
