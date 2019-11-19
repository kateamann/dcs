<?php
/**
 * Courses single post
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


add_action( 'genesis_entry_content', 'display_full_course_info', 6 );
function display_full_course_info() { 

    $description = get_field('full_description');
    $audience = get_field('aimed_at');
    $outcomes = get_field('learning_outcomes');

    if( $description ) { ?>
        <h2>Course description</h2>
            <?php echo $description; ?>

        <?php 
    }

    if( $audience ) { ?>
        <h2>Aimed at</h2>
            <?php echo $audience; ?>

        <?php 
    }

    if( $outcomes ) { ?>
        <h2>Learning outcomes</h2>
            <?php echo $outcomes; ?>

        <?php 
    }

    if( have_rows('course_dates') ) { ?>

        
        <h2>Dates and prices</h2>
        <?php 
        get_template_part('course-dates-loop');
        
    }

    ?>

    <p><strong><a href="/funded-services/courses/"><i class="fas fa-angle-double-left"></i> Back to all courses</a></strong></p>

    <?php

}

genesis();
