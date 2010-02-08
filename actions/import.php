<?php
	/**
	 * Elgg csv import
	 * 
	 * @package ElggCSVImport
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	admin_gatekeeper();
	action_gatekeeper();
	
	global $CONFIG;
	
	
	// Get flag
	$flag = get_input('skipfirst');
	
	// File
	$file = "";
	
	if (isset($_FILES['csvimport']) && $_FILES['csvimport']['error'] == 0) {
			$file = $_FILES['csvimport']['tmp_name'];
	}
	
	if ($file)
	{	
	
		$f = fopen($file, 'r');
		if ($f)
		{
			// Stats
			$total = 0;
			$imported = 0;	
			$line = 0;
			
			// If we skip first, then skip first
			if ($flag) {
				$line++;
				fgetcsv($f);
			}
				
			// Now read and parse the rest
			while ($line = fgetcsv($f))
			{
				$total++;
				$line++;
				
				$numfields = count($line);
				$username = $line[0];
				$name = $line[1];
				$email = $line[2];
				
				// Sanitise		
				if ($numfields != 3)
					register_error(sprintf(elgg_echo('csvimport:import:warning:linelength'), $line));
				else {
					
					if ((!$username) || (!$name) || (!$email))
						register_error(sprintf(elgg_echo('csvimport:import:warning:missingfield'), $line));
					else
					{ 
						$password = generate_random_cleartext_password();
						if ($guid = register_user($username, $password, $name, $email)) {
							$imported ++;
							
							$new_user = get_entity($guid);
							$new_user->admin_created = true;
			
							notify_user($new_user->guid, $CONFIG->site->guid, elgg_echo('useradd:subject'), sprintf(elgg_echo('useradd:body'), $name, $CONFIG->site->name, $CONFIG->site->url, $username, $password));
			
						}
						else
							register_error(sprintf(elgg_echo('csvimport:import:warning:importuserfailed'), $line, $username));
						
					}
				}
				
			}
			
			fclose($f);
			
			system_message(sprintf(elgg_echo('csvimport:import:success'), $imported, $total));
		}
		else
			register_error(elgg_echo('csvimport:import:error'));
	}
	else
		register_error(elgg_echo('csvimport:import:error'));
	
	
	forward($_SERVER['HTTP_REFERER']);
?>