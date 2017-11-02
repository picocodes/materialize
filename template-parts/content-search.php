<?php
/**
 * The template part for displaying content
 *
 * @package ht
 */

$classes =  '';
if ( 'product' === get_post_type() )
	$classes =  'woocommerce';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php
		if( 'product' === get_post_type() ) {
				
			ht_post_thumbnail();
				
		}
	?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
		<?php
			//Categories
			if ( 'post' === get_post_type() ) {
				
				$categories_list = get_the_category_list( _x( ' / ', 'Used between list items, there is a space after the foward slash.', 'ht' ) );
				if ( $categories_list ) {
					printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
						_x( 'Categories', 'Used before category names.', 'ht' ),
						$categories_list
					);
				}
			}
		?>
		
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		
		the_excerpt(  );
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
