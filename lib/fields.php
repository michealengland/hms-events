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
			'return_format' => 'm/d/y g:i a',
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
			'return_format' => 'm/d/y g:i a',
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













/**
 * Get ACF Fields
 */
function get_event_fields( $event_data ) {
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
 * Insert Dates into the content on Singular Events
 */
//add_filter( 'the_content', 'add_event_dates' ); 

if( function_exists('get_field') && ! function_exists('get_event_data') ) {

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
	
				$hms_phone_formatted = '<a class="hms-phone" href="tel:+' . $phone_country . $clean_phone . '" target="_self" title="Call ' . $hms_phone_title . '" target="_self">' . $phone_area . '-' . $phone_prefix . '-' . $phone_line . '</a>';
	
				} elseif( strlen( $clean_phone ) == 11 ) {
						//Example Number 1 937 267 6586
						$phone_country = '1';
					$phone_area = substr( $clean_phone, 1, 3 );
					$phone_prefix = substr( $clean_phone, 4, 3 );
					$phone_line = substr( $clean_phone, 7, 4 );
	
				$hms_phone_formatted = '<a class="hms-phone" href="tel:+' . $phone_country . $clean_phone . '" target="_self" title="Call ' . $hms_phone_title . '" target="_self">' . $phone_area . '-' . $phone_prefix . '-' . $phone_line . '</a>';
				}
	
					return $hms_phone_formatted; // Returns Phone Number Link
	
				} // End if $clean_phone
	
			} // End if isset
	
		} // End hms_format_phone()
	}
	
	function get_event_data($event_data) {

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

		$event_data .= $event_schema;

		// Event Date Time
		if( $event_date_start OR $event_date_end ) {
		$event_data .= '<dl class="event-time">';

			$event_data .= '<dt>When:</dt>';
			if( $event_date_start ) {
				$event_data .= '<dd class="event-start">Start: ' . $event_date_start . '</dd>';
			}

			if( $event_date_end ) {
				$event_data .= '<dd class="event-end">End: ' . $event_date_end . '</dd>';
			}
			
		$event_data .= '</dl>';
		
		}

		
		$event_data .= '<dl class="event-location">';

			if( is_singular('hmsevents') && $event_location_title OR $event_street OR $event_city ) {
				
				// Location Label
				$event_data .= '<dt class="label">Location:</dt>';

				// Event Title & Google Map's Link
				if( $event_location_title  && $event_map_link ) {
					$event_data .= '<dd><a class="read-more-button" href="' . $event_map_link . '" title="' . $event_location_title . ' Google Map Directions" target="_blank">' . $event_location_title. '</a><dd>';
				} else {
					$event_data .= '<dd class="location-title">' . $event_location_title . '</dd>';
				}

				if( $event_street && $event_city && $event_state && $event_zip ) {
					$event_data .= '<dd>' . $event_street . '<br>' . $event_city . ', ' . $event_state . ', ' . $event_zip . '<dd>';
				}

			}
			
			if( $event_phone OR $event_email ) {
				
				$event_data .= '<dt class="label">Contact Information:</dt>';

				if( $hms_pre_formatted_phone ) {
					$hms_phone_title = $event_location_title;
					$event_data .= '<dd>' . hms_format_phone( $hms_pre_formatted_phone, $hms_phone_title ) . '<dd>';
				}
			
				if( $event_email ) {
					$event_data .= '<dd><a class="event-email" href="mailto:' . $event_email . '" title="Email ' . $event_location_title . '" target="_blank">' . $event_email . '</a><dd>';
				}

			}
			
			$event_data .= '</dl>';

		return '<aside class="event-meta" role="complementary">' . $event_data . '</aside>';

	}
}





 
function add_event_dates( $content ) { 
   if ( is_singular('hmsevents') ) {

		$event_header = get_event_data( $event_data );
		$content = $event_header . $content;

    } else {
		$content = $content;
	}

   return $content;
}









if( function_exists( 'get_field' ) ) {

	/**
	 * Get ACF Field Data
	 */
	function get_event_acf_fields( $event_acf ) {

		$event_acf = [];

		$event_acf['location_title'] .= $event_location_title = get_field('event_location_title' );
		$event_acf['location_street'] .= $event_street = get_field('event_street' );
		$event_acf['location_street_2'] .= $event_street_2 = get_field('event_street_2' );
		$event_acf['location_city'] .= $event_city = get_field('event_city' );
		$event_acf['location_state'] .= $event_state = get_field('event_state' );
		$event_acf['location_zip'] .= $event_zip = get_field('event_zip' );
		$event_acf['location_directions'] .= $event_map_link = get_field('event_map_link' );

		$event_acf['event_start'] .= $event_date_start = get_field('event_date_start' );
		$event_acf['event_end'] .= $event_date_end = get_field('event_date_end' );

		$event_acf['event_contact_email'] .= $event_email = get_field('event_email'); 
		$event_acf['event_contact_phone'] .= $event_phone = get_field('event_phone'); 

		return $event_acf;

		//$hms_pre_formatted_phone = $event_phone;
	}

	/**
	 * HMS Event JSON Micro Data
	 */
	if( ! function_exists( 'hms_event_schema' ) ) {

		function hms_event_schema( $event_data ) {

		$event_acf_fields = get_event_acf_fields( $event_acf );

		//print_r( $event_acf_fields );

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
		if( $event_acf_fields['location_title'] ) {
			$event_location[] .= '"name": "' . $event_acf_fields['location_title'] . '"';
		}
		// Map Link
		if( $event_acf_fields['location_directions'] ) {
			$event_location[] .= '"hasMap": "' . $event_acf_fields['location_directions'] . '"';
		}

		if( $event_acf_fields['location_street'] && $event_acf_fields['location_city'] && $event_acf_fields['location_state'] && $event_acf_fields['location_zip']  ) {

			$event_location[] .= '"address": {
				"@type": "PostalAddress",
				"streetAddress": "' . $event_acf_fields['location_street'] . '",
				"addressLocality": "' . $event_acf_fields['location_city'] . '",
				"addressRegion": "' . $event_acf_fields['location_state'] . '",
				"postalCode": "' . $event_acf_fields['location_zip'] . '",
				"addressCountry": "US"
			}';

		}

		$event_json[] .= '"location": {' . implode(', ', $event_location ) . '}';
	
		// Output Event JSON as Comma Separated List
		$event_schema = '<script type="application/ld+json">{' . implode(', ', $event_json ) . '}</script>';

		$event_data .= $event_schema;


		return $event_data;

		}

	}

	
	/**
	 * HMS Event Address Details
	 */
	if( ! function_exists( 'hms_event_address' ) ) {

		function hms_event_address( $event_data ) {

			$event_data = [];
			
			$event_acf_fields = get_event_acf_fields( $event_acf );
			
			//print_r($event_acf_fields);

			if( $event_acf_fields['location_title'] ) {
	
				// Event Title & Google Map's Link
				if( $event_acf_fields['location_title']  && $event_acf_fields['location_directions'] ) {
					$event_data[] .= '<span class="location-title"><a class="read-more-button" href="' . $event_acf_fields['location_directions'] . '" title="' . $event_location_title . ' Google Map Directions" target="_blank">' . $event_acf_fields['location_title']. '</a></span><br>';
				} else {
					$event_data[] .= '<span class="location-title">' . $event_acf_fields['location_title'] . '</span><br>';
				}

				if( $event_acf_fields['location_street'] && $event_acf_fields['location_city'] && $event_acf_fields['location_state'] && $event_acf_fields['location_zip'] ) {
					$event_data[] .=  $event_acf_fields['location_street'] . '<br>' . $event_acf_fields['location_city'] . ', ' . $event_acf_fields['location_state'] . ', ' . $event_acf_fields['location_zip'];
				}
		
				return $event_data;
			}

			
		}
	}

	if( ! function_exists( 'hms_event_time' ) ) {

		function hms_event_time( $event_data ) {

			$event_acf_fields = get_event_acf_fields( $event_acf );

			//print_r( $event_acf_fields );

			// Event Date Time
			if( $event_acf_fields['event_start'] ) {

				$event_data .= '<span class="eventTimes">';

					// Event Start Date Time
					if( $event_acf_fields['event_start'] ) {
						$event_data .= '<span class="event-start">' . $event_acf_fields['event_start'] . '</span>';
					}
					
					// Event End Date Time
					if( $event_acf_fields['event_end'] ) {
						$event_data .= ' - <span class="event-end">' . $event_acf_fields['event_end'] . '</span>';
					}
					
				$event_data .= '</span>';
				
				}

			return  $event_data;

		}
	}

	/**
	 * Event Contact Details
	 */
	if( ! function_exists( 'hms_event_contact' ) ) {

		function hms_event_contact( $event_data ) {

			$event_acf_fields = get_event_acf_fields( $event_acf );

			//print_r( $event_acf_fields );

			if( $event_acf_fields['event_contact_phone'] OR $event_acf_fields['event_contact_email'] ) {
				
				$event_data = '<div class="eventContact">';

				// Phone must have Location Title, Phone, and HMS Format Phone FUnction
				if( $event_acf_fields['event_contact_phone'] && $event_acf_fields['location_title'] && function_exists('hms_format_phone') ) {
					
					$hms_pre_formatted_phone = $event_acf_fields['event_contact_phone'];
					$hms_phone_title = $event_acf_fields['location_title'];
					
					$event_data .= '<span class="event-phone">' . hms_format_phone( $hms_pre_formatted_phone, $hms_phone_title ) . '</span>';
				}
				
				// Email Must Have Location Title & Email
				if( $event_acf_fields['event_contact_email'] && $event_acf_fields['location_title'] ) {
					$event_data .= '<span class="event-email"><a class="event-email" href="mailto:' . $event_acf_fields['event_contact_email'] . '" title="Email ' . $event_acf_fields['location_title'] . '" target="_blank">' . $event_acf_fields['event_contact_email'] . '</a></</span>';
				}
				
				$even_data = '</div>';
			}

			return  $event_data;

		}
	}

} // get_fields check





/**
 * Output the Data
 */
function get_event_meta() { 

	$event_meta = get_event_data( $event_data );

	//return $event_meta;
 }