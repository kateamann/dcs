<?php
/**
 * Team page
 * Template Name: Team page
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/

//* Add Team bios
add_action( 'genesis_entry_content', 'dcs_team_bios', 12 );
function dcs_team_bios() {
	
	$args = array(
		'post_type' => 'people',
		'tax_query' => array(
			array(
				'taxonomy' => 'people-category',
				'field'    => 'slug',
				'terms'    => 'team',
			),
		),
		'orderby'	=> 'menu_order',
		'order'     => 'ASC',
	);

	$the_query = new WP_Query( $args );?>

    <section class="team-bios clearfix">
    	<div class="dcs-accordion-blocks">

		    <?php 

		    while ( $the_query->have_posts() ) : $the_query->the_post(); 
		    	$id = get_the_ID();
		    	$job_title = get_field('job_title');
				$degree = get_field('degree');
				$email = get_field('email');
				$short_bio = get_field('short_bio');
				$extended_bio = get_field('extended_bio');
				?>

		    	<div class="team-member">
		    		<div class="team-header">
	    				<div class="bio-image">
							 <?php the_post_thumbnail( 'square-bio' );?>
						</div>
						<div class="short-bio">
							<h3><?php the_title(); ?><?php if($degree) { echo ', ' . $degree; } ?><?php echo ', ' . $job_title; ?></h3>

							<?php if ( $email ) { echo '<p><a href="mailto:' . $email . '">' . $email . '</a></p>'; } ?>
							<?php echo $short_bio; ?>


				    		<div class="wp-block-pb-accordion-item c-accordion__item js-accordion-item" data-initially-open="false" data-click-to-close="true" data-auto-close="true" data-scroll="false" data-scroll-offset="0">
								<h4 id="at-<?php echo $id; ?>" class="c-accordion__title js-accordion-controller" tabindex="0" role="button" aria-controls="ac-<?php echo $id; ?>" aria-expanded="false">Read more</h4>
								<div id="ac-<?php echo $id; ?>" class="c-accordion__content" style="display: none;" aria-hidden="true">
									<?php echo $extended_bio; ?>
								</div>
							</div>

				    	</div>
		    		</div>
		    		
				</div>

			<?php
			endwhile;

			// Reset Second Loop Post Data
			wp_reset_postdata(); ?>

    	</div>
    </section> <?php
}

genesis();