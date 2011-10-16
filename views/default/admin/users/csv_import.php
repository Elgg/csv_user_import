<?php
/**
 * CSV user import admin view
 */
	
echo autop(elgg_echo('csvimport:description'));

$file = elgg_view('input/file', array('name' => 'csvimport'));
$checkbox = elgg_view('input/checkboxes', array(
	'name' => 'skipfirst',
	'options' => array(elgg_echo('csvimport:label:skipfirstline') => 'skipfirst'),
));

$header_title = elgg_echo('csvimport:title:header');
$first_line = elgg_view('input/radio', array(
	'name' => 'first_line',
	'options' => array(
		elgg_echo('csvimport:label:skipfirstline') => 'skip',
		elgg_echo('csvimport:label:noheader') => 'none',
		elgg_echo('csvimport:label:useheader') => 'header',
	),
	'value' => 'skip',
));

$separator_title = elgg_echo('csvimport:title:separator');
$separator = elgg_view('input/radio', array(
	'name' => 'separator',
	'options' => array(
		elgg_echo('csvimport:label:comma') => 'comma',
		elgg_echo('csvimport:label:tab') => 'tab',
	),
	'value' => 'comma',
));
$button = elgg_view('input/submit', array('value' => elgg_echo('import')));

$form_body = <<<HTML
	<div>$file</div>
	<div><h3>$header_title</h3> $first_line</div>
	<div><h3>$separator_title</h3> $separator</div>
	<div class='elgg-foot'>$button</div>
HTML;

echo elgg_view('input/form', array(
	'enctype' => 'multipart/form-data',
	'body' => $form_body,
	'action' => 'action/user_import/import',
));
