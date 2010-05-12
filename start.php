<?php
	/**
	 * Elgg csv import
	 */

	/**
	 * Initialise the csvimport tool
	 *
	 */
	function csvimport_init() {
		global $CONFIG;
		
		// Register a page handler, so we can have nice URLs
		register_page_handler('csvimport','csvimport_page_handler');
		
		// Admin menu link
		elgg_add_admin_submenu_item('csvimport', elgg_echo('csvimport:menu:import'), 'users');
		
		// Register some actions
		register_action("csvimport/import",false, $CONFIG->pluginspath . "csvimport/actions/import.php", true);
	}
	
	/**
	 * Adding the diagnostics to the admin menu
	 *
	 */
	//function csvimport_pagesetup() {
	//	if (get_context() == 'admin' && isadminloggedin()) {
	//		global $CONFIG;
			//add_submenu_item(elgg_echo('csvimport:menu:import'), $CONFIG->wwwroot . 'pg/csvimport/');
	//	}
	//}
	/**
	 * Email domains page.
	 *
	 * @param array $page Array of page elements, forwarded by the page handling mechanism
	 */
	function csvimport_page_handler($page) {
		global $CONFIG;
		
		// only interested in one page for now
		include($CONFIG->pluginspath . "csvimport/index.php"); 
	}

	// Initialise log browser
	register_elgg_event_handler('init','system','csvimport_init');
	register_elgg_event_handler('pagesetup','system','csvimport_pagesetup');
?>