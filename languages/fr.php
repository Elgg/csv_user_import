<?php
/**
 * CSV User Import French language file
 * 
 */

$french = array(
	'admin:users:csv_import' => 'Importer des utilisateurs',
	'csvimport:description' => 'Importer des utilisateurs à partir d\'un fichier de données séparées par des virgules (CSV). Des instructions sont données dans le fichier readme.',

	'csvimport:title:file' => 'Fichier CSV',
	'csvimport:title:header' => 'En-tête CSV',
	'csvimport:label:skipfirstline' => 'Ignorer l\'en-tête',
	'csvimport:label:noheader' => 'Il n\'ya pas d\'en-tête',
	'csvimport:label:useheader' => 'L\'en-tête définit les noms des champs',
	'csvimport:title:separator' => 'Séparateur de champ',
	'csvimport:label:comma' => 'Séparé par des virgules',
	'csvimport:label:tab' => 'Séparé par des tabulations',
	'csvimport:title:notify' => 'Prévenir les utilisateurs importés',
	'csvimport:label:yes' => 'Oui',
	'csvimport:label:no' => 'Non',

	'csvimport:error:requiredfield' => 'Champ obligatoire manquant dans l\'en-tête au format CSV: %s',
	'csvimport:warning:iconfile' => "Impossible de définir l'icône de l'utilisateur en tant que %s",
	'csvimport:warning:linelength' => 'Avertissement à la ligne %d: Longueur inattendue',
	'csvimport:warning:missingfield' => 'Avertissement à la ligne %d: Champs manquants',
	'csvimport:warning:importuserfailed' => 'Avertissement à la ligne %d: Impossible d\'importer l\'utilisateur %s',
	
	'csvimport:import:error' => 'Il y a eu un problème au cours de l\'importation de ce fichier.',
	'csvimport:import:success' => '%d utilisateurs importés.',
);

add_translation("fr", $french);
