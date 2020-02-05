<!-- Course dates loop -->

<ul class="course-dates two-column-list">

<?php while( have_rows('course_dates') ): the_row(); 

    // vars
    $city = get_sub_field('city');
    $date = get_sub_field('date');
    $price = get_sub_field('price');
    $link = get_sub_field('booking_link');
    $eventbrite = get_sub_field('eventbrite_id');

    ?>

    <li>
    	
        <?php echo $city; ?> (<?php echo $date; ?>)<strong>&nbsp;&middot;&nbsp;</strong><strong><?php echo $price; ?></strong><?php if( $link ): ?>
	        
			<span class="eventlink">
				<strong>&nbsp;&middot;&nbsp;</strong>
				<a href="<?php echo esc_url($link); ?>" rel="noopener noreferrer" target="_blank">
				<button class="eventbrite">Book <i class="fas fa-angle-double-right"></i></button>
				</a>
			</span>
		
		<?php endif; ?>

    </li>

<?php endwhile; ?>

</ul>
