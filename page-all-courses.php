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
    	<div class="tabs">

		    <?php 

		    while ( $the_query->have_posts() ) : $the_query->the_post();

		    	$id = get_the_ID();
		    	$length = get_field('no_of_days');
		    	$description = get_field('short_description');

		    	?>

				      <div class="tab">
				        <input type="checkbox" id="<?php echo $id; ?>">
				        <label class="tab-label" for="<?php echo $id; ?>"><?php the_title(); ?> (<?php echo $length; ?>)</label>
				        <div class="tab-content">
				        <?php echo $description; ?>
					        <p><strong><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							Full Course Details <i class="fas fa-angle-double-right"></i>
							</a></strong></p>

							<h3>Dates and prices</h3>
        					<?php get_template_part('course-dates-loop'); ?>
				        </div>
				      </div>
		    
		    <?php
			endwhile;

			wp_reset_postdata(); ?>

    	</div>
    </div> <?php
}

add_action( 'genesis_entry_content', 'additional_course_info', 11 );
function additional_course_info() {

	$courses_footer = get_field('additional_courses_info');

	if ($courses_footer) {
		echo $courses_footer;
	}

}



genesis();