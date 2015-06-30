<?php
/**
 * Elgg csv user import
 */

elgg_register_event_handler('init', 'system', 'csv_user_import_init');

function csv_user_import_init() {

	// Admin menu link
	elgg_register_admin_menu_item('administer', 'csv_import', 'users');

	// Register the import action
	$base = dirname(__FILE__) . '/actions/csv_user_import';
	elgg_register_action('csv_user_import/import', "$base/import.php", 'admin');

	// csv library
	$base = dirname(__FILE__) . '/lib';
	elgg_register_library('csv_user_import', "$base/csv_user_import.php");
	
	elgg_register_plugin_hook_handler('csv_import', 'user', 'csv_user_import_default');
}

/**
 * Hook for add data from the cvs file
 * @param unknown $hook
 * @param unknown $type
 * @param mixed $return null
 * @param mixed $params $params['user'] the imported users. Other keys with extra fields
 */
function csv_user_import_default($hook, $type, $return, $params){
	$user = $params['user'];
	if(elgg_instanceof($user,'user')){
		if(!empty($params)){
			$params = array_diff($params,array('username', 'name', 'email', 'password', 'icon','user'));
			foreach($params as $key=>$value){
				$user->$key=$value;
			}
			$user->save();
		}
	}
}
