<?php
/**
 * DCS.
 *
 * This file adds the WooCommerce styles and the Customizer additions for WooCommerce to the DCS Theme.
 *
 * @package DCS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_filter( 'woocommerce_enqueue_styles', 'dcs_woocommerce_styles' );
/**
 * Enqueues the theme's custom WooCommerce styles to the WooCommerce plugin.
 *
 * @param array $enqueue_styles The WooCommerce styles to enqueue.
 * @since 2.3.0
 *
 * @return array Modified WooCommerce styles to enqueue.
 */
function dcs_woocommerce_styles( $enqueue_styles ) {

	$enqueue_styles['dcs-woocommerce-styles'] = array(
		'src'     => get_stylesheet_directory_uri() . '/woocommerce/dcs-woocommerce.css',
		'deps'    => '',
		'version' => CHILD_THEME_VERSION,
		'media'   => 'screen',
	);

	return $enqueue_styles;

}