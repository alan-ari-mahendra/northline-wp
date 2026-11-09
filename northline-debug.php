<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'northline2024' ) { die( 'Access denied.' ); }
require_once dirname( __FILE__ ) . '/wp-load.php';

$kit_id  = (int) get_option( 'elementor_active_kit' );
$page_id = (int) get_option( 'page_on_front' );

$kit_raw  = get_post_meta( $kit_id,  '_elementor_page_settings', true );
$page_raw = get_post_meta( $page_id, '_elementor_page_settings', true );

$el_data     = get_post_meta( $page_id, '_elementor_data', true );
$el_mode     = get_post_meta( $page_id, '_elementor_edit_mode', true );
$el_template = get_post_meta( $page_id, '_wp_page_template', true );
$front_page  = get_option( 'page_on_front' );
$show_on     = get_option( 'show_on_front' );

$json_valid  = json_decode( $el_data ) !== null;
$json_len    = strlen( $el_data );

// Find first JSON error position using binary search
$pos = 0;
if ( ! $json_valid ) {
	$lo = 0; $hi = $json_len;
	while ( $hi - $lo > 10 ) {
		$mid = (int)(( $lo + $hi ) / 2);
		if ( json_decode( substr( $el_data, 0, $mid ) ) === null && json_last_error() !== JSON_ERROR_NONE ) {
			$hi = $mid;
		} else {
			$lo = $mid;
		}
	}
	$pos = $hi;
}

echo '<pre>';
echo "kit_id=$kit_id  page_id=$page_id  front_page=$front_page\n";
echo "_elementor_edit_mode: $el_mode | _wp_page_template: $el_template\n\n";
echo "_elementor_data: $json_len bytes, valid=" . ( $json_valid ? 'YES' : 'NO (' . json_last_error_msg() . ')' ) . "\n";
if ( ! $json_valid ) {
	echo "Error near byte $pos:\n";
	echo "...context: " . htmlspecialchars( substr( $el_data, max(0,$pos-80), 160 ) ) . "\n\n";
}
// test whether wp_unslash is stripping backslashes
$test_key = '_nl_slash_test';
update_post_meta( $page_id, $test_key, 'has \"quotes\" here' );
$read_back = get_post_meta( $page_id, $test_key, true );
delete_post_meta( $page_id, $test_key );
echo "wp_unslash test: stored 'has \\\"quotes\\\" here', got back: " . $read_back . "\n";
echo "(If 'has \"quotes\" here' → WP strips slashes. If 'has \\\"quotes\\\" here' → WP keeps them.)\n";
echo '</pre>';
