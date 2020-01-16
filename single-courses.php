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
    $link = get_field('all_courses_link', 'option');

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
        <script src="https://www.eventbrite.co.uk/static/widgets/eb_widgets.js"></script>

        <script type="text/javascript">
            var exampleCallback = function() {
                console.log('Order complete!');
            };
        </script>

        <h2>Dates, prices & booking</h2>
        <?php 
        get_template_part('course-dates-loop'); 
    }
    
    if( $link ): 
        $link_url = $link['url'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <p><strong><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><i class="fas fa-angle-double-left"></i> Back to all courses</a></strong></p>
    <?php endif; 

}

genesis();
