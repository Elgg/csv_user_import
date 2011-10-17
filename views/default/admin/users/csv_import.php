<?php
/**
 * CSV user import admin view
 */
	
echo autop(elgg_echo('csvimport:description'));

echo elgg_view_form('csv_user_import/import', array('enctype' => 'multipart/form-data'));
