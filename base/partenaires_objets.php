<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Partenaires Objets
 * @copyright  2014
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Partenaires_objets\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Déclaration des tables secondaires (liaisons)
 *
 * @pipeline declarer_tables_auxiliaires
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function partenaires_objets_declarer_tables_auxiliaires($tables) {

	$tables['spip_partenaires_liens'] = array(
		'field' => array(
			"id_partenaire"      => "bigint(21) DEFAULT '0' NOT NULL",
			"id_objet"           => "bigint(21) DEFAULT '0' NOT NULL",
			"objet"              => "VARCHAR(25) DEFAULT '' NOT NULL",
			"vu"                 => "VARCHAR(6) DEFAULT 'non' NOT NULL"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_partenaire,id_objet,objet",
			"KEY id_partenaire"  => "id_partenaire"
		)
	);

	return $tables;
}


?>