<?php
/**
 * Genesis Changes
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
 */

// Theme Supports
add_theme_support( 'html5', array( 
	'search-form', 
	'comment-form', 
	'comment-list', 
	'gallery', 
	'caption' 
) );

add_theme_support( 'genesis-responsive-viewport' );

add_theme_support( 'genesis-footer-widgets', 3 );

add_theme_support( 'genesis-structural-wraps', array( 
	'header', 
	'menu-primary',
	'menu-secondary', 
	'site-inner', 
	'footer-widgets', 
	'footer' 
) );

add_theme_support( 'genesis-menus', array( 
	'primary' => 'Primary Navigation Menu', 
	'secondary' => 'Secondary Navigation Menu', 
) );

// Adds support for accessibility.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
	'screen-reader-text',
) );

// Remove Genesis Layout Settings
remove_theme_support( 'genesis-inpost-layouts' );

// Remove Genesis Scripts Settings
add_action( 'admin_menu' , 'remove_genesis_page_post_scripts_box' );
function remove_genesis_page_post_scripts_box() {

	$types = array( 'post','page' );

	remove_meta_box( 'genesis_inpost_scripts_box', $types, 'normal' ); 
}

// Remove Genesis in-post SEO Settings
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

// Remove Edit link
add_filter( 'genesis_edit_post_link', '__return_false' );

// Remove Genesis Favicon (use site icon instead)
remove_action( 'wp_head', 'genesis_load_favicon' );

// Remove Header Description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove sidebar layouts
unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar-alt' );


//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Right sidebar layout on blog
function dcs_blog_sidebar() {
	if ( is_home() || is_singular('post') || is_archive() ) {
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
	}
}
add_action( 'get_header', 'dcs_blog_sidebar' );


//* Remove the author box on single posts
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

/**
 * Remove Genesis Templates
 *
 */
function dcs_remove_genesis_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'dcs_remove_genesis_templates' );


/**
 * Add featured hero image
 *
 */
add_action( 'genesis_after_header', 'dcs_featured_image', 10 );
function dcs_featured_image() {

	if ( !has_post_thumbnail() || is_home() || is_archive() || is_singular( array( 'post', 'people', 'courses', 'partners') ) ) { 
		return;
	} elseif ( is_front_page() ) { 

		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

		?>

		<div class="page-hero">
			<?php the_post_thumbnail('1800-hero'); ?>
			<div class="hero-overlay">
				<div class="wrap">
				<?php genesis_do_post_title(); ?>
				</div>
			</div>
		</div>

		<?php
	}

	else { ?>
		<div class="page-hero">
			<?php the_post_thumbnail('1800-hero'); ?>
		</div>
		<?php
	}		
}

//* Modify the WordPress read more link
add_filter( 'the_content_more_link',  'core_read_more_link' );
function core_read_more_link() {
	return '<strong><a class="more-link" href="' . get_permalink() . '">Read more <i class="fas fa-angle-double-right"></i></a></strong>';
}

//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'read_more_link' );
function read_more_link() {
return '<strong><a class="more-link" href="' . get_permalink() . '">Read more <i class="fas fa-angle-double-right"></i></a></strong>';
}