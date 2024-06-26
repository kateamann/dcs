<?php
/**
 * Partners single post
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

add_action( 'genesis_entry_content', 'display_full_partner_info', 6 );
function display_full_partner_info() { 

    $website = get_field('partner_website');
    $first_name = get_field('contact_first_name');
    $surname = get_field('contact_surname');
    $job_title = get_field('contact_job_title');
    $email = get_field('contact_email');
    $phone = get_field('contact_phone');

    $first_name_2 = get_field('contact_2_first_name');
    $surname_2 = get_field('contact_2_surname');
    $job_title_2 = get_field('contact_2_job_title');
    $email_2 = get_field('contact_2_email');
    $phone_2 = get_field('contact_2_phone');

    $photo = get_field('contact_photo');
    $photo_size = 'square-bio';
    $products_services = get_field('products_and_services');
    $intro = get_field('contact_introduction');
    $link = get_field('all_partners_link', 'option');
    ?>
    
    <div class="partner-logo">
        <?php the_post_thumbnail('medium'); ?>
    </div>

    <div class="partner-contact-details">
        <?php if( $website ) { ?>
            <p><strong>Website:</strong> <a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a><p>
        <?php } ?>

        <?php if( $first_name ) { ?>
            <p>
                <strong>Contact:</strong> <?php echo $first_name; ?> <?php echo $surname; ?>, <?php echo $job_title; ?><br/>
                <strong><i class="fas fa-at"></i></strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br/>
                <strong><i class="fas fa-phone"></i></strong> <?php echo $phone; ?>
            </p>
        <?php } ?>


        <?php if( $first_name_2 ) { ?>
        <p>
            <strong>Contact:</strong> <?php echo $first_name_2; ?> <?php echo $surname_2; ?>, <?php echo $job_title_2; ?><br/>
            <strong><i class="fas fa-at"></i></strong> <a href="mailto:<?php echo $email_2; ?>"><?php echo $email_2; ?></a><br/>
            <strong><i class="fas fa-phone"></i></strong> <?php echo $phone_2; ?>
        </p>
        <?php } ?>

    </div>

    <?php if( $products_services ) { ?>
        <div class="products-services">
            <h2>Products and services</h2>
            <?php echo $products_services; ?>
        </div>
    <?php } ?>

    <?php if( $intro ) { ?>
        <div class="contact-intro">
            <h2>Introduction from <?php echo $first_name; ?><?php if( $first_name_2 ) { echo ' and ' . $first_name_2; } ?></h2>

            <?php if( $photo ) { ?>
                <div class="partner-contact-image">
                    <?php echo wp_get_attachment_image( $photo, $photo_size ); ?>
                </div>
            <?php
            }
            echo $intro; ?>
        </div>
    <?php } ?>

    <?php if( $link ) { 
        $link_url = $link['url'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <p><strong><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><i class="fas fa-angle-double-left"></i> Back to all partners</a></strong></p>
    <?php }

}

genesis();
