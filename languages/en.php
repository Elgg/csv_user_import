<?php
/**
 * CSV User Import English language file
 * 
 */

$english = array(
	'admin:users:csv_import' => 'Import Users',
	'csvimport:description' => 'Import users from a comma-separated values (CSV) file. There are instructions in the readme file.',

	'csvimport:title:file' => 'CSV file',
	'csvimport:title:header' => 'CSV header',
	'csvimport:label:skipfirstline' => 'Skip the header',
	'csvimport:label:noheader' => 'There is no header',
	'csvimport:label:useheader' => 'The header defines the field names',
	'csvimport:title:separator' => 'Field separator',
	'csvimport:label:comma' => 'Comma separated',
	'csvimport:label:tab' => 'Tab separated',
	'csvimport:title:notify' => 'Notify the imported users',
	'csvimport:label:yes' => 'Yes',
	'csvimport:label:no' => 'No',

	'csvimport:error:requiredfield' => 'Required field missing in CSV header: %s',
	'csvimport:warning:iconfile' => "Unable to set the user's icon as %s",
	'csvimport:warning:linelength' => 'Warning line %d: Unexpected length',
	'csvimport:warning:missingfield' => 'Warning line %d: Missing fields',
	'csvimport:warning:importuserfailed' => 'Warning line %d: Could not import user %s',
	
	'csvimport:import:error' => 'There was a problem importing this file.',
	'csvimport:import:success' => 'Imported %d users.',
);

add_translation("en", $english);
