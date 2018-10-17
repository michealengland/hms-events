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
));

endif;





/**
 * Insert Dates into the content
 */

add_filter( 'the_content', 'add_event_dates' ); 
 
function add_event_dates( $content ) { 
   if ( is_singular('hmsevents') OR is_post_type_archive('hmsevents') ) {

        $event_time = '';

        if( function_exists('get_field') ) {

            $event_start = get_field( 'event_date_start' );
            $event_end = get_field( 'event_date_end' );

            // Return Content if both values are empty.
            if( $event_start == '' && $event_end == '' ) {
                return $content;
            }
            
            // Outer Container
            $event_time .= '<div class="event-time">';
                
                if( $event_start ) {
                    $event_time .= '<p><span class="start-time">Start Time ' . get_field('event_date_start') . '</span></p>';
                }
            
                if( $event_end ) {
                    $event_time .= '<p><span class="start-time">End Time: ' . get_field('event_date_end') . '</span></p>';
                }
            
            $event_time .= '</div>';
        }

        $content = $event_time . $content;
    }

   return $content;
}

