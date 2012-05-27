<?php
/**
 * CSV User Import French language file
 * 
 */

$french = array(
	'admin:users:csv_import' => 'Importer des utilisateurs',
	'csvimport:description' => 'Importer des utilisateurs � partir d\'un fichier de donn�es s�par�es par des virgules (CSV). Des instructions sont donn�es dans le fichier readme.',

	'csvimport:title:file' => 'Fichier CSV',
	'csvimport:title:header' => 'En-t�te CSV',
	'csvimport:label:skipfirstline' => 'Ignorer l\'en-t�te',
	'csvimport:label:noheader' => 'Il n\'ya pas d\'en-t�te',
	'csvimport:label:useheader' => 'L\'en-t�te d�finit les noms des champs',
	'csvimport:title:separator' => 'S�parateur de champ',
	'csvimport:label:comma' => 'S�par� par des virgules',
	'csvimport:label:tab' => 'S�par� par des tabulations',
	'csvimport:title:notify' => 'Pr�venir les utilisateurs import�s',
	'csvimport:label:yes' => 'Oui',
	'csvimport:label:no' => 'Non',

	'csvimport:error:requiredfield' => 'Champ obligatoire manquant dans l\'en-t�te au format CSV: %s',
	'csvimport:warning:iconfile' => "Impossible de d�finir l'ic�ne de l'utilisateur en tant que %s",
	'csvimport:warning:linelength' => 'Avertissement � la ligne %d: Longueur inattendue',
	'csvimport:warning:missingfield' => 'Avertissement � la ligne %d: Champs manquants',
	'csvimport:warning:importuserfailed' => 'Avertissement � la ligne %d: Impossible d\'importer l\'utilisateur %s',
	
	'csvimport:import:error' => 'Il y a eu un probl�me au cours de l\'importation de ce fichier.',
	'csvimport:import:success' => '%d utilisateurs import�s.',
);

add_translation("fr", $french);
