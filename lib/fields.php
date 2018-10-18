<?php
/**
 * Include ACF Fields
 */
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5bbd055ebc72f',
	'title' => 'Event Details',
	'fields' => array(
		array(
			'key' => 'field_5bbd0562b74eb',
			'label' => 'Event Date Start',
			'name' => 'event_date_start',
			'type' => 'date_time_picker',
			'instructions' => 'Select a date and time that this event will take start.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'm/d/Y g:i a',
			'return_format' => 'm/d/Y g:i a',
			'first_day' => 0,
		),
		array(
			'key' => 'field_5bbd05b7b74ec',
			'label' => 'Event Date End',
			'name' => 'event_date_end',
			'type' => 'date_time_picker',
			'instructions' => 'Select a date and time that this event will end.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'm/d/Y g:i a',
			'return_format' => 'm/d/Y g:i a',
			'first_day' => 0,
		),
		//LOCATION DETAILS
		array(
			'key' => 'field_589e39eb76576',
			'label' => 'Event Location Title',
			'name' => 'event_location_title',
			'type' => 'text',
			'instructions' => 'What is the name of your location?',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5893719b96a3b',
			'label' => 'Street Address',
			'name' => 'event_street',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '145 N. Example Street',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_589371e096a3c',
			'label' => 'City',
			'name' => 'event_city',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Springfield',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_589e33a89bdc2',
			'label' => 'State',
			'name' => 'event_state',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Ohio',
			'placeholder' => 'Ohio',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_589371fd96a3d',
			'label' => 'Zip Code',
			'name' => 'event_zip',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 45503,
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5893722096a3e',
			'label' => 'Google Map Link',
			'name' => 'event_map_link',
			'type' => 'url',
			'instructions' => 'Help users easily find your location by providing a Google map link.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Google Maps Link',
		),
		array(
			'key' => 'field_5893723e96a3f',
			'label' => 'Phone',
			'name' => 'event_phone',
			'type' => 'text',
			'instructions' => 'Include a phone number for contact purposes.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '937-123-4567',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5893729596a40',
			'label' => 'Email',
			'name' => 'event_email',
			'type' => 'text',
			'instructions' => 'Include an email for contact purposes.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'john@example.com',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'hmsevents',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
) );

endif;




if( ! function_exists('hms_format_phone') ) {
	/**
	*
	* Format a USA Phone Number.
	*
	*/
	function hms_format_phone( $hms_pre_formatted_phone, $hms_phone_title ) {
		//$hms_pre_formatted_phone = '';
		if( isset( $hms_pre_formatted_phone ) ) {

		$phone_country = '';
		$phone_area = '';
		$phone_prefix = '';
		$phone_line = '';

			//Strips all characters except integers
			$clean_phone = preg_replace('/[^0-9]/','', $hms_pre_formatted_phone );

			if( isset( $clean_phone ) ) {

		if( strlen( $clean_phone ) < 10 ) {
			$hms_phone_formatted = '<a class="hms-phone" href="tel:+' . $clean_phone . '" target="_self" title="Call ' . $hms_phone_title . '" target="_self">' . $clean_phone . '</a>';
			}


		if( strlen( $clean_phone ) == 10 ) {
					//Example Number 937 267 6586
				$phone_country = '1';
				$phone_area = substr( $clean_phone, 0, 3 );
				$phone_prefix = substr( $clean_phone, 3, 3 );
				$phone_line = substr($clean_phone, 6, 4 );

			$hms_phone_formatted = '<a class="hms-phone" href="tel:+' . $phone_country . $clean_phone . '" target="_self" title="Call ' . $hms_phone_title . '" target="_self">(' . $phone_area . ') ' . $phone_prefix . '-' . $phone_line . '</a>';

			} elseif( strlen( $clean_phone ) == 11 ) {
					//Example Number 1 937 267 6586
					$phone_country = '1';
				$phone_area = substr( $clean_phone, 1, 3 );
				$phone_prefix = substr( $clean_phone, 4, 3 );
				$phone_line = substr( $clean_phone, 7, 4 );

			$hms_phone_formatted = '<a class="hms-phone" href="tel:+' . $phone_country . $clean_phone . '" target="_self" title="Call ' . $hms_phone_title . '" target="_self">(' . $phone_area . ') ' . $phone_prefix . '-' . $phone_line . '</a>';
			}

				return $hms_phone_formatted; // Returns Phone Number Link

			} // End if $clean_phone

		} // End if isset

	} // End hms_format_phone()
}









function get_event_fields() {
	$event_location_title = get_field('event_location_title' );
	$event_street = get_field('event_street' );
	$event_street_2 = get_field('event_street_2' );
	$event_city = get_field('event_city' );
	$event_state = get_field('event_state' );
	$event_zip = get_field('event_zip' );
	$event_map_link = get_field('event_map_link' );
	
	$event_date_start = get_field('event_date_start' );
	$event_date_end = get_field('event_date_end' );
	
	$event_email = get_field('event_email'); 
	$event_phone = get_field('event_phone'); 
	$hms_pre_formatted_phone = $event_phone;
}

/**
 * Insert Dates into the content
 */

add_filter( 'the_content', 'add_event_dates' ); 

if( function_exists('get_field') && ! function_exists('get_event_data') ) {
	
	function get_event_data() {
	$event_location_title = get_field('event_location_title' );
	$event_street = get_field('event_street' );
	$event_street_2 = get_field('event_street_2' );
	$event_city = get_field('event_city' );
	$event_state = get_field('event_state' );
	$event_zip = get_field('event_zip' );
	$event_map_link = get_field('event_map_link' );

	$event_date_start = get_field('event_date_start' );
	$event_date_end = get_field('event_date_end' );

	$event_email = get_field('event_email'); 
	$event_phone = get_field('event_phone'); 
	$hms_pre_formatted_phone = $event_phone;
	?>

	<aside class="event-meta" role="complementary">

	<?php
		/**
		 * Event JSON Schema
		 */

		$event_schema = '';
		$event_json = [];
		$event_json[] .=	'"@context": "http://schema.org"';
		$event_json[] .=	'"@type": "Event"';
		$event_json[] .=	'"name": "' . get_the_title() . '"';
		$event_json[] .= 	'"description": "' . sanitize_text_field( get_the_content() ) . '"';

		if( has_post_thumbnail() ) {
			$event_json[] .= '"image": "' . get_the_post_thumbnail_url( 'thumbnail' )  . '"';
		}
		
		if( $event_date_start ) {
			$event_json[] .= '"startDate": "2018-10-25T23:55"';
		}
		
		if( $event_date_end ) { 
			$event_json[] .= '"endDate": "2018-11-10T19:55"';
		}

		/**
		 * Event Location Details
		*/
		$event_location = [];

		$event_location[] .= '"@type": "Place"';

		// Location Title
		if( $event_location_title ) {
			$event_location[] .= '"name": "' . $event_location_title . '"';
		}
		// Map Link
		if( $event_map_link ) {
			$event_location[] .= '"hasMap": "' . $event_map_link . '"';
		}

		if( $event_street && $event_city && $event_state && $event_zip  ) {

			$event_location[] .= '"address": {
				"@type": "PostalAddress",
				"streetAddress": "' . $event_street . '",
				"addressLocality": "' . $event_city . '",
				"addressRegion": "' . $event_state . '",
				"postalCode": "' . $event_zip . '",
				"addressCountry": "US"
			}';

		}

		
		$event_json[] .= '"location": {' . implode(', ', $event_location ) . '}';
	
		// Output Event JSON as Comma Separated List
		$event_schema = '<script type="application/ld+json">{' . implode(', ', $event_json ) . '}</script>';

		echo $event_schema;
	?>

	<dl>
			<?php if( $event_date_start OR $event_date_end ) : ?>
			<dt>When:</dt>
				<?php if( $event_date_start ) : ?>
					<dd class="event-start">Start: <?php echo $event_date_start; ?></dd>
				<?php endif; ?>

				<?php if( $event_date_end ) : ?>
					<dd class="event-end">End: <?php echo $event_date_end; ?></dd>
				<?php endif; ?>
			<?php endif; ?>

			<?php if( is_singular('hmsevents') && $event_location_title OR $event_street OR $event_city ) : ?>
				<dt class="label">Location:</dt>
				<!-- Location Title -->
				<?php if( $event_location_title ) : ?>
					<dd class="location-title"><?php echo $event_location_title; ?></dd>
				<?php endif; ?>

				<!-- Street Address -->
				<?php if( $event_street && $event_city && $event_state && $event_zip ) : ?>
					<dd><?php echo $event_street . '<br>' . $event_city . ', ' . $event_state . ', ' . $event_zip; ?><dd>
				<?php endif; ?>

				<!-- Location Map -->
				<?php if( $event_map_link ) : ?>
					<dd><a class="read-more-button" href="<?php echo $event_map_link; ?>" title="<?php echo $event_location_title; ?> Google Map Directions" target="_blank">Get Directions</a><dd>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if( $event_phone OR $event_email ) : ?>
				<!-- Location Phone -->
				<dt class="label">Contact Information:</dt>
				<?php if( $hms_pre_formatted_phone ) : ?>
					<?php $hms_phone_title = $event_location_title; ?> 
					<dd><?php echo hms_format_phone( $hms_pre_formatted_phone, $hms_phone_title );?><dd>
				<?php endif; ?>
			
				<!-- Location Email -->
				<?php if( $event_email ) : ?>
					<dd><a class="event-email" href="mailto:<?php echo $event_email; ?>" title="Email <?php echo $event_location_title; ?>" target="_blank"><?php echo $event_email; ?></a><dd>
				<?php endif; ?>

			<?php endif; ?>
		</dl>
		</aside><!-- .hms-summary-details -->

	<?php
	}
}

 
function add_event_dates( $content ) { 
   if ( is_singular('hmsevents') ) {

		$event_data = get_event_data();

		$content = $event_data . $content;

    } elseif( is_post_type_archive( 'hmsevents' ) ) {

	}

   return $content;
}

