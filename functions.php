<?php

if ( ! function_exists( 'ht_setup' ) ) :

/**
 * Registers support for various Theme features.
 *
 * Create a function called ht_setup() in your child theme to overide this.
 *
 * @since 1.0.0
 *
 * @return void
 */

 function ht_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Tells WordPress that this theme does not explitely define a title tag
	add_theme_support( 'title-tag' );

	// This theme is html5 compliant
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Post thumbnails
	set_post_thumbnail_size( 540, 270, true );

	// Add theme styles to the visual editor
	add_editor_style( array( 'editor-style.css') );

	// Register a nav menu
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ht' ),
	) );

	//Set the content width
	$GLOBALS['content_width'] = 540;

	//Disable emojis && embeds to speed up the site
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
 }

endif; // ht_setup
add_action( 'after_setup_theme', 'ht_setup', 9 );


/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since ht 1.0.0
 */
function ht_widgets_init() {

	//Main sidebar that appears to the rigt/left of the content area
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ht' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'ht' ),
		'before_widget' => '<section id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Footer sidebar
	register_sidebar( array(
		'name'          => __( 'Footer', 'ht' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'ht_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since ht 1.0.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function ht_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading <span class="screen-reader-text"> "%s"</span>', 'ht' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'ht_excerpt_more' );


/**
 * Enques stylesheets and script files.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since ht 1.0.0
 */
function ht_scripts() {

	//Remove hubaga scripts and styles
	wp_dequeue_script( 'hubaga_js' );
	wp_dequeue_script( 'hubaga_instacheck' );
	wp_dequeue_style( 'hubaga_css' );

 	// Main theme stylesheet.
	wp_enqueue_style( 'ht-style', get_template_directory_uri() . '/style.min.css', array(), '1.0.1' );

	//cdn jQuery
	wp_enqueue_script( 'cdnjs-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), '2.2.4', true );

	// Load the materialize js
	$params = array(
		'ajaxurl' 				=> admin_url( 'admin-ajax.php' ),
		'nonce'					=> wp_create_nonce( 'hubaga_nonce' ),
		'empty_coupon'			=> __( 'Please provide a coupon code first.', 'hubaga' ),
		'coupon_error'  		=> __( 'Unable to apply this coupon.', 'hubaga' ),
	);
	wp_register_script( 'materialize_script', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'cdnjs-jquery' ), '1.0.0', true );
	wp_localize_script( 'materialize_script', 'i18', $params );
	wp_enqueue_script( 'materialize_script' );
	//wp_enqueue_script( 'ht-script', get_template_directory_uri() . '/assets/js/brendah.js', array('jquery'), '3.7.3', true );

}
add_action( 'wp_enqueue_scripts', 'ht_scripts', 100 );

/**
 * defer script loading
 */
function ht_defer_scripts( $tag ){
	if(is_admin()){
		return $tag;
	}
	return str_ireplace( ' src', ' defer src', $tag );
}
add_filter( 'script_loader_tag', 'ht_defer_scripts');

/**
 * Removes query strings from static resources
 */
function ht_remove_query_strings( $src ){
	$parts = explode( '?', $src);
	return $parts[0];
}
add_filter( 'script_loader_src', 'ht_remove_query_strings',  10);
add_filter( 'style_loader_src', 'ht_remove_query_strings', 10);

if ( ! function_exists( 'ht_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 */
function ht_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	?>
	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>
	<?php

}
endif;

if ( ! function_exists( 'ht_entry_meta' ) ) :
/**
 * Prints HTML with meta information for author, date etc.
 *
 */
function ht_entry_meta() {

	//Display author information on posts only
	if ( 'post' === get_post_type() ) {

		$author_avatar_size = apply_filters( 'ht_author_avatar_size', 36 );
		printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%2$s </span> <strong>%4$s</strong></span></span>',
			get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
			_x( 'Author', 'Used before post author name.', 'ht' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);

	}

	//The date
	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		ht_entry_date();
	}

}
endif;

if ( ! function_exists( 'ht_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own ht_entry_date() function to override in a child theme.
 *
 * @since ht 1.0
 */
function ht_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published screen-reader-text" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( ' | <span class="posted-on"><span>%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Last Updated', 'Used before publish date.', 'ht' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

add_shortcode( 'shoutout', 'ht_shoutout' );
function ht_shoutout( $atts, $content){
	$settings = ( shortcode_atts( array(
		'style' => 'default',
		'class' => '',
	), $atts ) );

	$content = do_shortcode( $content );
	$class = $settings['class'];
	$style = $settings['style'];
	$shoutout = "<div class='shoutout shoutout-$style $class'>$content</div>";
	return $shoutout;
}

add_shortcode( 'callout', 'ht_callout' );
function ht_callout( $atts, $content){
	$settings = ( shortcode_atts( array(
		'type' => 'tip',
	), $atts ) );

	$content = do_shortcode( $content );
	$type = $settings['type'];
	$shoutout = "<div class='callout callout-$type'><p>$content</p></div>";
	return $shoutout;
}

add_shortcode( 'code', 'ht_code' );
function ht_code( $atts, $content){
	$settings = ( shortcode_atts( array(
		'lang' => 'php'
	), $atts ) );

	$lang = $settings['lang'];
	return "<pre class='language-$lang'><code>$content</code></pre>";

}

add_shortcode( 'doc', 'ht_doc_shortcode' );
function ht_doc_shortcode( $atts ){
	$settings = ( shortcode_atts( array(
		'tag' => ''
	), $atts ) );

	$term = term_exists( $settings['tag'], 'doc_group' );
	if(! is_array( $term ) ) {
		return "Documentation tag not found";
	}

	$posts = get_posts( array(
		'numberposts'   => -1,
		'post_type'		=> 'doc_parts',
		'orderby'		=> 'date',
		'order'			=> 'ASC',
		'tax_query'		=> array(
			array(
				'field'    => 'term_id',
				'taxonomy' => 'doc_group',
				'terms'    => array( $term['term_id'] ),
			)
		)
	) );

	if( empty($posts) ){
		return "No doc parts in this tag";
	}

	$return = '';
	foreach( $posts as $post ){

		$content 	= $post->post_content;
		$title 		= $post->post_title;
		if( $title ) {
			$id			 = sanitize_html_class( $title );
			$return 	.= "<div id='$id'><h2>$title</h2>";
		}

		if( $content ) {
			$return 	.= "$content";
		}

		if( $title ) {
			$return 	.= "</div><p class='toc-jump'><a href='#header'>Top ↑</a></p>";
		}

	}

	return apply_filters( 'the_content', $return, $post->ID );

}

add_shortcode( 'doc_menu', 'ht_doc_menu_shortcode' );
function ht_doc_menu_shortcode( $atts ){
	$settings = ( shortcode_atts( array(
		'tag' => ''
	), $atts ) );

	$term = term_exists( $settings['tag'], 'doc_group' );
	if(! is_array( $term ) ) {
		return '';
	}

	$posts = get_posts( array(
		'numberposts'   => -1,
		'post_type'		=> 'doc_parts',
		'orderby'		=> 'date',
		'order'			=> 'ASC',
		'tax_query'		=> array(
			array(
				'field'    => 'term_id',
				'taxonomy' => 'doc_group',
				'terms'    => array( $term['term_id'] ),
			)
		)
	) );



	if( empty($posts) ){
		return '';
	}

	$return = '<ul class="docmenu list-group list-group-menu">';
	foreach( $posts as $post ){

		$title 		= $post->post_title;
		if( $title ) {
			$id			 = sanitize_html_class( $title );
			$return 	.= "<li class='list-group-item'><a href='#$id'>$title</a></li>";
		}

	}
	$return 	.= "</ul>";
	return $return;

}

add_shortcode( 'btn', 'ht_btn' );
function ht_btn( $atts, $content){
	$settings = ( shortcode_atts( array(
		'url' => '#',
		'class' => '',
	), $atts ) );

	$content = do_shortcode( $content );
	$class = $settings['class'];
	$url = $settings['url'];
	$btn = "<a href='$url' class='btn $class'>$content</a>";
	return $btn;
}


add_filter( 'show_admin_bar', '__return_false', 100 );

function ht_add_metabox(){
	add_meta_box(
		'ht_sidebar_shortcode',
		'Sidebar Shortcode',
		'ht_print_metabox',
		null,
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ht_add_metabox' );

function ht_print_metabox( $post ){

	$value = esc_textarea( get_post_meta( $post->ID, 'ht_sidebar_shortcode', true ) );
	if(! $value ) {
		$value = '';
	}
	wp_nonce_field('ht_sidebar_shortcode_inner_custom_box','ht_sidebar_shortcode_inner_custom_box_nonce');
	echo "
		<label class='screen-reader-text' for='ht_sidebar_shortcode'>
			Sidebar shortcode
		</label>
		<textarea name='ht_sidebar_shortcode' rows='5'>$value</textarea>";
}

function ht_save_metabox( $post_id, $post ){
	//Check for the security nonce . This also ensures that we are saving a product post
	if(!isset( $_POST['ht_sidebar_shortcode_inner_custom_box_nonce'])) {
		return $post_id;
	}

	//Then validate it
	if( !wp_verify_nonce( $_POST['ht_sidebar_shortcode_inner_custom_box_nonce'], 'ht_sidebar_shortcode_inner_custom_box') ) {
		return $post_id;
	}

	//Finally if its not an autosave; we save the metabox
	if ( defined( 'DOUNG_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if( !empty( $_POST['ht_sidebar_shortcode'] ) ) {
		update_post_meta( $post->ID, 'ht_sidebar_shortcode', $_POST['ht_sidebar_shortcode'] );
	}
}
add_action( 'save_post', 'ht_save_metabox', 10, 2 );

function ht_register_post_types(){
	if ( ! is_blog_installed() || post_type_exists( 'doc_parts' ) ) {
			return;
	}

	register_post_type( 'doc_parts'	, array(
			'labels'              =>

				array(
					'name'                  => __( 'Docpart', 'picommerce' ),
					'singular_name'         => __( 'Docpart', 'picommerce' ),
					'menu_name'             => _x( 'Docpart', 'Admin menu name', 'picommerce' ),
					'add_new'               => __( 'Add docpart', 'picommerce' ),
					'add_new_item'          => __( 'Add new docpart', 'picommerce' ),
					'edit'                  => __( 'Edit', 'picommerce' ),
					'edit_item'             => __( 'Edit docpart', 'picommerce' ),
					'new_item'              => __( 'New docpart', 'picommerce' ),
					'view'                  => __( 'View docpart', 'picommerce' ),
					'view_item'             => __( 'View docpart', 'picommerce' ),
					'search_items'          => __( 'Search docparts', 'picommerce' ),
					'not_found'             => __( 'No docparts found', 'picommerce' ),
					'not_found_in_trash'    => __( 'No docparts found in trash', 'picommerce' ),
					'insert_into_item'      => __( 'Insert into docpart', 'picommerce' ),
					'uploaded_to_this_item' => __( 'Uploaded to this docpart', 'picommerce' ),
					'filter_items_list'     => __( 'Filter docparts', 'picommerce' ),
				),

			'description'         => __( 'A documentation part.', 'picommerce' ),
			'public'              => false,
			'show_ui'             => true,
			'map_meta_cap'        => true,
			'hierarchical'        => false, // Hierarchical causes memory issues - WP loads all records!
			'query_var'           => true,
			'has_archive'         => false,
			'show_in_nav_menus'   => false,
			'taxonomies' 		  => array('doc_group'),
			'show_in_rest'        => false,
	) );

	register_post_type( 'docs'	, array(
			'labels'              =>

				array(
					'name'                  => __( 'Documentation', 'picommerce' ),
					'singular_name'         => __( 'Documentation', 'picommerce' ),
					'menu_name'             => _x( 'Documentation', 'Admin menu name', 'picommerce' ),
					'add_new'               => __( 'Add documentation', 'picommerce' ),
					'add_new_item'          => __( 'Add new documentation', 'picommerce' ),
					'edit'                  => __( 'Edit', 'picommerce' ),
					'edit_item'             => __( 'Edit documentation', 'picommerce' ),
					'new_item'              => __( 'New documentation', 'picommerce' ),
					'view'                  => __( 'View documentation', 'picommerce' ),
					'view_item'             => __( 'View documentation', 'picommerce' ),
					'search_items'          => __( 'Search documentations', 'picommerce' ),
					'not_found'             => __( 'No documentations found', 'picommerce' ),
					'not_found_in_trash'    => __( 'No documentations found in trash', 'picommerce' ),
					'insert_into_item'      => __( 'Insert into documentation', 'picommerce' ),
					'uploaded_to_this_item' => __( 'Uploaded to this documentation', 'picommerce' ),
					'filter_items_list'     => __( 'Filter documentations', 'picommerce' ),
				),

			'description'         => __( 'A documentation post type.', 'picommerce' ),
			'public'              => true,
			'map_meta_cap'        => true,
			'hierarchical'        => false, // Hierarchical causes memory issues - WP loads all records!
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
			'has_archive'         => true,
			'taxonomies' 		  => array('doc-category'),
			'show_in_rest'        => true,
	) );

	register_taxonomy( 'doc_group', 'doc_parts', array(
		'hierarchical' 		=> false,
		'rewrite' 			=> false,
		'public' 			=> false,
		'show_ui' 			=> true,
		'show_admin_column' => true,
		'show_in_rest' 		=> false,
	) );

	register_taxonomy( 'doc-category', 'docs', array(
		'hierarchical' 		=> false,
		'rewrite' 			=> true,
		'public' 			=> true,
		'show_in_rest' 		=> true,
	) );

}
add_action( 'init', 'ht_register_post_types' );

function ht_is_sidebar(){
	return (
		!hubaga_is_account_page() &&
		!hubaga_is_checkout_page() &&
		is_active_sidebar( 'sidebar-1' )
	) || is_customize_preview();
}

/**
 * Filters the body classes
 */
function ht_body_classes( $classes ) {

	//Sidebars
	if( ht_is_sidebar() ){
		$classes[] = 'has-sidebar';
	} else {
		$classes[] = 'has-no-sidebar';
	}

	//Checkout page
	if(hubaga_is_checkout_page()){
		$classes[] = 'hubaga-is-checkout';
	}

	//Account page
	if(hubaga_is_account_page()){
		$classes[] = 'hubaga-is-account';
	}

	return $classes;
}
add_filter( 'body_class', 'ht_body_classes' );

add_action( 'hubaga_checkout_form', 'hts_create_trust_seals', 50 );
function hts_create_trust_seals(){
	echo "<div style='padding: 2em;color: #09745b;'>We have a 30 day no questions asked money back gurantee.</div>";
}


