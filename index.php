<?php
/**
 * Elgg csv import
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

admin_gatekeeper();
set_context('admin');
// Set admin user for user block
set_page_owner($_SESSION['guid']);

$title = elgg_view_title(elgg_echo('csvimport:menu:import'));	
$body = elgg_view('csvimport/forms/import');
page_draw(elgg_echo('csvimport:menu:import'),elgg_view_layout("one_column_with_sidebar", $title . $body));