<?php
/**
 * CSV user import admin view
 */
	
echo autop(elgg_echo('csvimport:description'));

$file = elgg_view('input/file', array('internalname' => 'csvimport'));
$checkbox = elgg_view('input/checkboxes', array(
	'internalname' => 'skipfirst',
	'options' => array(elgg_echo('csvimport:label:skipfirstline') => 'skipfirst'),
));
$button = elgg_view('input/submit', array('value' => elgg_echo('import')));
	
$form_body = <<<HTML
	$file $checkbox
	$button
HTML;

echo elgg_view('input/form', array(
	'enctype' => 'multipart/form-data',
	'body' => $form_body,
	'action' => 'action/csvimport/import',
));
