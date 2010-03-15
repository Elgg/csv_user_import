<?php
/**
 * Elgg csv import
 */
	
global $CONFIG;
	
echo "<div class='margin_top'>".elgg_view('output/longtext', array('value' => elgg_echo('csvimport:description')))."</div>";
	
$file = elgg_view('input/file', array('internalname' => 'csvimport'));
$checkbox = elgg_view('input/checkboxes', array('internalname' => 'skipfirst', 'options' => array(
	elgg_echo('csvimport:label:skipfirstline') => 'skipfirst'
)));
$button = elgg_view('input/submit', array('value' => elgg_echo('import')));
	
$form_body = <<< END
	
			$file $checkbox
			$button
END;
echo elgg_view('input/form', array('enctype' => 'multipart/form-data', 'body' => $form_body, 'action' => $CONFIG->url . "action/csvimport/import"));
