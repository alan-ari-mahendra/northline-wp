<?php
/**
 * Northline – Emergency Fix
 * Fixes blank page caused by Elementor sanitize_settings() TypeError on PHP 8.
 * Delete after running.
 *
 * Access: http://northline-wp.local/northline-fix.php?token=northline2024
 */
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'northline2024' ) {
	die( 'Access denied.' );
}

require_once dirname( __FILE__ ) . '/wp-load.php';

$log = [];

// 1. Fix kit _elementor_page_settings — must be a PHP array
$kit_id = (int) get_option( 'elementor_active_kit' );
if ( $kit_id ) {
	$kit_settings = get_post_meta( $kit_id, '_elementor_page_settings', true );
	if ( ! is_array( $kit_settings ) ) {
		update_post_meta( $kit_id, '_elementor_page_settings', [] );
		$log[] = "Fixed kit ($kit_id) _elementor_page_settings (was " . gettype( $kit_settings ) . ")";
	} else {
		$log[] = "Kit ($kit_id) settings OK (array)";
	}
} else {
	$log[] = 'WARNING: No active kit found';
}

// 2. Fix front page _elementor_page_settings — must be a PHP array
$page_id = (int) get_option( 'page_on_front' );
if ( $page_id ) {
	$page_settings = get_post_meta( $page_id, '_elementor_page_settings', true );
	if ( ! is_array( $page_settings ) ) {
		update_post_meta( $page_id, '_elementor_page_settings', [ 'custom_css' => '' ] );
		$log[] = "Fixed page ($page_id) _elementor_page_settings (was " . gettype( $page_settings ) . ")";
	} else {
		$log[] = "Page ($page_id) settings OK (array)";
	}
} else {
	$log[] = 'WARNING: No front page set';
}

// 3. Delete Elementor CSS cache files so regeneration is forced fresh
$uploads   = wp_upload_dir();
$cache_dir = $uploads['basedir'] . '/elementor/css/';
if ( is_dir( $cache_dir ) ) {
	$files = glob( $cache_dir . '*.css' );
	$count = 0;
	foreach ( $files as $f ) {
		unlink( $f );
		$count++;
	}
	$log[] = "Deleted $count cached CSS files from $cache_dir";
}

// 4. Clear Elementor's internal file cache
if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
	\Elementor\Plugin::$instance->files_manager->clear_cache();
	$log[] = 'Elementor files_manager cache cleared';
}

?><!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Northline Fix</title>
<style>body{font-family:system-ui,sans-serif;padding:2rem;background:#f5f5f5;}
h1{color:#14213d;}.log{background:#fff;border:1px solid #ddd;padding:1rem;border-radius:4px;}
.log p{margin:.25rem 0;font-size:14px;color:#006a60;}
.btn{display:inline-block;margin-top:1rem;background:#14213d;color:#fff;padding:.75rem 1.5rem;text-decoration:none;font-size:13px;letter-spacing:.08em;text-transform:uppercase;}
</style></head>
<body>
<h1>Northline Emergency Fix</h1>
<div class="log">
<?php foreach ( $log as $entry ) : ?>
  <p><?= esc_html( $entry ) ?></p>
<?php endforeach; ?>
</div>
<a class="btn" href="/">View Home Page →</a>
<p style="margin-top:1rem;font-size:13px;color:#666;">⚠️ Delete <code>northline-fix.php</code> after confirming page works.</p>
</body>
</html>
