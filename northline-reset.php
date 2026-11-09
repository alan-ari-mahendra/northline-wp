<?php
/**
 * One-time reset helper.
 * Access: http://northline-wp.local/northline-reset.php?token=nlreset2024
 * Deletes old setup options and pages so the mu-plugin runs fresh.
 */

define( 'ABSPATH', dirname( __FILE__ ) . '/' );
define( 'WPINC', 'wp-includes' );

$token = isset( $_GET['token'] ) ? $_GET['token'] : '';
if ( $token !== 'nlreset2024' ) {
    http_response_code( 403 );
    exit( 'Forbidden' );
}

require_once __DIR__ . '/wp-load.php';

$old_keys = [ 'nl_setup_v1', 'mh_setup_v1', 'nl_setup_done', 'northline_setup_done' ];
foreach ( $old_keys as $key ) {
    $old_id = (int) get_option( $key );
    if ( $old_id ) {
        wp_delete_post( $old_id, true );
        echo "Deleted post #{$old_id} for option {$key}<br>";
    }
    delete_option( $key );
    echo "Deleted option: {$key}<br>";
}

// Also find and delete any page named Northline Operations
$pages = get_posts( [
    'post_type'   => 'page',
    'post_status' => 'any',
    'title'       => 'Northline Operations',
    'numberposts' => 5,
] );
foreach ( $pages as $p ) {
    wp_delete_post( $p->ID, true );
    echo "Deleted page #{$p->ID}: {$p->post_title}<br>";
}

// Reset front page
update_option( 'show_on_front', 'posts' );
update_option( 'page_on_front', 0 );
echo "Front page reset.<br>";

echo "<br><strong>Done. Now visit the homepage to trigger setup.</strong>";
