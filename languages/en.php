<?php
/**
 * CSV User Import English language file
 * 
 */

$english = array(
	'admin:users:csvimport' => 'Import from CSV file',
	'csvimport:description' => 'Select a CSV file to import which must contain a list of users in the following format:
		
		USERNAME, NAME, EMAIL ADDRESS',
	'csvimport:label:skipfirstline' => 'Skip the first line',
	'csvimport:import:error' => 'There was a problem importing this file.',
	'csvimport:import:success' => '%d out of %d users successfully imported!',
	'csvimport:import:warning:linelength' => 'Warning line %d: Unexpected length',
	'csvimport:import:warning:missingfield' => 'Warning line %d: Missing fields',
	'csvimport:import:warning:importuserfailed' => 'Warning line $d: Could not import user %s',
);

add_translation("en", $english);
