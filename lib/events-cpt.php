<?php

function hms_events_register_cpt() {

/**
 * Post Type: Events.
 */

$labels = array(
    "name" => __( "Events", "hms-events" ),
    "singular_name" => __( "Event", "hms-events" ),
    "menu_name" => __( "Events", "hms-events" ),
    "all_items" => __( "All Events", "hms-events" ),
    "add_new" => __( "Add New", "hms-events" ),
    "add_new_item" => __( "Add New Event", "hms-events" ),
    "edit_item" => __( "Edit Event", "hms-events" ),
    "new_item" => __( "New Event", "hms-events" ),
    "view_item" => __( "View Event", "hms-events" ),
    "view_items" => __( "View Events", "hms-events" ),
    "search_items" => __( "Search Events", "hms-events" ),
    "not_found" => __( "Events Not Found", "hms-events" ),
    "not_found_in_trash" => __( "Events Not Found in Trash", "hms-events" ),
    "archives" => __( "Event Archives", "hms-events" ),
    "insert_into_item" => __( "Insert into Event", "hms-events" ),
    "uploaded_to_this_item" => __( "Uploaded to this Event", "hms-events" ),
    "filter_items_list" => __( "Filter Events List", "hms-events" ),
    "items_list_navigation" => __( "Events List Navigation", "hms-events" ),
    "items_list" => __( "Events List", "hms-events" ),
    "attributes" => __( "Attributes", "hms-events" ),
);

$args = array(
    "label" => __( "Events", "hms-events" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "has_archive" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => true,
    "rewrite" => array( "slug" => "events", "with_front" => false ),
    "menu_icon" => "dashicons-calendar",
	"supports" => array( "title", "editor", "thumbnail", "excerpt", "revisions", "author" ),
);

register_post_type( "hmsevents", $args );
}

add_action( 'init', 'hms_events_register_cpt' );


function hms_events_register_tax() {

	/**
	 * Taxonomy: Event Types.
	 */
	$labels = array(
		"name" => __( "Event Types", "hms-events" ),
		"singular_name" => __( "Event Type", "hms-events" ),
		"menu_name" => __( "Event Types", "hms-events" ),
		"all_items" => __( "All Event Types", "hms-events" ),
		"edit_item" => __( "Edit Event Type", "hms-events" ),
		"view_item" => __( "View Event Type", "hms-events" ),
		"update_item" => __( "Update Event Type Name", "hms-events" ),
		"add_new_item" => __( "Add New Event Type", "hms-events" ),
		"new_item_name" => __( "New Event Type Name", "hms-events" ),
		"parent_item" => __( "Parent Event Type", "hms-events" ),
		"parent_item_colon" => __( "Parent Event Type:", "hms-events" ),
		"search_items" => __( "Search Event Types", "hms-events" ),
		"popular_items" => __( "Popular Event Types", "hms-events" ),
		"separate_items_with_commas" => __( "Separate Event Types with Commas", "hms-events" ),
		"add_or_remove_items" => __( "Add or Remove Event Types", "hms-events" ),
		"choose_from_most_used" => __( "Choose From Most Used Event Types", "hms-events" ),
		"no_terms" => __( "No Event Types", "hms-events" ),
		"items_list_navigation" => __( "Event Types List Navigation", "hms-events" ),
		"items_list" => __( "Event Types List", "hms-events" ),
	);

	$args = array(
		"label" => __( "Event Types", "hms-events" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Event Types",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'event-type', 'with_front' => false, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "hmseventtypes",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "hmseventtypes", array( "hmsevents" ), $args );
}

add_action( 'init', 'hms_events_register_tax' );


/**
 * Create Custom Post Type Query
 */
function hms_event_queries( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    // EVENTS
    if ( is_post_type_archive( 'hmsevents' ) ) {

      $current_time = current_time( 'Ymd' );
      $query->set( 'posts_per_page', 10 );
      $query->set( 'post_status', 'PUBLISHED' );
      $query->set('meta_key', 'event_date_start');
      $query->set('orderby', 'meta_value');
      $query->set('order', 'ASC');
      $query->set( 'meta_query', [
      // 'relation' => 'AND',
          [
            'key'     => 'event_date_start', // ENDING DATE
            'value'   => date('Ymd'), // Current Date
            'compare' => '>=', // event_date_time is greater than or equal to $current_time
            'type'    => 'DATE',
          ]
        ]
      );
    }

    return $query;
}

add_action( 'pre_get_posts', 'hms_event_queries', 15 );