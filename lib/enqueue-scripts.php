<?php

/**
 * Enqueue block editor only JavaScript and CSS
 */
function hms_events_editor_scripts() {

    // Make paths variables so we don't write em twice ;)
    $blockPath = '../assets/js/editor.blocks.js';
    $editorStylePath = '../assets/css/blocks.editor.css';

    // Enqueue the bundled block JS file
    wp_enqueue_script(
        'hms-events-js',
        plugins_url( $blockPath, __FILE__ ),
        [ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components' ],
        filemtime( plugin_dir_path( __FILE__ ) . $blockPath )
    );

    // Enqueue optional editor only styles
    wp_enqueue_style(
        'hms-events-editor-css',
        plugins_url( $editorStylePath, __FILE__),
        [ 'wp-blocks' ],
        filemtime( plugin_dir_path( __FILE__ ) . $editorStylePath )
    );

}
// Hook scripts function into block editor hook
add_action( 'enqueue_block_editor_assets', 'hms_events_editor_scripts' );


/**
 * Enqueue front end and editor JavaScript and CSS
 */
function hms_events_scripts()
{
    // Make paths variables so we don't write em twice ;)
    $blockPath = '../assets/js/frontend.blocks.js';
    $stylePath = '../assets/css/blocks.style.css';

    if( !is_admin() ) {
        // Enqueue the bundled block JS file
        wp_enqueue_script(
            'hms-events-frontend',
            plugins_url( $blockPath, __FILE__ ),
            [],
            filemtime( plugin_dir_path(__FILE__) . $blockPath )
        );
    }

    // Enqueue frontend and editor block styles
    wp_enqueue_style(
        'hms-events',
        plugins_url($stylePath, __FILE__),
        [ 'wp-blocks' ],
        filemtime(plugin_dir_path(__FILE__) . $stylePath )
    );

}

// Hook scripts function into block editor hook
add_action('enqueue_block_assets', 'hms_events_scripts');