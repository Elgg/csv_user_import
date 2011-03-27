<?php
/**
 * Elgg csv user import
 */

register_elgg_event_handler('init', 'system', 'csvimport_init');

/**
 * Initialise the csvimport tool
 */
function csvimport_init() {

	// Admin menu link
	elgg_register_admin_menu_item('administer', 'csvimport', 'users');

	// Register the import action
	$base = elgg_get_plugins_path() . 'csvimport/actions';
	elgg_register_action('csvimport/import', "$base/import.php", 'admin');
}
