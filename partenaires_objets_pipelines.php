<?php
/**
 * Utilisations de pipelines par Partenaires Objets
 *
 * @plugin     Partenaires Objets
 * @copyright  2014
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Partenaires_objets\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;
	

/*
 * Un fichier de pipelines permet de regrouper
 * les fonctions de branchement de votre plugin
 * sur des pipelines existants.
 */



/**
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function partenaires_objets_affiche_milieu($flux) {
	include_spip('inc/config');
	$texte = "";
	$e = trouver_objet_exec($flux['args']['exec']);
	$config=lire_config('partenaires_objets',array());
	$objets_partenaires=isset($config['objets'])?$config['objets']:array();
	


	// partenaires sur les articles
	if (!$e['edition'] AND in_array($e['type'], $objets_partenaires)) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'partenaires',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}

	if ($texte) {
		if ($p=strpos($flux['data'],"<!--affiche_milieu-->"))
			$flux['data'] = substr_replace($flux['data'],$texte,$p,0);
		else
			$flux['data'] .= $texte;
	}

	return $flux;
}

function partenaires_objets_formulaire_traiter($flux){
	// si creation d'un nouvel article lui attribuer la licence par defaut de la config
	if ($flux['args']['form'] == 'editer_partenaire' AND $flux['args']['args'][0] == 'oui') {
		// Un lien a prendre en compte ?
		if ($associer_objet=_request('associer_objet') AND $id_partenaire = $flux['data']['id_partenaire']) {
			list($objet, $id_objet) = explode('|', $associer_objet);	
			if ($objet AND $id_objet AND autoriser('modifier', $objet, $id_objet)) {
				include_spip('action/editer_liens');
				objet_associer(array('partenaire' => $id_partenaire), array($objet => $id_objet));
				if ($redirect = _request('redirect')) {
					$flux['data']['redirect'] = parametre_url ($redirect, "id_lien_ajoute", $id_partenaire, '&');
				}
			}
		}
	
	}
	return $flux;
}

?>