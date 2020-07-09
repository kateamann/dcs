<?php
/**
 * Single blog post
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/

add_action( 'genesis_before_entry_content', 'featured_post_image', 8 );
//* Add featured image
function featured_post_image() {
	the_post_thumbnail('featured-image');
}

add_action( 'genesis_entry_content', 'dcs_author_bio', 15 );
//* Add author bio
function dcs_author_bio() {	

	global $post;

	$post_object = get_field('post_author');

	if( $post_object ): 

		// override $post
		$post = $post_object;
		setup_postdata( $post ); 

		$job_title = get_field('job_title');
		$degree = get_field('degree');
		$company_name = get_field('company_name');
		$short_bio = get_field('short_bio');
		$linked_in = get_field('linked_in');
		$twitter = get_field('twitter');
		$website = get_field('website');
		$website_title = get_field('website_title');

		?>
		<section class="author-bio clearfix">
		    <div class="bio-image">
				<?php the_post_thumbnail( 'square-bio' );?>
			</div>

			<div class="bio-info">
				<h3>
					<?php the_title(); ?><?php if($degree) { echo ', ' . $degree; } ?><?php echo ', ' . $job_title . ', ' . $company_name; ?>
				</h3>
				
				<?php echo $short_bio; ?>

				<ul class="socials inline-list">
					<?php if($linked_in) { 
						echo '<li><a href="' . $linked_in . '" target="_blank">LinkedIn</a>'; 
					} ?>
					<?php if($twitter) { 
						echo '<li><a href="' . $twitter . '" target="_blank">Twitter</a>'; 
					} ?>
					<?php echo '<li>Website: <a href="' . $website . '" target="_blank">' . $website_title . '</a>'; ?>
				</ul>
		    </div>
		</section>
	    <?php wp_reset_postdata(); ?>
	<?php endif;
	
}

genesis();