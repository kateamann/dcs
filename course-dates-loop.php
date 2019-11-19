<!-- Course dates loop -->

<ul class="course-dates two-column-list">

<?php while( have_rows('course_dates') ): the_row(); 

    // vars
    $city = get_sub_field('city');
    $date = get_sub_field('date');
    $price = get_sub_field('price');
    $link = get_sub_field('booking_link');

    ?>

    <li>
        <?php echo $city; ?> (<?php echo $date; ?>)<strong> &middot; <?php echo $price; ?><?php if( $link ): ?> &middot; <a href="<?php echo $link; ?>">Book <i class="fas fa-angle-double-right"></i></a><?php endif; ?></strong>
    </li>

<?php endwhile; ?>

</ul>