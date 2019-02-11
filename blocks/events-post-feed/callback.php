<?php
/**
 * Renders the `hms/custom-post-feed` block on server.
 *
 * @param array $attributes The block attributes.
 *
 * @return string Returns the post content with latest posts added.
 */
function render_block_event_post_feed( $attributes ) {

	// Check if term has categories
	$term_id = $attributes['categories'];
	
	// get terms by category
	if( $term_id !== null ) {
		
		$recent_posts = wp_get_recent_posts(
			array(
				'post_type'   => 'hmsevents',
				'numberposts' => $attributes['postsToShow'],
				'post_status' => 'publish',
				'meta_key' 	  => 'event_date_start', 
				'orderby'	  => 'meta_value',
				'order'		  => 'ASC',
				// Only allows posts from selected taxonomy
				'tax_query' => array(
					array(
						'taxonomy' => 'hmseventtypes',
						'field'    => 'term_id',
						'terms'    => $attributes['categories'],
					),
				),
				// Only allows posts that does not have a date time that is before the current date.
				'meta_query' => array(
					array(
						'key'     => 'event_date_start', // ENDING DATE
						'value'   => date( 'Ymd' ), // Current Date
						'compare' => '>=', // event_date_time is greater than or equal to $current_time
						'type'    => 'DATE',
					),
				),
				'OBJECT',
			)
		);
	// display non category posts.
	} elseif( $term_id == null ) {

		/**
		 * Display the all terms in hmseventtypes
		 */
		$recent_posts = wp_get_recent_posts(
			array(
				'post_type'   => 'hmsevents',
				'taxonomy'	  => 'hmseventtypes',
				'numberposts' => $attributes['postsToShow'],
				'post_status' => 'publish',
				'meta_key' 	  => 'event_date_start',
				'orderby'	  => 'meta_value',
				'order'		  => 'ASC',
				// Only allows posts that does not have a date time that is before the current date.
				'meta_query' => array( 
					array(
						'key'     => 'event_date_start', // ENDING DATE
						'value'   => date( 'Ymd' ), // Current Date
						'compare' => '>=', // event_date_time is greater than or equal to $current_time
						'type'    => 'DATE',
					),
				),
				'OBJECT',
			)
		);	
	}

	/**
	 * Output Event Item
	 */
	
	foreach ( $recent_posts as $post ) {

		// Vars 
		$post_id = $post['ID'];
		$title = get_the_title( $post_id );
		$post_featured_url = get_the_post_thumbnail_url( $post_id, 'medium', true );
		$post_featured = get_the_post_thumbnail( $post_id, 'medium', true );
		//$post_featured = get_the_post_thumbnail( $post_id, 'thumbnail' );
		$post_featured_fallback = wp_get_attachment_image( 1074, 'medium' );

		// ACF VARS
		$event_date_start = get_field('event_date_start', $post_id );
		$event_date_end = get_field('event_date_end', $post_id );
		$event_location_title = get_field('event_location_title', $post_id );
		$event_street = get_field('event_street', $post_id );
		$event_street_2 = get_field('event_street_2', $post_id );
		$event_city = get_field('event_city', $post_id );
		$event_state = get_field('event_state', $post_id );
		$event_zip = get_field('event_zip', $post_id );
		$event_map_link = get_field('event_map_link', $post_id );
				
		if ( ! $title ) {
			$title = __( '(Untitled)', 'hms-events' );
        }

		// Post Container
		$event_items_markup .= '<li>';
		
			$event_items_markup .= '<article id="' . $post['ID'] . '" class="event-item">';

				
					// Event Title
					$event_items_markup .= '<a class="event-title" href="' . esc_url( get_permalink( $post_id ) )  . '">';

					// Event Featured Image
					if ( isset( $attributes['displayPostImage'] ) && $attributes['displayPostImage'] && has_post_thumbnail($post_id) ) {
						$event_items_markup .= $post_featured;
					} else {
						$event_items_markup .= $post_featured_fallback;
					}

					$event_items_markup .= esc_html( $title );



					$event_items_markup .= '</a>';


					// Event Post Publish Date
					if ( isset( $attributes['displayPostDate'] ) && $attributes['displayPostDate'] ) {
						$event_items_markup .= sprintf(
							'<time datetime="%1$s" class="wp-block-latest-posts__post-date">%2$s</time>',
							esc_attr( get_the_date( 'c', $post_id ) ),
							esc_html( get_the_date( '', $post_id ) )
						);
					}

					// Event Start & End Date Times
					$event_items_markup .= '<span class="eventTimes">';

					// Display Event Start Date Time
					if ( isset( $attributes['displayStartDate'] ) && $attributes['displayStartDate'] && $event_date_start ) {
						$event_items_markup .= '<span class="event-start">' . $event_date_start . '</span>';
					}

					// Display Event End Date Time
					if ( isset( $attributes['displayEndDate'] ) && $attributes['displayEndDate'] && $event_date_end ) {
						$event_items_markup .= '<span class="time-divider"> - </span> '; // Divider
						$event_items_markup .= '<span class="event-end">' . $event_date_end . '</span>';
					}

					$event_items_markup .= '</span>';


					/**
					 * Address
					 */
					if ( isset( $attributes['displayAddress'] ) && $attributes['displayAddress'] ) {
						
						$event_items_markup .= '<div class="address">';

							// Location Name
							if( $event_location_title ) {
								$event_items_markup .= '<span class="location-title">' . $event_location_title . '</span>';
							}
						
							// Postal Address
							if( $event_street && $event_city && $event_state && $event_zip ) {
							
							$event_items_markup .= '<div class="postal-address" itemprop="address">';

								if( $event_street ) {
									$event_items_markup .= '<span class="street-1">' . $event_street . '</span><br>';
								}

								if( $event_street_2 ) {
									$event_items_markup .= '<span class="street-2">' . $event_street_2 . '</span><br>';
								}

								if( $event_city ) {
									$event_items_markup .= '<span class="city">' . $event_city . '</span>,';
								}
								
								if( $event_state ) {
									$event_items_markup .= '<span class="region">' . $event_state . '</span>,';
								}
								
								if( $event_zip ) {
									$event_items_markup .= '<span class="zip">' . $event_zip . '</span>';
								}


								// Display Google Map Link
								if( isset( $attributes['displayMapLink'] ) && $attributes['displayMapLink'] && $event_map_link ) {
									$event_items_markup .= '<p class="directions-link"><a href="' . $event_map_link . '" title="Get Directions" target="_self">Get Directions</a></p>';
								}
								
							$event_items_markup .= '</div>';
							}


						
						$event_items_markup .= '</div>';
					}

			// Event Item Closing Tag
			$event_items_markup .= "</article>";


		$event_items_markup .= "</li>";

		
	}

	$class = 'wp-block-latest-posts hms-events';
	if ( isset( $attributes['align'] ) ) {
		$class .= ' align' . $attributes['align'];
	}
	if ( isset( $attributes['postLayout'] ) && 'grid' === $attributes['postLayout'] ) {
		$class .= ' is-grid';
	}
	if ( isset( $attributes['columns'] ) && 'grid' === $attributes['postLayout'] ) {
		$class .= ' columns-' . $attributes['columns'];
	}
	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
	}
	if( $attributes['eventHeader'] ) {
		$block_content .= '<h2 class="events-title">' . $attributes['eventHeader'] . '</h2>';
	}
	if( ! $post ) {
		$block_content .= '<div class="no-events"><p>No events are scheduled at this time, please check back later.</p></div>';
	}
	$block_content .= sprintf(
		'<ul class="%1$s" aria-label="Events">%2$s</ul>',
		esc_attr( $class ),
		$event_items_markup
	);

	return $block_content;

}




/**
 * Registers the `core/latest-posts` block on server.
 */
function register_block_event_post_feed() {

	// Check if the register function exists
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	register_block_type(
		'hms/events',
		array(
			'attributes'      => array(
				'categories'      => array(
					'type' => 'string',
				),
				'className'       => array(
					'type' => 'string',
				),
				'postsToShow'     => array(
					'type'    => 'number',
					'default' => 5,
				),
				'displayStartDate' => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'displayEndDate' => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'displayPostImage' => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'displayAddress' => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'displayMapLink' => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'eventHeader' => array(
					'type'    => 'string',
					'default' => 'Events',
					'selector' => 'h2',
					'source' => 'html',
				),
				'imageCrop'  => array(
					'type' => 'string',
					'default' => 'landscape',
				),
				'postLayout'      => array(
					'type'    => 'string',
					'default' => 'list',
				),
				'columns'         => array(
					'type'    => 'number',
					'default' => 3,
				),
				'align'           => array(
					'type' => 'string',
				),
				'order'           => array(
					'type'    => 'string',
					'default' => 'desc',
				),
				'orderBy'         => array(
					'type'    => 'string',
					'default' => 'date',
				),
				'startDate' => array(
					'type' => 'string',
					'source' => 'meta',
					'meta' => 'event_date_start',
				),
			),
            'render_callback' => 'render_block_event_post_feed',
		)
	);
}

add_action( 'init', 'register_block_event_post_feed' );

/**
 * Create API fields for additional info
 */
function hms_events_register_rest_fields() {
	
	// Add landscape featured image source
	register_rest_field(
		'hmsevents',
		'featured_image_src',
		array(
			'get_callback' => 'hms_events_get_image_src_landscape',
			'update_callback' => null,
			'schema' => null,
		)
	);

	// Add square featured image source
	register_rest_field(
		'hmsevents',
		'featured_image_src_square',
		array(
			'get_callback' => 'hms_events_get_image_src_square',
			'update_callback' => null,
			'schema' => null,
		)
	);

}
add_action( 'rest_api_init', 'hms_events_register_rest_fields' );

/**
 * Get landscape featured image source for the rest field
 */
function hms_events_get_image_src_landscape( $object, $field_name, $request ) {
	$feat_img_array = wp_get_attachment_image_src(
		$object['featured_media'],
		'hms-block-post-grid-landscape',
		false
	);
	return $feat_img_array[0];
}

/**
 * Get square featured image source for the rest field
 */
function hms_events_get_image_src_square( $object, $field_name, $request ) {
	$feat_img_array = wp_get_attachment_image_src(
		$object['featured_media'],
		'hms-block-post-grid-square',
		false
	);
	return $feat_img_array[0];
}

function hms_events_register_post_meta() {
	$args = array(
		'type' => 'string',
		'single' => true,
		'show_in_rest' => true,
	);

	register_meta( 'post', 'hms_events_meta', $args );
}

add_action( 'init', 'hms_events_register_post_meta' );