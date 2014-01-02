<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Partenaires
 * @copyright  2014
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Partenaires\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function partenaires_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['partenaires'] = 'partenaires';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function partenaires_declarer_tables_objets_sql($tables) {

	$tables['partenaires'] = array(
		'type' => 'partenaire',
		'principale' => "oui",
		'field'=> array(
			"id_partenaire"      => "bigint(21) NOT NULL",
			"nom"                => "text NOT NULL DEFAULT ''",
			"descriptif"         => "text NOT NULL DEFAULT ''",
			"maj"                => "TIMESTAMP"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_partenaire",
		),
		'titre' => "nom AS titre, '' AS lang",
		 #'date' => "",
		'champs_editables'  => array('nom', 'descriptif'),
		'champs_versionnes' => array('nom', 'descriptif'),
		'rechercher_champs' => array("nom" => 8, "descriptif" => 6),
		'tables_jointures'  => array(),
		

	);

	return $tables;
}



?>