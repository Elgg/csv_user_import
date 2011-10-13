<?php
/**
 * Elgg csv import action
 * 
 */

$flag = get_input('skipfirst');

$file = "";

if (isset($_FILES['csvimport']) && $_FILES['csvimport']['error'] == 0) {
	$file = $_FILES['csvimport']['tmp_name'];
}

if ($file) {
	elgg_load_library('csv_user_import');

	$num_users = csv_user_import($file, $flag);
	if (is_int($num_users)) {
		system_message(elgg_echo('csvimport:import:success', array($num_users)));
	} else {
		register_error(elgg_echo('csvimport:import:error'));
	}
} else {
	register_error(elgg_echo('csvimport:import:error'));
}

forward(REFERER);
