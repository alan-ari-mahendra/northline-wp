<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'northline2024' ) { die( 'Access denied.' ); }
require_once dirname( __FILE__ ) . '/wp-load.php';

// Simulate front page context
$GLOBALS['wp_query'] = new WP_Query( [ 'page_id' => (int) get_option( 'page_on_front' ) ] );
$GLOBALS['wp_query']->is_page      = true;
$GLOBALS['wp_query']->is_singular  = true;
$GLOBALS['wp_query']->is_front_page = true;

ob_start();
do_action( 'wp_head' );
$head = ob_get_clean();

$has_nl   = strpos( $head, '<!-- nl-assets -->' ) !== false;
$has_tw   = strpos( $head, 'tailwindcss.com' ) !== false;
$has_fp   = is_front_page();
$page_id  = (int) get_option( 'page_on_front' );
$show_on  = get_option( 'show_on_front' );

echo '<pre>';
echo "page_on_front=$page_id  show_on_front=$show_on\n";
echo "is_front_page()=" . ( $has_fp ? 'true' : 'false (PROBLEM!)' ) . "\n";
echo "nl-assets in head=" . ( $has_nl ? 'YES' : 'NO ← not loading!' ) . "\n";
echo "tailwindcss.com in head=" . ( $has_tw ? 'YES' : 'NO' ) . "\n\n";

// Show first 3000 chars of head
echo "--- wp_head output (first 3000 chars) ---\n";
echo htmlspecialchars( substr( $head, 0, 3000 ) );
echo '</pre>';
