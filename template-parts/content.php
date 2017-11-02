<?php
/**
 * The template part for displaying content
 *
 * @package ht
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'ht' ); ?></span>
		<?php endif; ?>

		<?php
			if ( is_singular() ) :

				the_title( '<h1 class="entry-title">', '</h1>' );

			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			endif;
		?>

		<p class="entry-meta">
			<?php ht_entry_meta(); ?>
		</p>
	</header><!-- .entry-header -->

	<?php ht_post_thumbnail(); ?>

	<div class="entry-content">
		<?php

		//Full content on single pages; excerpts otherwise
			if ( ! is_singular() ||  false !== get_post_format()) { 

				the_excerpt(  );

			} else {

				the_content(  );

			}

		//Takes care of multi-page posts
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ht' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'ht' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'ht' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
