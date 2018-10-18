<?php
/**
 * Renders the `hms/custom-post-feed` block on server.
 *
 * @param array $attributes The block attributes.
 *
 * @return string Returns the post content with latest posts added.
 */
function render_block_event_post_feed( $attributes ) {

	/**
	 * 196 is the default tax id
	 */
	$term_id = $attributes['categories'];
	
	if( $term_id !== null ) {
		
		$recent_posts = wp_get_recent_posts(
			array(
				'post_type'   => 'hmsevents',
				'numberposts' => $attributes['postsToShow'],
				'post_status' => 'publish',
				'orderby'     => $attributes['orderBy'], // orders by desc or asc
				'meta_key' 	  => 'event_date_start', // 
				'order'       => $attributes['order'],
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
	} else {

		/**
		 * Display the all terms in hmseventtypes
		 */
		$recent_posts = wp_get_recent_posts(
			array(
				'post_type'   => 'hmsevents',
				'taxonomy'	  => 'hmseventtypes',
				'numberposts' => $attributes['postsToShow'],
				'post_status' => 'publish',
				'orderby'     => $attributes['orderBy'], // orders by desc or asc
				'meta_key' 	  => 'event_date_start', // 
				'order'       => $attributes['order'],
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
	$event_items_markup = '';
	foreach ( $recent_posts as $post ) {

		// Vars 
		$post_id = $post['ID'];
		$title = get_the_title( $post_id );

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
		$event_items_markup .= '<article id="' . $post['ID'] . '" class="event-item">';
		
		/**
		 * Event JSON Schema
		 */
		$event_json = [];
		$event_json[] .=	'"@context": "http://schema.org"';
		$event_json[] .=	'"@type": "Event"';
		$event_json[] .=	'"name": "' . get_the_title( $post_id ) . '"';
		$event_json[] .= 	'"description": "' . sanitize_text_field( get_the_content( $post_id ) ) . '"';

		if( has_post_thumbnail( $post_id ) ) {
			$event_json[] .= '"image": "' . get_the_post_thumbnail_url( $post_id, 'thumbnail' )  . '"';
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
		$event_items_markup .= '<script type="application/ld+json">{' . implode(', ', $event_json ) . '}</script>';

			// Event Featured Image
			if ( isset( $attributes['displayPostImage'] ) && $attributes['displayPostImage'] ) {
				$event_items_markup .= get_the_post_thumbnail( $post_id, 'thumbnail' );
			}

			$event_items_markup .= '<div class="event-content">';
			
				// Event Title
				$event_items_markup .= sprintf(
					'<h3 class="entry-title"><a href="%1$s">%2$s</a></h3>',
					//get_the_post_thumbnail( $post_id, 'post-thumbnail' ),
					esc_url( get_permalink( $post_id ) ),
					esc_html( $title )
				);

				// Event Post Publish Date
				if ( isset( $attributes['displayPostDate'] ) && $attributes['displayPostDate'] ) {
					$event_items_markup .= sprintf(
						'<time datetime="%1$s" class="wp-block-latest-posts__post-date">%2$s</time>',
						esc_attr( get_the_date( 'c', $post_id ) ),
						esc_html( get_the_date( '', $post_id ) )
					);
				}

				// Event Start & End Date Times
				$event_items_markup .= '<div class="eventTimes">';

				// Display Event Start Date Time
				if ( isset( $attributes['displayStartDate'] ) && $attributes['displayStartDate'] ) {
					$event_items_markup .= '<span class="event-start">Start: ' . $event_date_start . '</span><br>';
				}

				// Display Event End Date Time
				if ( isset( $attributes['displayEndDate'] ) && $attributes['displayEndDate'] ) {
					$event_items_markup .= '<span class="event-start">End: ' . $event_date_end . '</span><br>';
				}

				$event_items_markup .= '</div>';


				/**
				 * Address
				 */
				if ( isset( $attributes['displayAddress'] ) && $attributes['displayAddress'] ) {
					
					$event_items_markup .= '<div class="address">';

						// Location Name
						$event_items_markup .= '<span class="location-title">' . $event_location_title . '</span>';
					
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
						}

						if( $event_map_link ) {
							$event_items_markup .= '<span class="directions-link"><a href=' . $event_map_link . ' title="Get Directions" target="_self">Get Directions</a>';
						}
							
						$event_items_markup .= '</div>';
					
					$event_items_markup .= '</div>';
				}


				// Display Event End Date Time
				if( isset( $attributes['displayMapLink'] ) && $attributes['displayMapLink'] ) {
					$event_items_markup .= '<a itemprop="hasMap" href="#" title="View on Google Maps">Get Directions</a>';
				}



			$event_items_markup .= '</div>';

        // Event Item Closing Tag
		$event_items_markup .= "</article>\n";
	}
	$class = 'wp-block-latest-posts hms-custom-post-feed';
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

	$block_content = sprintf(
		'<section class="%1$s aria-label="Events">%2$s</section>',
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