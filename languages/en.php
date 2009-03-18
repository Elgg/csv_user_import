<?php
	/**
	 * Elgg email domains language pack.
	 * 
	 * @package ElggEmailDomains
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	$english = array(
		'csvimport:menu:import' => 'Import users from CSV file',
		'csvimport:description' => 'Select a CSV file to import which must contain a list of users in the following format:
		
		USERNAME, NAME, EMAIL ADDRESS',
	
		'csvimport:label:skipfirstline' => 'Skip the first line',
	
		'csvimport:import:error' => 'There was a problem importing this file.',
		'csvimport:import:success' => '%d out of %d users successfully imported!',
	
		'csvimport:import:warning:linelength' => 'Warning line %d: Unexpected length',
		'csvimport:import:warning:missingfield' => 'Warning line %d: Missing fields',
		'csvimport:import:warning:importuserfailed' => 'Warning line $d: Could not import user %s',
	);
					
	add_translation("en",$english);
?>