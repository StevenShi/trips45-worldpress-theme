<?php
/**
 * trips45 functions and definitions
 *
 * @package trips45
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * Initialize Options Panel
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

if ( ! function_exists( 'trips45_setup' ) ) :

function trips45_setup() {

	load_theme_textdomain( 'trips45', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size('homepage-banner',750,450,true);

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'trips45' ),
	) );

	add_theme_support( 'custom-background', apply_filters( 'trips45_custom_background_args', array(
		'default-color' => '#fcfcfc',
		'default-image' => '',
	) ) );
}
endif; // trips45_setup
add_action( 'after_setup_theme', 'trips45_setup' );

function trips45_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'trips45' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'trips45' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'trips45' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'trips45' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'trips45_widgets_init' );

add_action('optionsframework_custom_scripts', 'trips45_custom_scripts');

function trips45_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php
}

function trips45_scripts() {
	//wp_enqueue_style( 'trips45-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,600' );
	wp_enqueue_style( 'trips45-basic-style', get_stylesheet_uri() );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('sidebar-layout', true) != 1) ) {
		if (of_get_option('sidebar-layout', true) ==  'right') {
			wp_enqueue_style( 'trips45-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
		}
		else {
			wp_enqueue_style( 'trips45-layout', get_template_directory_uri()."/css/layouts/sidebar-content.css" );
		}	
	}
	else {
		wp_enqueue_style( 'trips45-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
	}
			
	wp_enqueue_style( 'trips45-bootstrap-style', get_template_directory_uri()."/css/bootstrap/bootstrap.min.css", array('trips45-layout') );
		
	wp_enqueue_style( 'trips45-main-style', get_template_directory_uri()."/css/skins/main.css", array('trips45-layout','trips45-bootstrap-style') );
	
	wp_enqueue_script( 'trips45-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'trips45-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('slider_enabled') != 0) ) {
		wp_enqueue_style( 'trips45-nivo-slider-default-theme', get_template_directory_uri()."/css/nivo/slider/themes/default/default.css" );
	
		wp_enqueue_style( 'trips45-nivo-slider-style', get_template_directory_uri()."/css/nivo/slider/nivo.css" );
	}	
	
	if ( (function_exists( 'of_get_option' )) && (of_get_option('slider_enabled') != 0) ) {
		wp_enqueue_script( 'trips45-nivo-slider', get_template_directory_uri() . '/js/nivo.slider.js', array('jquery') );
	}
	wp_enqueue_script( 'trips45-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery','hoverIntent') );	
	
	wp_enqueue_script( 'trips45-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );	
	
	wp_enqueue_script( 'trips45-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'trips45-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	wp_enqueue_style( 'trips45-steve-custom-style', get_template_directory_uri()."/css/skins/custom.css", array('trips45-layout','trips45-bootstrap-style') );
	
}
add_action( 'wp_enqueue_scripts', 'trips45_scripts' );
function trips45_custom_head_codes() {
 if ( (function_exists( 'of_get_option' )) && (of_get_option('headcode1', true) != 1) ) {
	echo of_get_option('headcode1', true);
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>".of_get_option('style2', true)."</style>";
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('slider_enabled') != 0) ) {
	echo "<script>jQuery(window).load(function() { jQuery('#slider').nivoSlider({effect:'fade', pauseTime: 4500}); });</script>";
 }
}	
add_action('wp_head', 'trips45_custom_head_codes');

function trips45_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_page_menu_args', 'trips45_nav_menu_args' );

function trips45_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates. Import Widgets
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
