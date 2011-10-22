<?php
/**
 * Library of functions for importing users from a CSV file
 */

/**
 * Import users from a CSV file
 *
 * @param string $filename
 * @param string $header     'none', 'skip', 'header'
 * @param string $delimiter  "," or "\t"
 * @param bool   $notify     Send email notification
 * @return int The number of users created or false on failure
 */
function csv_user_import($filename, $header = 'none', $delimiter = ",", $notify = false) {

	$required_fields = array('username', 'name', 'email');

	$f = fopen($filename, 'r');
	if (!$f) {
		return false;
	}

	$num_imported = 0;
	$line = 0;

	switch ($header) {
		case 'header':
			$fields = fgetcsv($f, 0, $delimiter);
			$fields = array_map('trim', $fields);
			$fields = array_map('strtolower', $fields);
			foreach ($required_fields as $field) {
				if (!in_array($field, $fields)) {
					register_error(elgg_echo('csvimport:error:requiredfield', array($field)));
					return false;
				}
			}
			break;
		case 'skip':
			$line++;
			fgetcsv($f);
			// a break is not here on purpose
		case 'none':
		default:
			$fields = array('username', 'name', 'email', 'password', 'icon');
			break;
	}

	while ($values = fgetcsv($f, 0, $delimiter)) {
		$line++;

		$values = array_map('trim', $values);

		// to be as forgiving as possible in formats, we correct keys/values each time
		$keys = $fields;
		if (count($values) < count($keys)) {
			$keys = array_slice($keys, 0, count($values));
		} elseif (count($values) > count($keys)) {
			$values = array_slice($values, 0, count($keys));
		}

		$data = array_combine($keys, $values);

		// checks that we have the required fields for this line
		foreach ($required_fields as $field) {
			if (!in_array($field, array_keys($data))) {
				register_error(elgg_echo('csvimport:warning:missingfield', array($line)));
				continue;
			}
		}

		$user = csv_user_create($data, $notify);
		if ($user) {
			$num_imported++;

			$data['user'] = $user;
			elgg_trigger_plugin_hook('csv_import', 'user', $data);
		} else {
			register_error(elgg_echo('csvimport:warning:importuserfailed', array($line, $data['username'])));
			continue;
		}
	}

	fclose($f);

	return $num_imported;
}

/**
 * Create a user
 *
 * @param array $params Array with keys username, name, email, password, and icon
 * @param bool  $notify Should the user be notified of the new account by email?
 * @return ElggUser (null on failure)
 */
function csv_user_create($params, $notify = false) {

	$site = elgg_get_site_entity();

	if (!isset($params['password']) || !trim($params['password']))  {
		$password = generate_random_cleartext_password();
	} else {
		$password = $params['password'];
	}

	try {
		$guid = register_user($params['username'], $password, $params['name'], $params['email'], true);
	} catch (Exception $e) {
		register_error($e->getMessage());
	}

	if (!$guid) {
		return null;
	}

	$user = get_entity($guid);
	elgg_set_user_validation_status($user->getGUID(), true, 'user_csv_import');

	if (isset($params['icon']) && $params['icon']) {
		csv_user_set_icon($user, $params['icon']);
	}

	if ($notify) {
		$body = elgg_echo('useradd:body', array(
			$params['username'],
			$site->name,
			$site->getURL(),
			$params['username'],
			$password,
		));

		notify_user(
				$user->getGUID(),
				$site->getGUID(),
				elgg_echo('useradd:subject'),
				$body,
				null,
				'email');
	}

	return $user;
}

/**
 * Set the user avatar
 *
 * @param ElggUser $user
 * @param string   $icon_filename
 * @return bool
 */
function csv_user_set_icon($user, $icon_filename) {

	if (!elgg_instanceof($user, 'user')) {
		return false;
	}

	if (!file_exists($icon_filename)) {
		register_error(elgg_echo('csvimport:warning:iconfile', array($icon_filename)));
		return false;
	}

	$guid = $user->getGUID();

	//@todo make this configurable?
	$icon_sizes = array(
		'topbar' => array('w'=>16, 'h'=>16, 'square'=>TRUE, 'upscale'=>TRUE),
		'tiny' => array('w'=>25, 'h'=>25, 'square'=>TRUE, 'upscale'=>TRUE),
		'small' => array('w'=>40, 'h'=>40, 'square'=>TRUE, 'upscale'=>TRUE),
		'medium' => array('w'=>100, 'h'=>100, 'square'=>TRUE, 'upscale'=>TRUE),
		'large' => array('w'=>200, 'h'=>200, 'square'=>FALSE, 'upscale'=>TRUE),
		'master' => array('w'=>550, 'h'=>550, 'square'=>FALSE, 'upscale'=>FALSE)
	);

	// get the images and save their file handlers into an array so we can do clean up if one fails.
	$files = array();
	foreach ($icon_sizes as $name => $size_info) {
		$resized = get_resized_image_from_existing_file(
				$icon_filename,
				$size_info['w'],
				$size_info['h'],
				$size_info['square'],
				0, 0, 0, 0,
				$size_info['upscale']);

		if ($resized) {
			//@todo Make these actual entities.  See exts #348.
			$file = new ElggFile();
			$file->owner_guid = $guid;
			$file->setFilename("profile/{$guid}{$name}.jpg");
			$file->open('write');
			$file->write($resized);
			$file->close();
			$files[] = $file;
		} else {
			// cleanup on fail
			foreach ($files as $file) {
				$file->delete();
			}
		}
	}

	$user->icontime = time();
}
