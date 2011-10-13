<?php
/**
 * Elgg csv user import
 */

elgg_register_event_handler('init', 'system', 'csv_user_import_init');

function csv_user_import_init() {

	// Admin menu link
	elgg_register_admin_menu_item('administer', 'csv_import', 'users');

	// Register the import action
	$base = elgg_get_plugins_path() . 'csv_user_import/actions';
	elgg_register_action('user_import/import', "$base/import.php", 'admin');

	// csv library
	$base = elgg_get_plugins_path() . 'csv_user_import/lib';
	elgg_register_library('csv_user_import', "$base/csv_user_import.php");
}
