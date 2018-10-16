<?php

function hms_events_register_cpt() {

/**
 * Post Type: Events.
 */

$labels = array(
    "name" => __( "Events", "hms-maverick" ),
    "singular_name" => __( "Event", "hms-maverick" ),
    "menu_name" => __( "Events", "hms-maverick" ),
    "all_items" => __( "All Events", "hms-maverick" ),
    "add_new" => __( "Add New", "hms-maverick" ),
    "add_new_item" => __( "Add New Event", "hms-maverick" ),
    "edit_item" => __( "Edit Event", "hms-maverick" ),
    "new_item" => __( "New Event", "hms-maverick" ),
    "view_item" => __( "View Event", "hms-maverick" ),
    "view_items" => __( "View Events", "hms-maverick" ),
    "search_items" => __( "Search Events", "hms-maverick" ),
    "not_found" => __( "Events Not Found", "hms-maverick" ),
    "not_found_in_trash" => __( "Events Not Found in Trash", "hms-maverick" ),
    "archives" => __( "Event Archives", "hms-maverick" ),
    "insert_into_item" => __( "Insert into Event", "hms-maverick" ),
    "uploaded_to_this_item" => __( "Uploaded to this Event", "hms-maverick" ),
    "filter_items_list" => __( "Filter Events List", "hms-maverick" ),
    "items_list_navigation" => __( "Events List Navigation", "hms-maverick" ),
    "items_list" => __( "Events List", "hms-maverick" ),
    "attributes" => __( "Attributes", "hms-maverick" ),
);

$args = array(
    "label" => __( "Events", "hms-maverick" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "has_archive" => "Events",
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => true,
    "rewrite" => array( "slug" => "events", "with_front" => true ),
    "query_var" => "$hms_events",
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
		"name" => __( "Event Types", "hms-maverick" ),
		"singular_name" => __( "Event Type", "hms-maverick" ),
		"menu_name" => __( "Event Types", "hms-maverick" ),
		"all_items" => __( "All Event Types", "hms-maverick" ),
		"edit_item" => __( "Edit Event Type", "hms-maverick" ),
		"view_item" => __( "View Event Type", "hms-maverick" ),
		"update_item" => __( "Update Event Type Name", "hms-maverick" ),
		"add_new_item" => __( "Add New Event Type", "hms-maverick" ),
		"new_item_name" => __( "New Event Type Name", "hms-maverick" ),
		"parent_item" => __( "Parent Event Type", "hms-maverick" ),
		"parent_item_colon" => __( "Parent Event Type:", "hms-maverick" ),
		"search_items" => __( "Search Event Types", "hms-maverick" ),
		"popular_items" => __( "Popular Event Types", "hms-maverick" ),
		"separate_items_with_commas" => __( "Separate Event Types with Commas", "hms-maverick" ),
		"add_or_remove_items" => __( "Add or Remove Event Types", "hms-maverick" ),
		"choose_from_most_used" => __( "Choose From Most Used Event Types", "hms-maverick" ),
		"no_terms" => __( "No Event Types", "hms-maverick" ),
		"items_list_navigation" => __( "Event Types List Navigation", "hms-maverick" ),
		"items_list" => __( "Event Types List", "hms-maverick" ),
	);

	$args = array(
		"label" => __( "Event Types", "hms-maverick" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Event Types",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'event-type', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "hms_event_types",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "hmseventtypes", array( "hmsevents" ), $args );
}

add_action( 'init', 'hms_events_register_tax' );
