<?php
/**
 * Company Schema
 *
 * @package     DCS
 * @author      Kate Amann
 * @since       1.0.0
 * @license     GPL-2.0+
 */


/**
 * Adds company data admin page 
 * `options_page` is going to be the name of ACF group we use to set up the fields
 *  
 * @url https://github.com/PascalAOMS/wp-acf-schema-template
 * 
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Company Data',
        'menu_title' => 'Company Data',
        'menu_slug'  => 'company-data',
        'capability' => 'edit_posts',
        'redirect'   => false
    ));
}



/**
 * Adds json schema markup to front page 
 * 
 */

add_action( 'wp_head' , 'add_schema_markup' );

function add_schema_markup() {

	if ( is_front_page() ) {
		company_data_schema();
	} 
}

function company_data_schema() {

    $schema = array(
        '@context'  => "http://schema.org",
        '@type'     => get_field('schema_type', 'options'),
        'name'      => get_bloginfo('name'),
        'url'       => get_home_url(),
        'logo'      => get_field('company_logo', 'option'),
        'image'     => get_field('company_logo', 'option'),
        'telephone' => '+44' . get_field('company_phone', 'options'),
		'address'   => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => get_field('address_street', 'option'),
            'postalCode'      => get_field('address_postal', 'option'),
            'addressLocality' => get_field('address_locality', 'option'),
            'addressCountry'  => get_field('address_country', 'option'),
        )
	);

    if (have_rows('social_media', 'option')) {
        $schema['sameAs'] = array();

        while (have_rows('social_media', 'option')) : the_row();
            array_push($schema['sameAs'], get_sub_field('url'));
        endwhile;
    }

    if (have_rows('opening_hours', 'option')) {

        $schema['openingHoursSpecification'] = array();

        while (have_rows('opening_hours', 'option')) : the_row();

            $closed = get_sub_field('closed');
            $from   = $closed ? '00:00' : get_sub_field('from');
            $to     = $closed ? '00:00' : get_sub_field('to');

            $openings = array(
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => get_sub_field('days'),
                'opens'     => $from,
                'closes'    => $to
            );

            array_push($schema['openingHoursSpecification'], $openings);

        endwhile;

        if (have_rows('special_days', 'option')) {

            while (have_rows('special_days', 'option')) : the_row();

                $closed    = get_sub_field('closed');
                $date_from = get_sub_field('date_from');
                $date_to   = get_sub_field('date_to');
                $time_from = $closed ? '00:00' : get_sub_field('time_from');
                $time_to   = $closed ? '00:00' : get_sub_field('time_to');

                $special_days = array(
                    '@type'        => 'OpeningHoursSpecification',
                    'validFrom'    => $date_from,
                    'validThrough' => $date_to,
                    'opens'        => $time_from,
                    'closes'       => $time_to
                );

                array_push($schema['openingHoursSpecification'], $special_days);

            endwhile;
        }
    }

    echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
}