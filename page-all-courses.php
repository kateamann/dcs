<?php
/**
 * Course listings page
 * Template Name: Course Listings
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/


add_action( 'genesis_entry_content', 'course_listings', 10 );
function course_listings() {
	
	$args = array(
		'post_type' => 'courses',
		'orderby'	=> 'menu_order',
		'order'     => 'ASC',
	);

	$the_query = new WP_Query( $args );?>

    <div class="all-courses">
    <h2>Courses</h2>
    	<div class="dcs-accordion-blocks">

		    <?php 

		    while ( $the_query->have_posts() ) : $the_query->the_post();

		    	$id = get_the_ID();
		    	$length = get_field('no_of_days');
		    	$description = get_field('short_description');

		    	?>

			    <div class="wp-block-pb-accordion-item c-accordion__item js-accordion-item" data-initially-open="false" data-click-to-close="true" data-auto-close="true" data-scroll="false" data-scroll-offset="0">
					<h3 id="at-<?php echo $id; ?>" class="c-accordion__title js-accordion-controller" tabindex="0" role="button" aria-controls="ac-<?php echo $id; ?>" aria-expanded="false"><?php the_title(); ?> <?php if ($length ) { echo '(' . $length . ')'; } ?></h3>
					<div id="ac-<?php echo $id; ?>" class="c-accordion__content" style="display: none;" aria-hidden="true">
						<?php echo $description; ?>

						<?php if ( have_rows('course_dates') ) { ?>
				        <p><strong><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						Full Course Details <i class="fas fa-angle-double-right"></i>
						</a></strong></p>
						
							<h3>Dates and prices</h3>
							<?php get_template_part('course-dates-loop'); ?>
						<?php
						} ?>
					</div>
				</div>
		    
		    <?php
			endwhile;

			wp_reset_postdata(); ?>

    	</div>
    </div> 

    <?php
}

add_action( 'genesis_entry_content', 'additional_course_info', 11 );
function additional_course_info() {

	$courses_footer = get_field('additional_courses_info');

	if ($courses_footer) {
		echo $courses_footer;
	}

}

genesis();