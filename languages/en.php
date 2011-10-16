<?php
/**
 * CSV User Import English language file
 * 
 */

$english = array(
	'admin:users:csv_import' => 'Import Users',
	'csvimport:description' => 'Select a CSV file to import which must contain a list of users in the following format:
		
		USERNAME, NAME, EMAIL ADDRESS',

	'csvimport:title:header' => 'CSV Header',
	'csvimport:title:separator' => 'Field Separator',
	'csvimport:label:skipfirstline' => 'Skip the first line',
	'csvimport:label:noheader' => 'There is no header',
	'csvimport:label:useheader' => 'The header defines the field names',
	'csvimport:label:comma' => 'Comma separated',
	'csvimport:label:tab' => 'Tab separated',

	'csvimport:error:requiredfield' => 'Required field missing in CSV header: %s',
	'csvimport:warning:iconfile' => "Unable to set the user's icon as %s",
	'csvimport:warning:linelength' => 'Warning line %d: Unexpected length',
	'csvimport:warning:missingfield' => 'Warning line %d: Missing fields',
	'csvimport:warning:importuserfailed' => 'Warning line %d: Could not import user %s',
	
	'csvimport:import:error' => 'There was a problem importing this file.',
	'csvimport:import:success' => 'Imported %d users.',
);

add_translation("en", $english);
