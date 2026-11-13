<?php
/**
 * Northline patch #2 — fix encoding mojibake + button background type.
 * Run via ?nl_patch2=1, then delete this file.
 */
add_action( 'init', function () {
	if ( ! isset( $_GET['nl_patch2'] ) ) {
		return;
	}

	$page_id = (int) get_option( 'nl_setup_v1' );
	if ( ! $page_id ) {
		$page_id = 17;
	}

	$raw = get_post_meta( $page_id, '_elementor_data', true );

	// ---- 1. Fix mojibake across the entire JSON string ----
	// These byte sequences are incorrectly encoded Unicode characters
	// stored in the DB. Replace with correct UTF-8.
	// All search strings use hex escapes to avoid any quote/encoding issue in the PHP source file.
	$search = [
		"\xc3\x94\xc3\x87\xc3\xb6", // ÔÇö → em dash
		"\xc3\x94\xc3\x87\xc3\xb4", // ÔÇô → en dash
		"\xe2\x94\xac\xc3\x80",      // ┬À  → middle dot
		"\xc3\xa2\xe2\x82\xac\xe2\x80\x9d", // â€" (W1252 path) → em dash
		"\xc3\x82\xc2\xb7",          // Â·  → middle dot
		"\xc3\xa2\xe2\x82\xac\xcb\x9c", // â€˜ → left single quote
		"\xc3\xa2\xe2\x82\xac\xe2\x84\xa2", // â€™ → right single quote
		"\xc3\x94\xc3\xa4\xc3\xb3",  // Ôäó → trade mark
		"\xc3\xa2\xe2\x82\xac\xc2\xa2", // â€¢ → bullet
	];
	$replace = [
		"\xe2\x80\x94", // em dash
		"\xe2\x80\x93", // en dash
		"\xc2\xb7",     // middle dot
		"\xe2\x80\x94", // em dash
		"\xc2\xb7",     // middle dot
		"\xe2\x80\x98", // left single quote
		"\xe2\x80\x99", // right single quote
		"\xe2\x84\xa2", // trade mark
		"\xe2\x80\xa2", // bullet
	];
	$raw = str_replace( $search, $replace, $raw );

	$data = json_decode( $raw, true );
	if ( ! $data ) {
		wp_die( 'JSON decode failed after encoding fix. Raw: ' . substr( $raw, 0, 200 ) );
	}

	// ---- 2. Fix button: add background_background=classic ----
	$data = nl_patch2_element( $data, 'h3r0008', function ( $el ) {
		$el['settings']['button_background_background'] = 'classic';
		$el['settings']['button_background_color']      = '#14213d';
		return $el;
	} );

	// ---- 3. Save and clear Elementor CSS cache ----
	update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );

	if ( class_exists( '\Elementor\Plugin' ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	wp_die( 'Patch #2 applied. Delete mu-plugins/nl-patch2.php, nl-patch.php, nl-dump.php.' );
} );

function nl_patch2_element( array $elements, string $target_id, callable $patcher ): array {
	foreach ( $elements as &$el ) {
		if ( isset( $el['id'] ) && $el['id'] === $target_id ) {
			$el = $patcher( $el );
		}
		if ( ! empty( $el['elements'] ) ) {
			$el['elements'] = nl_patch2_element( $el['elements'], $target_id, $patcher );
		}
	}
	return $elements;
}
