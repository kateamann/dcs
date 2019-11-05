<?php
/**
 * Helper Functions
 *
 * @package     DCS
 * @author      Kate Amann
 * @since       1.0.0
 * @license     GPL-2.0+
 */

/**
 * Add contact details shortcode
 */
// function display_contact_details() {
// 	$name = get_bloginfo('name');
// 	$street = get_field('address_street', 'option');
// 	$city = get_field('address_locality', 'option');
// 	$postcode = get_field('address_postal', 'option');
// 	$country = get_field('address_country', 'option');
// 	$phone = get_field('company_phone', 'options');
// 	$email = get_field('contact_email', 'options');

// 	if( $phone ) { 

// 		$contact_details = '<div class="contact-block">';
// 		$contact_details .= '<div class="phone"><i class="fas fa-phone"></i><a href="tel:44' . $phone . '">+44 ' . $phone . '</a></div>';
// 		$contact_details .= '<div class="email"><i class="fas fa-at"></i><a href="mailto:' . $email . '">' . $email . '</a></div>';
// 		$contact_details .= '<i class="fas fa-envelope"></i><div class="address">' . $name . '<br/>' . $street . '<br/>' . $city . '<br/>' . $postcode . '<br/>' . $country . '</div>';
// 		$contact_details .= '</div>';
// 	}

// 	return $contact_details;

// }
// add_shortcode( 'display-contact-info', 'display_contact_details' );


/**
 * Move Yoast to the Bottom
 */
function yoast_to_bottom() {
  return 'low';
}
//add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom');


/**
 * Yoast pagination link fix
 */
// add_filter( 'wpseo_genesis_force_adjacent_rel_home', '__return_true' );