<?php

/**
 * Theme 404 Template
 *
 * Displays the 404 not found error message
 * when the requested content is not found.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Brendah
 * @since 1.1.0
 */

get_header(); ?>

	<div id="primary" class="content-area col l8 card float-none">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oooh No!', 'brendah' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'brendah' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
