<?php
/**
 * Library of functions for importing users from a CSV file
 */

/**
 * Import users from a CSV file
 * 
 * @param string $filename
 * @param bool   $skip
 * @param string $delimiter
 * @return int The number of users created or false on failure
 */
function csv_user_import($filename, $skip = false, $delimiter = ',') {

	$f = fopen($filename, 'r');
	if (!$f) {
		return false;
	}

	$imported = 0;
	$line = 0;

	if ($skip) {
		$line++;
		fgetcsv($f);
	}

	while ($data = fgetcsv($f)) {
		$line++;

		$num_fields = count($data);
		$username = $data[0];
		$name = $data[1];
		$email = $data[2];

		if ($num_fields == 3) {
			if ($username && $name && $email) {
				$user = csv_user_create($username, $name, $email);
				if ($user) {
					$imported++;
					//notify_user($new_user->guid, $site->guid, elgg_echo('useradd:subject'), sprintf(elgg_echo('useradd:body'), $name, $site->name, $site->url, $username, $password));
				} else {
					register_error(elgg_echo('csvimport:import:warning:importuserfailed', array($line, $username)));
					continue;
				}
			} else {
				register_error(elgg_echo('csvimport:import:warning:missingfield', array($line)));
				continue;
			}
		} else {
			register_error(elgg_echo('csvimport:import:warning:linelength', array($line)));
			continue;
		}
	}

	fclose($f);

	return $imported;
}

/**
 * Create a user
 *
 * @param string $username
 * @param string $name
 * @param string $email
 * @param string $password
 * @param string $icon
 * @return ElggUser (null on failure)
 */
function csv_user_create($username, $name, $email, $password = '', $icon = '') {

	if (!$password) {
		$password = generate_random_cleartext_password();
	}

	try {
		$guid = register_user($username, $password, $name, $email);
	} catch (Exception $e) {
		register_error($e->getMessage());
	}

	if (!$guid) {
		return null;
	}

	$user = get_entity($guid);
	elgg_set_user_validation_status($user->getGUID(), true, 'user_csv_import');

	return $user;
}
