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
    	
        <?php echo $city; ?> (<?php echo $date; ?>)<strong>&nbsp;&middot;&nbsp;</strong><strong><?php echo $price; ?></strong><?php if( $link && $eventbrite ): ?>

	        <!-- Noscript content for added SEO -->
			<noscript><a href="<?php echo esc_url($link); ?>" rel="noopener noreferrer" target="_blank"></noscript>

			<strong>&nbsp;&middot;&nbsp;</strong><button class="eventbrite" id="eventbrite-widget-modal-trigger-<?php echo $eventbrite; ?>" type="button">Book <i class="fas fa-angle-double-right"></i></button>
			<noscript></a>Buy Tickets on Eventbrite</noscript>

			<script type="text/javascript">
			    window.EBWidgets.createWidget({
			        widgetType: 'checkout',
			        eventId: '<?php echo $eventbrite; ?>',
			        modal: true,
			        modalTriggerElementId: 'eventbrite-widget-modal-trigger-<?php echo $eventbrite; ?>',
			        onOrderComplete: exampleCallback
			    });
			</script>
		
		<?php endif; ?>

    </li>

<?php endwhile; ?>

</ul>
